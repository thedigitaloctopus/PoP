<?php

declare(strict_types=1);

namespace PoPSchema\Categories\FieldResolvers\ObjectType;

use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\Schema\SchemaDefinition;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoPSchema\Categories\ComponentContracts\CategoryAPIRequestedContractTrait;
use PoPSchema\QueriedObject\FieldResolvers\InterfaceType\QueryableInterfaceTypeFieldResolver;

abstract class AbstractCategoryObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    use CategoryAPIRequestedContractTrait;

    public function getImplementedInterfaceTypeFieldResolverClasses(): array
    {
        return [
            QueryableInterfaceTypeFieldResolver::class,
        ];
    }

    public function getFieldNamesToResolve(): array
    {
        return [
            'url',
            'urlPath',
            'slug',
            'name',
            'description',
            'count',
            'parentCategory',
        ];
    }

    public function getSchemaFieldType(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): string
    {
        $types = [
            'name' => SchemaDefinition::TYPE_STRING,
            'description' => SchemaDefinition::TYPE_STRING,
            'count' => SchemaDefinition::TYPE_INT,
        ];
        return $types[$fieldName] ?? parent::getSchemaFieldType($objectTypeResolver, $fieldName);
    }

    public function getSchemaFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ?int
    {
        return match ($fieldName) {
            'name',
            'count'
                => SchemaTypeModifiers::NON_NULLABLE,
            default
                => parent::getSchemaFieldTypeModifiers($objectTypeResolver, $fieldName),
        };
    }

    public function getSchemaFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ?string
    {
        $descriptions = [
            'url' => $this->translationAPI->__('Category URL', 'pop-categories'),
            'urlPath' => $this->translationAPI->__('Category URL path', 'pop-categories'),
            'slug' => $this->translationAPI->__('Category slug', 'pop-categories'),
            'name' => $this->translationAPI->__('Category', 'pop-categories'),
            'description' => $this->translationAPI->__('Category description', 'pop-categories'),
            'parentCategory' => $this->translationAPI->__('Parent category (if this category is a child of another one)', 'pop-categories'),
            'count' => $this->translationAPI->__('Number of custom posts containing this category', 'pop-categories'),
        ];
        return $descriptions[$fieldName] ?? parent::getSchemaFieldDescription($objectTypeResolver, $fieldName);
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
        array $fieldArgs = [],
        ?array $variables = null,
        ?array $expressions = null,
        array $options = []
    ): mixed {
        $categoryTypeAPI = $this->getCategoryTypeAPI();
        $category = $object;
        switch ($fieldName) {
            case 'url':
                return $categoryTypeAPI->getCategoryURL($objectTypeResolver->getID($category));

            case 'urlPath':
                return $categoryTypeAPI->getCategoryURLPath($objectTypeResolver->getID($category));

            case 'name':
                return $categoryTypeAPI->getCategoryName($objectTypeResolver->getID($category));

            case 'slug':
                return $categoryTypeAPI->getCategorySlug($category);

            case 'description':
                return $categoryTypeAPI->getCategoryDescription($category);

            case 'parentCategory':
                return $categoryTypeAPI->getCategoryParentID($objectTypeResolver->getID($category));

            case 'count':
                return $categoryTypeAPI->getCategoryItemCount($category);
        }

        return parent::resolveValue($objectTypeResolver, $object, $fieldName, $fieldArgs, $variables, $expressions, $options);
    }

    public function getFieldTypeResolverClass(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ?string
    {
        switch ($fieldName) {
            case 'parentCategory':
                return $this->getCategoryTypeResolverClass();
        }

        return parent::getFieldTypeResolverClass($objectTypeResolver, $fieldName);
    }
}