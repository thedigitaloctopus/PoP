<?php

declare(strict_types=1);

namespace PoP\ComponentModel\FieldResolvers\ObjectType;

use PoP\ComponentModel\Schema\SchemaDefinition;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InterfaceType\InterfaceTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\Engine\TypeResolvers\ScalarType\BooleanScalarTypeResolver;
use PoP\Engine\TypeResolvers\ScalarType\StringScalarTypeResolver;
use Symfony\Contracts\Service\Attribute\Required;

class CoreGlobalObjectTypeFieldResolver extends AbstractGlobalObjectTypeFieldResolver
{
    protected StringScalarTypeResolver $stringScalarTypeResolver;
    protected BooleanScalarTypeResolver $booleanScalarTypeResolver;

    #[Required]
    public function autowireCoreGlobalObjectTypeFieldResolver(
        StringScalarTypeResolver $stringScalarTypeResolver,
        BooleanScalarTypeResolver $booleanScalarTypeResolver,
    ): void {
        $this->stringScalarTypeResolver = $stringScalarTypeResolver;
        $this->booleanScalarTypeResolver = $booleanScalarTypeResolver;
    }

    public function getFieldNamesToResolve(): array
    {
        return [
            'typeName',
            'namespace',
            'qualifiedTypeName',
            'isType',
            'implements',
        ];
    }

    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ConcreteTypeResolverInterface
    {
        return match ($fieldName) {
            'typeName' => $this->stringScalarTypeResolver,
            'namespace' => $this->stringScalarTypeResolver,
            'qualifiedTypeName' => $this->stringScalarTypeResolver,
            'isType' => $this->booleanScalarTypeResolver,
            'implements' => $this->booleanScalarTypeResolver,
            default => parent::getFieldTypeResolver($objectTypeResolver, $fieldName),
        };
    }

    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ?int
    {
        return match ($fieldName) {
            'typeName',
            'namespace',
            'qualifiedTypeName',
            'isType',
            'implements'
                => SchemaTypeModifiers::NON_NULLABLE,
            default
                => parent::getFieldTypeModifiers($objectTypeResolver, $fieldName),
        };
    }

    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ?string
    {
        return match ($fieldName) {
            'typeName' => $this->translationAPI->__('The object\'s type', 'pop-component-model'),
            'namespace' => $this->translationAPI->__('The object\'s namespace', 'pop-component-model'),
            'qualifiedTypeName' => $this->translationAPI->__('The object\'s namespace + type', 'pop-component-model'),
            'isType' => $this->translationAPI->__('Indicate if the object is of a given type', 'pop-component-model'),
            'implements' => $this->translationAPI->__('Indicate if the object implements a given interface', 'pop-component-model'),
            default => parent::getFieldDescription($objectTypeResolver, $fieldName),
        };
    }

    public function getFieldArgNameResolvers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): array
    {
        return match ($fieldName) {
            'isType' => [
                'type' => $this->stringScalarTypeResolver,
            ],
            'implements' => [
                'interface' => $this->stringScalarTypeResolver,
            ],
            default => parent::getFieldArgNameResolvers($objectTypeResolver, $fieldName),
        };
    }
    
    public function getFieldArgDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName): ?string
    {
        return match ([$fieldName => $fieldArgName]) {
            ['isType' => 'type'] => $this->translationAPI->__('The type name to compare against', 'component-model'),
            ['implements' => 'interface'] => $this->translationAPI->__('The interface name to compare against', 'component-model'),
            default => parent::getFieldArgDescription($objectTypeResolver, $fieldName, $fieldArgName),
        };
    }
    
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName): int
    {
        return match ([$fieldName => $fieldArgName]) {
            ['isType' => 'type'],
            ['implements' => 'interface']
                => SchemaTypeModifiers::MANDATORY,
            default
                => parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName),
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
        array $fieldArgs = [],
        ?array $variables = null,
        ?array $expressions = null,
        array $options = []
    ): mixed {
        switch ($fieldName) {
            case 'typeName':
                return $objectTypeResolver->getTypeName();
            case 'namespace':
                return $objectTypeResolver->getNamespace();
            case 'qualifiedTypeName':
                return $objectTypeResolver->getNamespacedTypeName();
            case 'isType':
                $typeName = $fieldArgs['type'];
                // If the provided typeName contains the namespace separator, then compare by qualifiedType
                if (str_contains($typeName, SchemaDefinition::TOKEN_NAMESPACE_SEPARATOR)) {
                    /**
                     * @todo Replace the code below with:
                     *
                     *     return $typeName == $objectTypeResolver->getNamespacedTypeName();
                     *
                     * Currently, because the GraphQL spec doesn't support namespaces,
                     * we are using "_" as the namespace separator, instead of "/".
                     * But this character can also be part of the Type name!
                     * So only temporarily, compare both the namespaced and the
                     * normal type name, until can use "/".
                     *
                     * @see https://github.com/graphql/graphql-spec/issues/163
                     */
                    return
                        $typeName == $objectTypeResolver->getNamespacedTypeName()
                        || $typeName == $objectTypeResolver->getTypeName();
                }
                return $typeName == $objectTypeResolver->getTypeName();
            case 'implements':
                $interface = $fieldArgs['interface'];
                $implementedInterfaceTypeResolvers = $objectTypeResolver->getAllImplementedInterfaceTypeResolvers();
                // If the provided interface contains the namespace separator, then compare by qualifiedInterface
                $useNamespaced = str_contains($interface, SchemaDefinition::TOKEN_NAMESPACE_SEPARATOR);
                $implementedInterfaceNames = array_map(
                    function (InterfaceTypeResolverInterface $interfaceTypeResolver) use ($useNamespaced) {
                        if ($useNamespaced) {
                            return $interfaceTypeResolver->getNamespacedTypeName();
                        }
                        return $interfaceTypeResolver->getTypeName();
                    },
                    $implementedInterfaceTypeResolvers
                );
                /**
                 * @todo Remove the block of code below.
                 *
                 * Currently, because the GraphQL spec doesn't support namespaces,
                 * we are using "_" as the namespace separator, instead of "/".
                 * But this character can also be part of the Interface name!
                 * So only temporarily, also add the interface names to the
                 * array to compare, until can use "/".
                 *
                 * @see https://github.com/graphql/graphql-spec/issues/163
                 *
                 * -- Begin code --
                 */
                if ($useNamespaced) {
                    $implementedInterfaceNames = array_merge(
                        $implementedInterfaceNames,
                        array_map(
                            function (InterfaceTypeResolverInterface $interfaceTypeResolver) {
                                return $interfaceTypeResolver->getTypeName();
                            },
                            $implementedInterfaceTypeResolvers
                        )
                    );
                }
                /**
                 * -- End code --
                 */
                return in_array($interface, $implementedInterfaceNames);
        }

        return parent::resolveValue($objectTypeResolver, $object, $fieldName, $fieldArgs, $variables, $expressions, $options);
    }
}
