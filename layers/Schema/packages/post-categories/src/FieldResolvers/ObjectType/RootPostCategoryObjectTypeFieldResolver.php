<?php

declare(strict_types=1);

namespace PoPSchema\PostCategories\FieldResolvers\ObjectType;

use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractQueryableObjectTypeFieldResolver;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\Engine\TypeResolvers\ObjectType\RootObjectTypeResolver;
use PoP\Engine\TypeResolvers\ScalarType\IntScalarTypeResolver;
use PoP\Engine\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoPSchema\Categories\TypeResolvers\InputObjectType\CategoryPaginationInputObjectTypeResolver;
use PoPSchema\Categories\TypeResolvers\InputObjectType\RootCategoriesFilterInputObjectTypeResolver;
use PoPSchema\PostCategories\TypeAPIs\PostCategoryTypeAPIInterface;
use PoPSchema\PostCategories\TypeResolvers\InputObjectType\PostCategoryByInputObjectTypeResolver;
use PoPSchema\PostCategories\TypeResolvers\ObjectType\PostCategoryObjectTypeResolver;
use PoPSchema\SchemaCommons\Constants\QueryOptions;
use PoPSchema\SchemaCommons\DataLoading\ReturnTypes;
use PoPSchema\SchemaCommons\Resolvers\WithLimitFieldArgResolverTrait;
use PoPSchema\Taxonomies\TypeResolvers\InputObjectType\TaxonomySortInputObjectTypeResolver;

class RootPostCategoryObjectTypeFieldResolver extends AbstractQueryableObjectTypeFieldResolver
{
    use WithLimitFieldArgResolverTrait;

    private ?IntScalarTypeResolver $intScalarTypeResolver = null;
    private ?StringScalarTypeResolver $stringScalarTypeResolver = null;
    private ?PostCategoryObjectTypeResolver $postCategoryObjectTypeResolver = null;
    private ?PostCategoryTypeAPIInterface $postCategoryTypeAPI = null;
    private ?PostCategoryByInputObjectTypeResolver $postCategoryByInputObjectTypeResolver = null;
    private ?RootCategoriesFilterInputObjectTypeResolver $rootCategoriesFilterInputObjectTypeResolver = null;
    private ?CategoryPaginationInputObjectTypeResolver $categoryPaginationInputObjectTypeResolver = null;
    private ?TaxonomySortInputObjectTypeResolver $taxonomySortInputObjectTypeResolver = null;

    final public function setIntScalarTypeResolver(IntScalarTypeResolver $intScalarTypeResolver): void
    {
        $this->intScalarTypeResolver = $intScalarTypeResolver;
    }
    final protected function getIntScalarTypeResolver(): IntScalarTypeResolver
    {
        return $this->intScalarTypeResolver ??= $this->instanceManager->getInstance(IntScalarTypeResolver::class);
    }
    final public function setStringScalarTypeResolver(StringScalarTypeResolver $stringScalarTypeResolver): void
    {
        $this->stringScalarTypeResolver = $stringScalarTypeResolver;
    }
    final protected function getStringScalarTypeResolver(): StringScalarTypeResolver
    {
        return $this->stringScalarTypeResolver ??= $this->instanceManager->getInstance(StringScalarTypeResolver::class);
    }
    final public function setPostCategoryObjectTypeResolver(PostCategoryObjectTypeResolver $postCategoryObjectTypeResolver): void
    {
        $this->postCategoryObjectTypeResolver = $postCategoryObjectTypeResolver;
    }
    final protected function getPostCategoryObjectTypeResolver(): PostCategoryObjectTypeResolver
    {
        return $this->postCategoryObjectTypeResolver ??= $this->instanceManager->getInstance(PostCategoryObjectTypeResolver::class);
    }
    final public function setPostCategoryTypeAPI(PostCategoryTypeAPIInterface $postCategoryTypeAPI): void
    {
        $this->postCategoryTypeAPI = $postCategoryTypeAPI;
    }
    final protected function getPostCategoryTypeAPI(): PostCategoryTypeAPIInterface
    {
        return $this->postCategoryTypeAPI ??= $this->instanceManager->getInstance(PostCategoryTypeAPIInterface::class);
    }
    final public function setPostCategoryByInputObjectTypeResolver(PostCategoryByInputObjectTypeResolver $postCategoryByInputObjectTypeResolver): void
    {
        $this->postCategoryByInputObjectTypeResolver = $postCategoryByInputObjectTypeResolver;
    }
    final protected function getPostCategoryByInputObjectTypeResolver(): PostCategoryByInputObjectTypeResolver
    {
        return $this->postCategoryByInputObjectTypeResolver ??= $this->instanceManager->getInstance(PostCategoryByInputObjectTypeResolver::class);
    }
    final public function setRootCategoriesFilterInputObjectTypeResolver(RootCategoriesFilterInputObjectTypeResolver $rootCategoriesFilterInputObjectTypeResolver): void
    {
        $this->rootCategoriesFilterInputObjectTypeResolver = $rootCategoriesFilterInputObjectTypeResolver;
    }
    final protected function getRootCategoriesFilterInputObjectTypeResolver(): RootCategoriesFilterInputObjectTypeResolver
    {
        return $this->rootCategoriesFilterInputObjectTypeResolver ??= $this->instanceManager->getInstance(RootCategoriesFilterInputObjectTypeResolver::class);
    }
    final public function setCategoryPaginationInputObjectTypeResolver(CategoryPaginationInputObjectTypeResolver $categoryPaginationInputObjectTypeResolver): void
    {
        $this->categoryPaginationInputObjectTypeResolver = $categoryPaginationInputObjectTypeResolver;
    }
    final protected function getCategoryPaginationInputObjectTypeResolver(): CategoryPaginationInputObjectTypeResolver
    {
        return $this->categoryPaginationInputObjectTypeResolver ??= $this->instanceManager->getInstance(CategoryPaginationInputObjectTypeResolver::class);
    }
    final public function setTaxonomySortInputObjectTypeResolver(TaxonomySortInputObjectTypeResolver $taxonomySortInputObjectTypeResolver): void
    {
        $this->taxonomySortInputObjectTypeResolver = $taxonomySortInputObjectTypeResolver;
    }
    final protected function getTaxonomySortInputObjectTypeResolver(): TaxonomySortInputObjectTypeResolver
    {
        return $this->taxonomySortInputObjectTypeResolver ??= $this->instanceManager->getInstance(TaxonomySortInputObjectTypeResolver::class);
    }

