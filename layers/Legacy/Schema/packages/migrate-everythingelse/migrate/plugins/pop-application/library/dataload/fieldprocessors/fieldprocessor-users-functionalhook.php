<?php
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\Root\Facades\Translation\TranslationAPIFacade;
use PoPCMSSchema\Users\Facades\UserTypeAPIFacade;
use PoPCMSSchema\Users\TypeResolvers\ObjectType\UserObjectTypeResolver;

class PoP_Application_DataLoad_ObjectTypeFieldResolver_FunctionalUsers extends AbstractObjectTypeFieldResolver
{
    public function getObjectTypeResolverClassesToAttachTo(): array
    {
        return [
            UserObjectTypeResolver::class,
        ];
    }

    /**
     * @return string[]
     */
    public function getFieldNamesToResolve(): array
    {
        return [
            'multilayoutKeys',
            'mentionQueryby',
            'descriptionFormatted',
            'excerpt',
        ];
    }

    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): \PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface
    {
        return match($fieldName) {
			'multilayoutKeys' => \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver::class,
            'mentionQueryby' => \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver::class,
            'descriptionFormatted' => \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver::class,
            'excerpt' => \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver::class,
            default => parent::getFieldTypeResolver($objectTypeResolver, $fieldName),
        };
    }

    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): int
    {
        return match($fieldName) {
            'multilayoutKeys' => SchemaTypeModifiers::IS_ARRAY,
            default => parent::getFieldTypeModifiers($objectTypeResolver, $fieldName),
        };
    }

    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ?string
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        return match($fieldName) {
			'multilayoutKeys' => $translationAPI->__('', ''),
            'mentionQueryby' => $translationAPI->__('', ''),
            'descriptionFormatted' => $translationAPI->__('', ''),
            'excerpt' => $translationAPI->__('', ''),
            default => parent::getFieldDescription($objectTypeResolver, $fieldName),
        };
    }

    public function resolveValue(
        ObjectTypeResolverInterface $objectTypeResolver,
        object $object,
        \PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface $fieldDataAccessor,
        \PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore,
    ): mixed {
        $user = $object;
        $userTypeAPI = UserTypeAPIFacade::getInstance();
        $cmsapplicationhelpers = \PoP\Application\HelperAPIFactory::getInstance();
        switch ($field->getName()) {
            case 'multilayoutKeys':
                return array(
                    $objectTypeResolver->resolveValue($user, 'role', $objectTypeFieldResolutionFeedbackStore, $options),
                );

             // Needed for tinyMCE-mention plug-in
            case 'mentionQueryby':
                return $objectTypeResolver->resolveValue($user, 'displayName', $objectTypeFieldResolutionFeedbackStore);

            case 'descriptionFormatted':
                $value = $objectTypeResolver->resolveValue($user, 'description', $objectTypeFieldResolutionFeedbackStore);
                return $cmsapplicationhelpers->makeClickable($cmsapplicationhelpers->convertLinebreaksToHTML(strip_tags($value)));

            case 'excerpt':
                $readmore = sprintf(
                    TranslationAPIFacade::getInstance()->__('... <a href="%s">Read more</a>', 'pop-application'),
                    $userTypeAPI->getUserURL($objectTypeResolver->getID($user))
                );
                // Excerpt length can be set through fieldArgs
                $length = $fieldDataAccessor->getValue('length') ? (int) $fieldDataAccessor->getValue('length') : 300;
                return $cmsapplicationhelpers->makeClickable(limitString(strip_tags($cmsapplicationhelpers->convertLinebreaksToHTML($userTypeAPI->getUserDescription($objectTypeResolver->getID($user)))), $length, $readmore));
        }

        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
}

// Static Initialization: Attach
(new PoP_Application_DataLoad_ObjectTypeFieldResolver_FunctionalUsers())->attach(\PoP\ComponentModel\AttachableExtensions\AttachableExtensionGroups::OBJECT_TYPE_FIELD_RESOLVERS);
