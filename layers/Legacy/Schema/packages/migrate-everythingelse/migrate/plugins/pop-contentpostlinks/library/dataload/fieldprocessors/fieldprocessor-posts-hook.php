<?php
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\Root\Facades\Translation\TranslationAPIFacade;
use PoPCMSSchema\CustomPosts\TypeResolvers\ObjectType\AbstractCustomPostObjectTypeResolver;
use PoPCMSSchema\PostCategories\Facades\PostCategoryTypeAPIFacade;

class PoP_ContentPostLinks_DataLoad_ObjectTypeFieldResolver_Posts extends AbstractObjectTypeFieldResolver
{
    public function getObjectTypeResolverClassesToAttachTo(): array
    {
        return [
            AbstractCustomPostObjectTypeResolver::class,
        ];
    }

    /**
     * @return string[]
     */
    public function getFieldNamesToResolve(): array
    {
        return [
            'excerpt',
            'content',
            'linkcontent',
            'linkaccess',
            'linkAccessByName',
            'linkcategories',
            'linkCategoriesByName',
            'hasLinkCategories',
        ];
    }

    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): \PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface
    {
        return match($fieldName) {
            'excerpt' => \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver::class,
            'content' => \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver::class,
            'linkcontent' => \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver::class,
            'linkAccessByName' => \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver::class,
            'linkCategoriesByName' => \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver::class,
            'hasLinkCategories' => \PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver::class,
            default => parent::getFieldTypeResolver($objectTypeResolver, $fieldName),
        };
    }

    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): int
    {
        return match($fieldName) {
            'content',
            'hasLinkCategories',
                => SchemaTypeModifiers::NON_NULLABLE,
            'linkcategories',
            'linkCategoriesByName'
                => SchemaTypeModifiers::IS_ARRAY,
            default
                => parent::getFieldTypeModifiers($objectTypeResolver, $fieldName),
        };
    }

    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ?string
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        return match($fieldName) {
            'excerpt' => $translationAPI->__('', ''),
            'content' => $translationAPI->__('', ''),
            'linkcontent' => $translationAPI->__('', ''),
            'linkaccess' => $translationAPI->__('', ''),
            'linkAccessByName' => $translationAPI->__('', ''),
            'linkcategories' => $translationAPI->__('', ''),
            'linkCategoriesByName' => $translationAPI->__('', ''),
            'hasLinkCategories' => $translationAPI->__('', ''),
            default => parent::getFieldDescription($objectTypeResolver, $fieldName),
        };
    }

    // @todo: Migrate to returning an EnumTypeResolverClass in getFieldTypeResolver, then delete this function
    //        Until then, this logic is not working (this function is not invoked anymore)
    protected function getSchemaDefinitionEnumName(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ?string
    {
        switch ($field->getName()) {
            case 'linkaccess':
            case 'linkcategories':
                $input_names = [
                    'linkaccess' => 'LinkAccess',
                    'linkcategories' => 'LinkCategory',
                ];
                return $input_names[$fieldName];
        }
        return null;
    }

    // @todo: Migrate to returning an EnumTypeResolverClass in getFieldTypeResolver, then delete this function
    //        Until then, this logic is not working (this function is not invoked anymore)
    protected function getSchemaDefinitionEnumValues(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ?array
    {
        switch ($field->getName()) {
            case 'linkaccess':
            case 'linkcategories':
                $input_classes = [
                    'linkaccess' => GD_FormInput_LinkAccessDescription::class,
                    'linkcategories' => GD_FormInput_LinkCategories::class,
                ];
                $class = $input_classes[$fieldName];
                return array_keys((new $class())->getAllValues());
        }
        return null;
    }

    /**
     * @todo This function has been removed, adapt it to whatever needs be done!
     */
    public function resolveCanProcessObject(
        ObjectTypeResolverInterface $objectTypeResolver,
        FieldDataAccessorInterface $fieldDataAccessor,
        object $object,
    ): bool {
        if (
            in_array(
                $fieldDataAccessor->getFieldName(),
                [
                    'excerpt',
                    'content',
                ]
            )
        ) {
            $post = $object;
            $postCategoryTypeAPI = PostCategoryTypeAPIFacade::getInstance();
            return defined('POP_CONTENTPOSTLINKS_CAT_CONTENTPOSTLINKS') && POP_CONTENTPOSTLINKS_CAT_CONTENTPOSTLINKS && $postCategoryTypeAPI->hasCategory(POP_CONTENTPOSTLINKS_CAT_CONTENTPOSTLINKS, $objectTypeResolver->getID($post));
        }
        return true;
    }

    public function resolveValue(
        ObjectTypeResolverInterface $objectTypeResolver,
        object $object,
        \PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface $fieldDataAccessor,
        \PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore,
    ): mixed {
        $post = $object;
        switch ($field->getName()) {
            // Override fields for Links
            case 'excerpt':
                return PoP_ContentPostLinks_Utils::getLinkExcerpt($post);
            case 'content':
                return PoP_ContentPostLinks_Utils::getLinkContent($post);

            case 'linkcontent':
                return PoP_ContentPostLinks_Utils::getLinkContent($post, true);

            case 'linkaccess':
                return \PoPCMSSchema\CustomPostMeta\Utils::getCustomPostMeta($objectTypeResolver->getID($post), GD_METAKEY_POST_LINKACCESS, true);

            case 'linkAccessByName':
                $selected = $objectTypeResolver->resolveValue($post, 'linkaccess', $objectTypeFieldResolutionFeedbackStore);
                $linkaccess = new GD_FormInput_LinkAccessDescription('', $selected);
                return $linkaccess->getSelectedValue();

            case 'linkcategories':
                return \PoPCMSSchema\CustomPostMeta\Utils::getCustomPostMeta($objectTypeResolver->getID($post), GD_METAKEY_POST_LINKCATEGORIES);

            case 'linkCategoriesByName':
                $selected = $objectTypeResolver->resolveValue($post, 'linkcategories', $objectTypeFieldResolutionFeedbackStore);
                $linkcategories = new GD_FormInput_LinkCategories('', $selected);
                return $linkcategories->getSelectedValue();

            case 'hasLinkCategories':
                if ($objectTypeResolver->resolveValue($post, 'linkcategories', $objectTypeFieldResolutionFeedbackStore, $options)) {
                    return true;
                }
                return false;
        }

        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
}

// Static Initialization: Attach
(new PoP_ContentPostLinks_DataLoad_ObjectTypeFieldResolver_Posts())->attach(\PoP\ComponentModel\AttachableExtensions\AttachableExtensionGroups::OBJECT_TYPE_FIELD_RESOLVERS, 20);