    public function getObjectTypeResolverClassesToAttachTo(): array
    {
        return [
            RootObjectTypeResolver::class,
        ];
    }

    public function getFieldNamesToResolve(): array
    {
        return [
            'postCategory',
            'postCategories',
            'postCategoryCount',
            'postCategoryNames',
        ];
    }

    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ConcreteTypeResolverInterface
    {
        return match ($fieldName) {
            'postCategory',
            'postCategories'
                => $this->getPostCategoryObjectTypeResolver(),
            'postCategoryCount'
                => $this->getIntScalarTypeResolver(),
            'postCategoryNames'
                => $this->getStringScalarTypeResolver(),
            default
                => parent::getFieldTypeResolver($objectTypeResolver, $fieldName),
        };
    }

    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): int
    {
        return match ($fieldName) {
            'postCategoryCount'
                => SchemaTypeModifiers::NON_NULLABLE,
            'postCategories',
            'postCategoryNames'
                => SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY,
            default
                => parent::getFieldTypeModifiers($objectTypeResolver, $fieldName),
        };
    }

    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ?string
    {
        return match ($fieldName) {
            'postCategory' => $this->getTranslationAPI()->__('Retrieve a single post category', 'post-categories'),
            'postCategories' => $this->getTranslationAPI()->__('Post categories', 'post-categories'),
            'postCategoryCount' => $this->getTranslationAPI()->__('Number of post categories', 'post-categories'),
            'postCategoryNames' => $this->getTranslationAPI()->__('Names of the post categories', 'post-categories'),
            default => parent::getFieldDescription($objectTypeResolver, $fieldName),
        };
    }

    public function getFieldArgNameTypeResolvers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): array
    {
        $fieldArgNameTypeResolvers = parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        return match ($fieldName) {
            'postCategory' => array_merge(
                $fieldArgNameTypeResolvers,
                [
                    'by' => $this->getPostCategoryByInputObjectTypeResolver(),
                ]
            ),
            'postCategories',
            'postCategoryNames' => array_merge(
                $fieldArgNameTypeResolvers,
                [
                    'filter' => $this->getRootCategoriesFilterInputObjectTypeResolver(),
                    'pagination' => $this->getCategoryPaginationInputObjectTypeResolver(),
                    'sort' => $this->getTaxonomySortInputObjectTypeResolver(),
                ]
            ),
            'postCategoryCount' => array_merge(
                $fieldArgNameTypeResolvers,
                [
                    'filter' => $this->getRootCategoriesFilterInputObjectTypeResolver(),
                ]
            ),
            default => $fieldArgNameTypeResolvers,
        };
    }

    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName): int
    {
        return match ([$fieldName => $fieldArgName]) {
            ['postCategory' => 'by'] => SchemaTypeModifiers::MANDATORY,
            default => parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName),
        };
    }

    /**
     * @param array<string, mixed> $fieldArgs
     * @param array<string, mixed>|null $variables
     * @param array<string, mixed>|null $expressions
     * @param array<string, mixed> $options
     */
    public function resolveValue(
        ObjectTypeResolverInterface $objectTypeResolver,
        object $object,
        string $fieldName,
        array $fieldArgs,
        ?array $variables = null,
        ?array $expressions = null,
        array $options = []
    ): mixed {
        $query = $this->convertFieldArgsToFilteringQueryArgs($objectTypeResolver, $fieldName, $fieldArgs);
        switch ($fieldName) {
            case 'postCategory':
                if ($categories = $this->getPostCategoryTypeAPI()->getCategories($query, [QueryOptions::RETURN_TYPE => ReturnTypes::IDS])) {
                    return $categories[0];
                }
                return null;
            case 'postCategories':
                return $this->getPostCategoryTypeAPI()->getCategories($query, [QueryOptions::RETURN_TYPE => ReturnTypes::IDS]);
            case 'postCategoryNames':
                return $this->getPostCategoryTypeAPI()->getCategories($query, [QueryOptions::RETURN_TYPE => ReturnTypes::NAMES]);
            case 'postCategoryCount':
                return $this->getPostCategoryTypeAPI()->getCategoryCount($query);
        }

        return parent::resolveValue($objectTypeResolver, $object, $fieldName, $fieldArgs, $variables, $expressions, $options);
    }
}
