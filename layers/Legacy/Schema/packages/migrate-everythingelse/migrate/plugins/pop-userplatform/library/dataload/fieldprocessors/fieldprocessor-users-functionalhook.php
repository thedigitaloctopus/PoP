<?php
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\Root\Facades\Translation\TranslationAPIFacade;
use PoPCMSSchema\Users\TypeResolvers\ObjectType\UserObjectTypeResolver;

class GD_UserPlatform_DataLoad_ObjectTypeFieldResolver_FunctionalUsers extends AbstractObjectTypeFieldResolver
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
            'shortDescriptionFormatted',
            'contactSmall',
            'userPreferences',
        ];
    }

    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): \PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface
    {
        return match($fieldName) {
            'shortDescriptionFormatted' => \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver::class,
            'contactSmall' => \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver::class,
            'userPreferences' => \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver::class,
            default => parent::getFieldTypeResolver($objectTypeResolver, $fieldName),
        };
    }

    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): int
    {
        return match($fieldName) {
            'userPreferences' => SchemaTypeModifiers::IS_ARRAY,
            default => parent::getFieldTypeModifiers($objectTypeResolver, $fieldName),
        };
    }

    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ?string
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        return match($fieldName) {
            'shortDescriptionFormatted' => $translationAPI->__('', ''),
            'contactSmall' => $translationAPI->__('', ''),
            'userPreferences' => $translationAPI->__('', ''),
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
        $cmsapplicationhelpers = \PoP\Application\HelperAPIFactory::getInstance();
        switch ($field->getName()) {
            case 'shortDescriptionFormatted':
                // doing esc_html so that single quotes ("'") do not screw the map output
                $value = $objectTypeResolver->resolveValue($user, 'shortDescription', $objectTypeFieldResolutionFeedbackStore);
                return $cmsapplicationhelpers->makeClickable($cmsapplicationhelpers->escapeHTML($value));

            case 'contactSmall':
                $value = array();
                $contacts = $objectTypeResolver->resolveValue($user, 'contact', $objectTypeFieldResolutionFeedbackStore);
                // Remove text, replace all icons with their shorter version
                foreach ($contacts as $contact) {
                    $value[] = array(
                        'tooltip' => $contact['tooltip'],
                        'url' => $contact['url'],
                        'fontawesome' => $contact['fontawesome']
                    );
                }
                return $value;

         // User preferences
            case 'userPreferences':
                return \PoPCMSSchema\UserMeta\Utils::getUserMeta($objectTypeResolver->getID($user), GD_METAKEY_PROFILE_USERPREFERENCES);
        }

        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
}

// Static Initialization: Attach
(new GD_UserPlatform_DataLoad_ObjectTypeFieldResolver_FunctionalUsers())->attach(\PoP\ComponentModel\AttachableExtensions\AttachableExtensionGroups::OBJECT_TYPE_FIELD_RESOLVERS);
