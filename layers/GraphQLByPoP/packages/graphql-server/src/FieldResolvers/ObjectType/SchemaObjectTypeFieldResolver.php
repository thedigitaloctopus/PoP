<?php

declare(strict_types=1);

namespace GraphQLByPoP\GraphQLServer\FieldResolvers\ObjectType;

use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use GraphQLByPoP\GraphQLServer\ObjectModels\Schema;
use GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\DirectiveObjectTypeResolver;
use GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\SchemaExtensionsObjectTypeResolver;
use GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\SchemaObjectTypeResolver;
use GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\TypeObjectTypeResolver;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;

class SchemaObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    private ?TypeObjectTypeResolver $typeObjectTypeResolver = null;
    private ?DirectiveObjectTypeResolver $directiveObjectTypeResolver = null;
    private ?SchemaExtensionsObjectTypeResolver $schemaExtensionsObjectTypeResolver = null;
    private ?StringScalarTypeResolver $stringScalarTypeResolver = null;

    final public function setTypeObjectTypeResolver(TypeObjectTypeResolver $typeObjectTypeResolver): void
    {
        $this->typeObjectTypeResolver = $typeObjectTypeResolver;
    }
    final protected function getTypeObjectTypeResolver(): TypeObjectTypeResolver
    {
        /** @var TypeObjectTypeResolver */
        return $this->typeObjectTypeResolver ??= $this->instanceManager->getInstance(TypeObjectTypeResolver::class);
    }
    final public function setDirectiveObjectTypeResolver(DirectiveObjectTypeResolver $directiveObjectTypeResolver): void
    {
        $this->directiveObjectTypeResolver = $directiveObjectTypeResolver;
    }
    final protected function getDirectiveObjectTypeResolver(): DirectiveObjectTypeResolver
    {
        /** @var DirectiveObjectTypeResolver */
        return $this->directiveObjectTypeResolver ??= $this->instanceManager->getInstance(DirectiveObjectTypeResolver::class);
    }
    final public function setSchemaExtensionsObjectTypeResolver(SchemaExtensionsObjectTypeResolver $schemaExtensionsObjectTypeResolver): void
    {
        $this->schemaExtensionsObjectTypeResolver = $schemaExtensionsObjectTypeResolver;
    }
    final protected function getSchemaExtensionsObjectTypeResolver(): SchemaExtensionsObjectTypeResolver
    {
        /** @var SchemaExtensionsObjectTypeResolver */
        return $this->schemaExtensionsObjectTypeResolver ??= $this->instanceManager->getInstance(SchemaExtensionsObjectTypeResolver::class);
    }
    final public function setStringScalarTypeResolver(StringScalarTypeResolver $stringScalarTypeResolver): void
    {
        $this->stringScalarTypeResolver = $stringScalarTypeResolver;
    }
    final protected function getStringScalarTypeResolver(): StringScalarTypeResolver
    {
        /** @var StringScalarTypeResolver */
        return $this->stringScalarTypeResolver ??= $this->instanceManager->getInstance(StringScalarTypeResolver::class);
    }

    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo(): array
    {
        return [
            SchemaObjectTypeResolver::class,
        ];
    }

    /**
     * @return string[]
     */
    public function getFieldNamesToResolve(): array
    {
        return [
            'queryType',
            'mutationType',
            'subscriptionType',
            'types',
            'directives',
            'type',
            'extensions',
        ];
    }

    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): int
    {
        return match ($fieldName) {
            'queryType',
            'extensions'
                => SchemaTypeModifiers::NON_NULLABLE,
            'types',
            'directives'
                => SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY,
            default
                => parent::getFieldTypeModifiers($objectTypeResolver, $fieldName),
        };
    }

    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ?string
    {
        return match ($fieldName) {
            'queryType' => $this->__('The type, accessible from the root, that resolves queries', 'graphql-server'),
            'mutationType' => $this->__('The type, accessible from the root, that resolves mutations', 'graphql-server'),
            'subscriptionType' => $this->__('The type, accessible from the root, that resolves subscriptions', 'graphql-server'),
            'types' => $this->__('All types registered in the data graph', 'graphql-server'),
            'directives' => $this->__('All directives registered in the data graph', 'graphql-server'),
            'type' => $this->__('Obtain a specific type from the schema', 'graphql-server'),
            'extensions' => $this->__('Extensions (custom metadata) added to the GraphQL schema', 'graphql-server'),
            default => parent::getFieldDescription($objectTypeResolver, $fieldName),
        };
    }

    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getFieldArgNameTypeResolvers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): array
    {
        return match ($fieldName) {
            'type' => [
                'name' => $this->getStringScalarTypeResolver(),
            ],
            default => parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName),
        };
    }

    public function getFieldArgDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName): ?string
    {
        return match ([$fieldName => $fieldArgName]) {
            ['type' => 'name'] => $this->__('The name of the type', 'graphql-server'),
            default => parent::getFieldArgDescription($objectTypeResolver, $fieldName, $fieldArgName),
        };
    }

    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName): int
    {
        return match ([$fieldName => $fieldArgName]) {
            ['type' => 'name'] => SchemaTypeModifiers::MANDATORY,
            default => parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName),
        };
    }

    public function resolveValue(
        ObjectTypeResolverInterface $objectTypeResolver,
        object $object,
        FieldDataAccessorInterface $fieldDataAccessor,
        ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore,
    ): mixed {
        /** @var Schema */
        $schema = $object;
        return match ($fieldDataAccessor->getFieldName()) {
            'queryType' => $schema->getQueryRootObjectTypeID(),
            'mutationType' => $schema->getMutationRootObjectTypeID(),
            'subscriptionType' => $schema->getSubscriptionRootObjectTypeID(),
            'types' => $schema->getTypeIDs(),
            'directives' => $schema->getDirectiveIDs(),
            'type' => $schema->getTypeID($fieldDataAccessor->getValue('name')),
            'extensions' => $schema->getExtensions()->getID(),
            default => parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore),
        };
    }

    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ConcreteTypeResolverInterface
    {
        return match ($fieldName) {
            'queryType',
            'mutationType',
            'subscriptionType',
            'types',
            'type'
                => $this->getTypeObjectTypeResolver(),
            'directives'
                => $this->getDirectiveObjectTypeResolver(),
            'extensions'
                => $this->getSchemaExtensionsObjectTypeResolver(),
            default
                => parent::getFieldTypeResolver($objectTypeResolver, $fieldName),
        };
    }
}
