<?php
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\Misc\RequestUtils;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\Root\Facades\Translation\TranslationAPIFacade;
use PoPCMSSchema\CustomPosts\Facades\CustomPostTypeAPIFacade;
use PoPCMSSchema\Users\Facades\UserTypeAPIFacade;
use PoPSchema\Notifications\TypeResolvers\ObjectType\NotificationObjectTypeResolver;

class PoPTheme_Wassup_AAL_PoP_DataLoad_ObjectTypeFieldResolver_Notifications extends AbstractObjectTypeFieldResolver
{
    public function getObjectTypeResolverClassesToAttachTo(): array
    {
        return [
            NotificationObjectTypeResolver::class,
        ];
    }

    /**
     * @return string[]
     */
    public function getFieldNamesToResolve(): array
    {
        return [
            'icon',
            'url',
            'message',
        ];
    }

    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): \PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface
    {
        return match($fieldName) {
            'icon' => \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver::class,
            'url' => \PoPSchema\SchemaCommons\TypeResolvers\ScalarType\URLScalarTypeResolver::class,
            'message' => \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver::class,
            default => parent::getFieldTypeResolver($objectTypeResolver, $fieldName),
        };
    }

    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ?string
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        return match($fieldName) {
            'icon' => $translationAPI->__('', ''),
            'url' => $translationAPI->__('', ''),
            'message' => $translationAPI->__('', ''),
            default => parent::getFieldDescription($objectTypeResolver, $fieldName),
        };
    }

    /**
     * @todo This function has been removed, adapt it to whatever needs be done!
     */
    public function resolveCanProcessObject(
        ObjectTypeResolverInterface $objectTypeResolver,
        FieldDataAccessorInterface $fieldDataAccessor,
        object $object,
    ): bool {
        $notification = $object;
        return $notification->object_type == 'Post' && in_array(
            $notification->action,
            [
                AAL_POP_ACTION_POST_HIGHLIGHTEDFROMPOST,
            ]
        );
    }

    public function resolveValue(
        ObjectTypeResolverInterface $objectTypeResolver,
        object $object,
        \PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface $fieldDataAccessor,
        \PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore,
    ): mixed {
        $userTypeAPI = UserTypeAPIFacade::getInstance();
        $customPostTypeAPI = CustomPostTypeAPIFacade::getInstance();
        $notification = $object;
        switch ($field->getName()) {
            case 'icon':
                // URL depends basically on the action performed on the object type
                switch ($notification->action) {
                    case AAL_POP_ACTION_POST_HIGHLIGHTEDFROMPOST:
                        return getRouteIcon(POP_ADDHIGHLIGHTS_ROUTE_HIGHLIGHTS, false);
                }
                return null;

            case 'url':
                switch ($notification->action) {
                    case AAL_POP_ACTION_POST_HIGHLIGHTEDFROMPOST:
                        // Can't point to the posted article since we don't have the information (object_id is the original, referenced post, not the referencing one),
                        // so the best next thing is to point to the tab of all related content of the original post
                        return RequestUtils::addRoute($customPostTypeAPI->getPermalink($notification->object_id), POP_ADDHIGHLIGHTS_ROUTE_HIGHLIGHTS);
                }
                return null;

            case 'message':
                switch ($notification->action) {
                    case AAL_POP_ACTION_POST_HIGHLIGHTEDFROMPOST:
                        return sprintf(
                            TranslationAPIFacade::getInstance()->__('<strong>%s</strong> added a highlight from <strong>%s</strong>', 'poptheme-wassup'),
                            $userTypeAPI->getUserDisplayName($notification->user_id),
                            $customPostTypeAPI->getTitle($notification->object_id)
                        );
                }
                return null;
        }

        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
}

// Static Initialization: Attach
(new PoPTheme_Wassup_AAL_PoP_DataLoad_ObjectTypeFieldResolver_Notifications())->attach(\PoP\ComponentModel\AttachableExtensions\AttachableExtensionGroups::OBJECT_TYPE_FIELD_RESOLVERS, 20);
