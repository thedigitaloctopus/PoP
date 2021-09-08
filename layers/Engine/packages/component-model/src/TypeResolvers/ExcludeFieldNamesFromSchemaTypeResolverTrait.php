<?php

declare(strict_types=1);

namespace PoP\ComponentModel\TypeResolvers;

use PoP\ComponentModel\ComponentConfiguration;
use PoP\ComponentModel\FieldInterfaceResolvers\FieldInterfaceResolverInterface;
use PoP\ComponentModel\FieldResolvers\FieldResolverInterface;
use PoP\ComponentModel\TypeResolvers\Interface\InterfaceTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\Object\ObjectTypeResolverInterface;

trait ExcludeFieldNamesFromSchemaTypeResolverTrait
{
    /**
     * Call a hook to allow removing fields from the schema
     *
     * @return string[]
     */
    protected function maybeExcludeFieldNamesFromSchema(
        FieldResolverInterface | FieldInterfaceResolverInterface $fieldOrFieldInterfaceResolver,
        array $fieldNames
    ): array {
        // Enable to exclude fieldNames, so they are not added to the schema.
        $excludedFieldNames = [];
        // Whenever:
        // 1. Exclude the admin fields, if "Admin" Schema is not enabled
        if (!ComponentConfiguration::enableAdminSchema()) {
            $excludedFieldNames = $fieldOrFieldInterfaceResolver->getAdminFieldNames();
        }
        // 2. By filter hook
        $excludedFieldNames = $this->hooksAPI->applyFilters(
            Hooks::EXCLUDE_FIELDNAMES,
            $excludedFieldNames,
            $fieldOrFieldInterfaceResolver,
            $fieldNames
        );
        if ($excludedFieldNames !== []) {
            $fieldNames = array_values(array_diff(
                $fieldNames,
                $excludedFieldNames
            ));
        }

        // Execute a hook, allowing to filter them out (eg: removing fieldNames from a private schema)
        // Also pass the Interfaces defining the field
        $interfaceTypeResolverClasses = $fieldOrFieldInterfaceResolver->getPartiallyImplementedInterfaceTypeResolverClasses();
        $fieldNames = array_filter(
            $fieldNames,
            fn ($fieldName) => $this->isFieldNameResolvedByFieldResolver($fieldOrFieldInterfaceResolver, $fieldName, $interfaceTypeResolverClasses)
        );
        return $fieldNames;
    }

    protected function isFieldNameResolvedByFieldResolver(
        FieldResolverInterface | FieldInterfaceResolverInterface $fieldOrFieldInterfaceResolver,
        string $fieldName,
        array $interfaceTypeResolverClasses
    ): bool {
        // Calculate all the interfaces that define this fieldName
        $interfaceTypeResolverClassesForField = array_values(array_filter(
            $interfaceTypeResolverClasses,
            function (string $interfaceTypeResolverClass) use ($fieldName): bool {
                /** @var InterfaceTypeResolverInterface */
                $interfaceTypeResolver = $this->instanceManager->getInstance($interfaceTypeResolverClass);
                return in_array($fieldName, $interfaceTypeResolver->getFieldNamesToImplement());
            }
        ));
        return $this->triggerHookToMaybeFilterFieldName(
            $this,
            $fieldOrFieldInterfaceResolver,
            $fieldName,
            $interfaceTypeResolverClassesForField,
        );
    }

    protected function triggerHookToMaybeFilterFieldName(
        ObjectTypeResolverInterface | InterfaceTypeResolverInterface $objectTypeOrInterfaceTypeResolver,
        FieldResolverInterface | FieldInterfaceResolverInterface $fieldOrFieldInterfaceResolver,
        string $fieldName,
        array $interfaceTypeResolverClassesForField
    ): bool {
        // Execute 2 filters: a generic one, and a specific one
        if (
            $this->hooksAPI->applyFilters(
                HookHelpers::getHookNameToFilterField(),
                true,
                $objectTypeOrInterfaceTypeResolver,
                $fieldOrFieldInterfaceResolver,
                $interfaceTypeResolverClassesForField,
                $fieldName
            )
        ) {
            return $this->hooksAPI->applyFilters(
                HookHelpers::getHookNameToFilterField($fieldName),
                true,
                $objectTypeOrInterfaceTypeResolver,
                $fieldOrFieldInterfaceResolver,
                $interfaceTypeResolverClassesForField,
                $fieldName
            );
        }
        return false;
    }
}
