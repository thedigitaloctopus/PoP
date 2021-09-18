<?php

declare(strict_types=1);

namespace PoP\ComponentModel\FieldResolvers\ObjectType;

use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use Exception;
use PoP\ComponentModel\AttachableExtensions\AttachableExtensionTrait;
use PoP\ComponentModel\CheckpointSets\CheckpointSets;
use PoP\ComponentModel\Environment;
use PoP\ComponentModel\ErrorHandling\Error;
use PoP\ComponentModel\Facades\Engine\EngineFacade;
use PoP\ComponentModel\Facades\Schema\SchemaDefinitionServiceFacade;
use PoP\ComponentModel\FieldResolvers\AbstractFieldResolver;
use PoP\ComponentModel\FieldResolvers\InterfaceType\InterfaceTypeFieldResolverInterface;
use PoP\ComponentModel\FieldResolvers\InterfaceType\InterfaceTypeFieldSchemaDefinitionResolverInterface;
use PoP\ComponentModel\FieldResolvers\ObjectType\ObjectTypeFieldSchemaDefinitionResolverInterface;
use PoP\ComponentModel\HelperServices\SemverHelperServiceInterface;
use PoP\ComponentModel\Instances\InstanceManagerInterface;
use PoP\ComponentModel\Misc\GeneralUtils;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoP\ComponentModel\Resolvers\EnumTypeSchemaDefinitionResolverTrait;
use PoP\ComponentModel\Resolvers\FieldOrDirectiveResolverTrait;
use PoP\ComponentModel\Resolvers\InterfaceSchemaDefinitionResolverAdapter;
use PoP\ComponentModel\Resolvers\ResolverTypes;
use PoP\ComponentModel\Resolvers\WithVersionConstraintFieldOrDirectiveResolverTrait;
use PoP\ComponentModel\Schema\FieldQueryInterpreterInterface;
use PoP\ComponentModel\Schema\SchemaDefinition;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\State\ApplicationState;
use PoP\ComponentModel\TypeResolvers\EnumType\EnumTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\RelationalTypeResolverInterface;
use PoP\ComponentModel\Versioning\VersioningHelpers;
use PoP\Engine\CMS\CMSServiceInterface;
use PoP\Hooks\HooksAPIInterface;
use PoP\LooseContracts\NameResolverInterface;
use PoP\Translation\TranslationAPIInterface;

abstract class AbstractObjectTypeFieldResolver extends AbstractFieldResolver implements ObjectTypeFieldResolverInterface, ObjectTypeFieldSchemaDefinitionResolverInterface
{
    use AttachableExtensionTrait;
    use FieldOrDirectiveResolverTrait;
    use WithVersionConstraintFieldOrDirectiveResolverTrait;
    use EnumTypeSchemaDefinitionResolverTrait;

    /**
     * @var array<string, array>
     */
    protected array $schemaDefinitionForFieldCache = [];
    /**
     * @var array<string, ObjectTypeFieldSchemaDefinitionResolverInterface>
     */
    protected array $interfaceTypeFieldSchemaDefinitionResolverCache = [];

    public function __construct(
        TranslationAPIInterface $translationAPI,
        HooksAPIInterface $hooksAPI,
        InstanceManagerInterface $instanceManager,
        protected FieldQueryInterpreterInterface $fieldQueryInterpreter,
        protected NameResolverInterface $nameResolver,
        protected CMSServiceInterface $cmsService,
        protected SemverHelperServiceInterface $semverHelperService,
    ) {
        parent::__construct(
            $translationAPI,
            $hooksAPI,
            $instanceManager,
        );
    }

    final public function getClassesToAttachTo(): array
    {
        return $this->getObjectTypeResolverClassesToAttachTo();
    }

    public function getImplementedInterfaceTypeFieldResolverClasses(): array
    {
        return [];
    }

    /**
     * Implement all the fieldNames defined in the interfaces
     *
     * @return string[]
     */
    public function getFieldNamesFromInterfaces(): array
    {
        $fieldNames = [];

        foreach ($this->getInterfaceTypeFieldResolvers() as $interfaceTypeFieldResolver) {
            $fieldNames = array_merge(
                $fieldNames,
                $interfaceTypeFieldResolver->getFieldNamesToImplement()
            );
        }

        return array_values(array_unique($fieldNames));
    }

    /**
     * Each InterfaceTypeFieldResolver provides a list of fieldNames to the Interface.
     * The Interface may also accept other fieldNames from other InterfaceTypeFieldResolvers.
     * That's why this function is "partially" implemented: the Interface
     * may be completely implemented or not.
     *
     * @return string[]
     */
    final public function getPartiallyImplementedInterfaceTypeResolverClasses(): array
    {
        $interfaceTypeResolverClasses = [];
        foreach ($this->getImplementedInterfaceTypeFieldResolverClasses() as $interfaceTypeFieldResolverClass) {
            /** @var InterfaceTypeFieldResolverInterface */
            $interfaceTypeFieldResolver = $this->instanceManager->getInstance($interfaceTypeFieldResolverClass);
            $interfaceTypeResolverClasses = array_merge(
                $interfaceTypeResolverClasses,
                $interfaceTypeFieldResolver->getPartiallyImplementedInterfaceTypeResolverClasses()
            );
        }
        return array_values(array_unique($interfaceTypeResolverClasses));
    }

    /**
     * Return the object implementing the schema definition for this ObjectTypeFieldResolver.
     */
    final protected function getSchemaDefinitionResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ObjectTypeFieldSchemaDefinitionResolverInterface
    {
        $fieldOrInterfaceTypeFieldSchemaDefinitionResolver = $this->doGetSchemaDefinitionResolver($objectTypeResolver, $fieldName);
        if ($fieldOrInterfaceTypeFieldSchemaDefinitionResolver instanceof InterfaceTypeFieldSchemaDefinitionResolverInterface) {
            // Interfaces do not receive the typeResolver, so we must bridge it
            // First check if the class is cached
            $key = $objectTypeResolver->getNamespacedTypeName() . '|' . $fieldName;
            if (isset($this->interfaceTypeFieldSchemaDefinitionResolverCache[$key])) {
                return $this->interfaceTypeFieldSchemaDefinitionResolverCache[$key];
            }
            // Create an Adapter and cache it
            $interfaceTypeFieldSchemaDefinitionResolver = $fieldOrInterfaceTypeFieldSchemaDefinitionResolver;
            $interfaceSchemaDefinitionResolverAdapterClass = $this->getInterfaceSchemaDefinitionResolverAdapterClass();
            $this->interfaceTypeFieldSchemaDefinitionResolverCache[$key] = new $interfaceSchemaDefinitionResolverAdapterClass($interfaceTypeFieldSchemaDefinitionResolver);
            return $this->interfaceTypeFieldSchemaDefinitionResolverCache[$key];
        }
        $fieldSchemaDefinitionResolver = $fieldOrInterfaceTypeFieldSchemaDefinitionResolver;
        return $fieldSchemaDefinitionResolver;
    }

    /**
     * By default, the resolver is this same object, unless function
     * `getInterfaceTypeFieldSchemaDefinitionResolverClass` is
     * implemented
     */
    protected function doGetSchemaDefinitionResolver(
        ObjectTypeResolverInterface $objectTypeResolver,
        string $fieldName
    ): ObjectTypeFieldSchemaDefinitionResolverInterface | InterfaceTypeFieldSchemaDefinitionResolverInterface {
        if ($interfaceTypeFieldSchemaDefinitionResolverClass = $this->getInterfaceTypeFieldSchemaDefinitionResolverClass($objectTypeResolver, $fieldName)) {
            /** @var InterfaceTypeFieldSchemaDefinitionResolverInterface */
            return $this->instanceManager->getInstance($interfaceTypeFieldSchemaDefinitionResolverClass);
        }
        return $this;
    }

    /**
     * Retrieve the class of some InterfaceTypeFieldSchemaDefinitionResolverInterface
     * By default, if the ObjectTypeFieldResolver implements an interface,
     * it is used as SchemaDefinitionResolver for the matching fields
     */
    protected function getInterfaceTypeFieldSchemaDefinitionResolverClass(
        ObjectTypeResolverInterface $objectTypeResolver,
        string $fieldName
    ): ?string {
        foreach ($this->getImplementedInterfaceTypeFieldResolverClasses() as $implementedInterfaceTypeFieldResolverClass) {
            /** @var InterfaceTypeFieldResolverInterface */
            $implementedInterfaceTypeFieldResolver = $this->instanceManager->getInstance($implementedInterfaceTypeFieldResolverClass);
            ;
            if (!in_array($fieldName, $implementedInterfaceTypeFieldResolver->getFieldNamesToImplement())) {
                continue;
            }
            return $implementedInterfaceTypeFieldResolverClass;
        }
        return null;
    }

    public function getSchemaFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ?int
    {
        $schemaDefinitionResolver = $this->getSchemaDefinitionResolver($objectTypeResolver, $fieldName);
        if ($schemaDefinitionResolver !== $this) {
            return $schemaDefinitionResolver->getSchemaFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
        return null;
    }

    public function getSchemaFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ?string
    {
        $schemaDefinitionResolver = $this->getSchemaDefinitionResolver($objectTypeResolver, $fieldName);
        if ($schemaDefinitionResolver !== $this) {
            return $schemaDefinitionResolver->getSchemaFieldDescription($objectTypeResolver, $fieldName);
        }
        return null;
    }

    public function getSchemaFieldArgs(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): array
    {
        $schemaDefinitionResolver = $this->getSchemaDefinitionResolver($objectTypeResolver, $fieldName);
        if ($schemaDefinitionResolver !== $this) {
            return $schemaDefinitionResolver->getSchemaFieldArgs($objectTypeResolver, $fieldName);
        }
        return [];
    }

    public function getSchemaFieldDeprecationDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, array $fieldArgs = []): ?string
    {
        $schemaDefinitionResolver = $this->getSchemaDefinitionResolver($objectTypeResolver, $fieldName);
        if ($schemaDefinitionResolver !== $this) {
            return $schemaDefinitionResolver->getSchemaFieldDeprecationDescription($objectTypeResolver, $fieldName, $fieldArgs);
        }
        return null;
    }

    /**
     * By default, the field is a scalar of type AnyScalar
     */
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ConcreteTypeResolverInterface
    {
        $schemaDefinitionResolver = $this->getSchemaDefinitionResolver($objectTypeResolver, $fieldName);
        if ($schemaDefinitionResolver !== $this) {
            return $schemaDefinitionResolver->getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
        $schemaDefinitionService = SchemaDefinitionServiceFacade::getInstance();
        return $schemaDefinitionService->getDefaultTypeResolver();
    }

    /**
     * Validate the constraints for a field argument
     *
     * @return string[] Error messages
     */
    public function validateFieldArgument(
        ObjectTypeResolverInterface $objectTypeResolver,
        string $fieldName,
        string $fieldArgName,
        mixed $fieldArgValue
    ): array {
        $schemaDefinitionResolver = $this->getSchemaDefinitionResolver($objectTypeResolver, $fieldName);
        if ($schemaDefinitionResolver !== $this) {
            return $schemaDefinitionResolver->validateFieldArgument($objectTypeResolver, $fieldName, $fieldArgName, $fieldArgValue);
        }
        return [];
    }

    public function addSchemaDefinitionForField(array &$schemaDefinition, ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): void
    {
        $schemaDefinitionResolver = $this->getSchemaDefinitionResolver($objectTypeResolver, $fieldName);
        if ($schemaDefinitionResolver !== $this) {
            $schemaDefinitionResolver->addSchemaDefinitionForField($schemaDefinition, $objectTypeResolver, $fieldName);
            return;
        }

        $this->addSchemaDefinitionForEnumField($schemaDefinition, $objectTypeResolver, $fieldName);
    }

    /**
     * Add the enum values in the schema: arrays of enum name, description, deprecated and deprecation description
     */
    protected function addSchemaDefinitionForEnumField(array &$schemaDefinition, ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): void
    {
        $fieldTypeResolver = $this->getFieldTypeResolver($objectTypeResolver, $fieldName);
        if ($fieldTypeResolver instanceof EnumTypeResolverInterface) {
            $fieldEnumTypeResolver = $fieldTypeResolver;
            $this->doAddSchemaDefinitionEnumValuesForField(
                $schemaDefinition,
                $fieldEnumTypeResolver->getEnumValues(),
                $fieldEnumTypeResolver->getEnumValueDeprecationMessages(),
                $fieldEnumTypeResolver->getEnumValueDescriptions(),
                $fieldEnumTypeResolver->getMaybeNamespacedTypeName()
            );
        }
    }

    public function isGlobal(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): bool
    {
        return false;
    }

    /**
     * Implement all the fieldNames defined in the interfaces
     *
     * @return InterfaceTypeFieldResolverInterface[]
     */
    public function getInterfaceTypeFieldResolvers(): array
    {
        return array_map(
            function (string $class) {
                return $this->instanceManager->getInstance($class);
            },
            $this->getImplementedInterfaceTypeFieldResolverClasses()
        );
    }

    /**
     * Define if to use the version to decide if to process the field or not
     */
    public function decideCanProcessBasedOnVersionConstraint(ObjectTypeResolverInterface $objectTypeResolver): bool
    {
        return false;
    }

    /**
     * Indicates if the fieldResolver can process this combination of fieldName and fieldArgs
     * It is required to support a multiverse of fields: different fieldResolvers can resolve the field, based on the required version (passed through $fieldArgs['branch'])
     *
     * @param array<string, mixed> $fieldArgs
     */
    public function resolveCanProcess(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, array $fieldArgs = []): bool
    {
        /** Check if to validate the version */
        if (
            Environment::enableSemanticVersionConstraints() &&
            $this->decideCanProcessBasedOnVersionConstraint($objectTypeResolver)
        ) {
            /**
             * Please notice: we can get the fieldVersion directly from this instance,
             * and not from the schemaDefinition, because the version is set at the ObjectTypeFieldResolver level,
             * and not the InterfaceTypeFieldResolver, which is the other entity filling data
             * inside the schemaDefinition object.
             * If this field is tagged with a version...
             */
            if ($schemaFieldVersion = $this->getSchemaFieldVersion($objectTypeResolver, $fieldName)) {
                $vars = ApplicationState::getVars();
                /**
                 * Get versionConstraint in this order:
                 * 1. Passed as field argument
                 * 2. Through param `fieldVersionConstraints[$fieldName]`: specific to the namespaced type + field
                 * 3. Through param `fieldVersionConstraints[$fieldName]`: specific to the type + field
                 * 4. Through param `versionConstraint`: applies to all fields and directives in the query
                 */
                $versionConstraint =
                    $fieldArgs[SchemaDefinition::ARGNAME_VERSION_CONSTRAINT]
                    ?? VersioningHelpers::getVersionConstraintsForField(
                        $objectTypeResolver->getNamespacedTypeName(),
                        $fieldName
                    )
                    ?? VersioningHelpers::getVersionConstraintsForField(
                        $objectTypeResolver->getTypeName(),
                        $fieldName
                    )
                    ?? $vars['version-constraint'];
                /**
                 * If the query doesn't restrict the version, then do not process
                 */
                if (!$versionConstraint) {
                    return false;
                }
                /**
                 * Compare using semantic versioning constraint rules, as used by Composer
                 * If passing a wrong value to validate against (eg: "saraza" instead of "1.0.0"), it will throw an Exception
                 */
                try {
                    return $this->semverHelperService->satisfies($schemaFieldVersion, $versionConstraint);
                } catch (Exception) {
                    return false;
                }
            }
        }
        return true;
    }
    public function resolveSchemaValidationErrorDescriptions(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, array $fieldArgs = []): ?array
    {
        $canValidateFieldOrDirectiveArgumentsWithValuesForSchema = $this->canValidateFieldOrDirectiveArgumentsWithValuesForSchema($fieldArgs);
        $fieldSchemaDefinition = $this->getSchemaDefinitionForField($objectTypeResolver, $fieldName, $fieldArgs);
        if ($fieldArgsSchemaDefinition = $fieldSchemaDefinition[SchemaDefinition::ARGNAME_ARGS] ?? null) {
            /**
             * Validate mandatory values. If it produces errors, return immediately
             */
            if (
                $maybeError = $this->validateNotMissingFieldOrDirectiveArguments(
                    $fieldArgsSchemaDefinition,
                    $fieldName,
                    $fieldArgs,
                    ResolverTypes::FIELD
                )
            ) {
                return [$maybeError];
            }

            if ($canValidateFieldOrDirectiveArgumentsWithValuesForSchema) {
                /**
                 * Validate array types are provided as arrays. If it produces errors, return immediately
                 */
                if (
                    $maybeErrors = $this->validateArrayTypeFieldOrDirectiveArguments(
                        $fieldArgsSchemaDefinition,
                        $fieldName,
                        $fieldArgs,
                        ResolverTypes::FIELD
                    )
                ) {
                    return $maybeErrors;
                }

                /**
                 * Validate enums
                 */
                if (
                    $maybeErrors = $this->validateEnumFieldOrDirectiveArguments(
                        $fieldArgsSchemaDefinition,
                        $fieldName,
                        $fieldArgs,
                        ResolverTypes::FIELD
                    )
                ) {
                    return $maybeErrors;
                }
            }
        }
        if ($canValidateFieldOrDirectiveArgumentsWithValuesForSchema) {
            /**
             * Validate field argument constraints
             */
            if (
                $maybeErrors = $this->resolveFieldArgumentErrors(
                    $objectTypeResolver,
                    $fieldName,
                    $fieldArgs
                )
            ) {
                return $maybeErrors;
            }
        }
        // If a MutationResolver is declared, let it resolve the value
        $mutationResolver = $this->getFieldMutationResolver($objectTypeResolver, $fieldName);
        if ($mutationResolver !== null) {
            // Validate on the schema?
            if (!$this->validateMutationOnObject($objectTypeResolver, $fieldName)) {
                return $mutationResolver->validateErrors($fieldArgs);
            }
        }

        // Custom validations
        return $this->doResolveSchemaValidationErrorDescriptions(
            $objectTypeResolver,
            $fieldName,
            $fieldArgs,
        );
    }

    /**
     * Validate the constraints for the field arguments
     */
    final protected function resolveFieldArgumentErrors(
        ObjectTypeResolverInterface $objectTypeResolver,
        string $fieldName,
        array $fieldArgs = []
    ): array {
        $errors = [];
        foreach ($fieldArgs as $fieldArgName => $fieldArgValue) {
            if (
                $maybeErrors = $this->validateFieldArgument(
                    $objectTypeResolver,
                    $fieldName,
                    $fieldArgName,
                    $fieldArgValue
                )
            ) {
                $errors = array_merge(
                    $errors,
                    $maybeErrors
                );
            }
        }
        return $errors;
    }

    /**
     * Custom validations. Function to override
     */
    protected function doResolveSchemaValidationErrorDescriptions(
        ObjectTypeResolverInterface $objectTypeResolver,
        string $fieldName,
        array $fieldArgs = []
    ): ?array {
        return null;
    }

    public function resolveSchemaValidationDeprecationDescriptions(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, array $fieldArgs = []): ?array
    {
        $fieldSchemaDefinition = $this->getSchemaDefinitionForField($objectTypeResolver, $fieldName, $fieldArgs);
        if ($fieldArgsSchemaDefinition = $fieldSchemaDefinition[SchemaDefinition::ARGNAME_ARGS] ?? null) {
            return $this->getEnumFieldOrDirectiveArgumentDeprecations(
                $fieldArgsSchemaDefinition,
                $fieldName,
                $fieldArgs,
                ResolverTypes::FIELD
            );
        }
        return null;
    }

    /**
     * Fields may not be directly visible in the schema,
     * eg: because they are used only by the application, and must not
     * be exposed to the user (eg: "accessControlLists")
     */
    public function skipAddingToSchemaDefinition(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): bool
    {
        return false;
    }

    /**
     * Get the "schema" properties as for the fieldName
     */
    final public function getSchemaDefinitionForField(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, array $fieldArgs = []): array
    {
        // First check if the value was cached
        $key = $objectTypeResolver->getNamespacedTypeName() . '|' . $fieldName . '|' . json_encode($fieldArgs);
        if (!isset($this->schemaDefinitionForFieldCache[$key])) {
            $this->schemaDefinitionForFieldCache[$key] = $this->doGetSchemaDefinitionForField($objectTypeResolver, $fieldName, $fieldArgs);
        }
        return $this->schemaDefinitionForFieldCache[$key];
    }

    /**
     * Get the "schema" properties as for the fieldName
     */
    final public function doGetSchemaDefinitionForField(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, array $fieldArgs = []): array
    {
        $schemaDefinition = [
            SchemaDefinition::ARGNAME_NAME => $fieldName,
        ];

        // If we found a resolver for this fieldName, get all its properties from it
        $schemaDefinitionResolver = $this->getSchemaDefinitionResolver($objectTypeResolver, $fieldName);
        $fieldTypeResolver = $schemaDefinitionResolver->getFieldTypeResolver($objectTypeResolver, $fieldName);
        if ($fieldTypeResolver instanceof RelationalTypeResolverInterface) {
            $type = $fieldTypeResolver->getMaybeNamespacedTypeName();
            $schemaDefinition[SchemaDefinition::ARGNAME_RELATIONAL] = true;
        } elseif ($fieldTypeResolver instanceof EnumTypeResolverInterface) {
            $type = SchemaDefinition::TYPE_ENUM;
            $schemaDefinition[SchemaDefinition::ARGNAME_ENUM_NAME] = $fieldTypeResolver->getMaybeNamespacedTypeName();
        } else {
            // Scalar type
            $type = $fieldTypeResolver->getMaybeNamespacedTypeName();
        }
        $schemaDefinition[SchemaDefinition::ARGNAME_TYPE] = $type;

        // Use bitwise operators to extract the applied modifiers
        // @see https://www.php.net/manual/en/language.operators.bitwise.php#91291
        $schemaTypeModifiers = $schemaDefinitionResolver->getSchemaFieldTypeModifiers($objectTypeResolver, $fieldName);
        if ($schemaTypeModifiers & SchemaTypeModifiers::NON_NULLABLE) {
            $schemaDefinition[SchemaDefinition::ARGNAME_NON_NULLABLE] = true;
        }
        // If setting the "array of arrays" flag, there's no need to set the "array" flag
        $isArrayOfArrays = $schemaTypeModifiers & SchemaTypeModifiers::IS_ARRAY_OF_ARRAYS;
        if (
            $schemaTypeModifiers & SchemaTypeModifiers::IS_ARRAY
            || $isArrayOfArrays
        ) {
            $schemaDefinition[SchemaDefinition::ARGNAME_IS_ARRAY] = true;
            if ($schemaTypeModifiers & SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY) {
                $schemaDefinition[SchemaDefinition::ARGNAME_IS_NON_NULLABLE_ITEMS_IN_ARRAY] = true;
            }
            if ($isArrayOfArrays) {
                $schemaDefinition[SchemaDefinition::ARGNAME_IS_ARRAY_OF_ARRAYS] = true;
                if ($schemaTypeModifiers & SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY_OF_ARRAYS) {
                    $schemaDefinition[SchemaDefinition::ARGNAME_IS_NON_NULLABLE_ITEMS_IN_ARRAY_OF_ARRAYS] = true;
                }
            }
        }
        if ($description = $schemaDefinitionResolver->getSchemaFieldDescription($objectTypeResolver, $fieldName)) {
            $schemaDefinition[SchemaDefinition::ARGNAME_DESCRIPTION] = $description;
        }
        if ($deprecationDescription = $schemaDefinitionResolver->getSchemaFieldDeprecationDescription($objectTypeResolver, $fieldName, $fieldArgs)) {
            $schemaDefinition[SchemaDefinition::ARGNAME_DEPRECATED] = true;
            $schemaDefinition[SchemaDefinition::ARGNAME_DEPRECATIONDESCRIPTION] = $deprecationDescription;
        }
        if ($args = $schemaDefinitionResolver->getSchemaFieldArgs($objectTypeResolver, $fieldName)) {
            $schemaDefinition[SchemaDefinition::ARGNAME_ARGS] = $this->getFilteredSchemaFieldArgs(
                $objectTypeResolver,
                $fieldName,
                $args
            );
        }
        $schemaDefinitionResolver->addSchemaDefinitionForField($schemaDefinition, $objectTypeResolver, $fieldName);

        /**
         * Please notice: the version always comes from the fieldResolver, and not from the schemaDefinitionResolver
         * That is because it is the implementer the one who knows what version it is, and not the one defining the interface
         * If the interface changes, the implementer will need to change, so the version will be upgraded
         * But it could also be that the contract doesn't change, but the implementation changes
         * In particular, Interfaces are schemaDefinitionResolver, but they must not indicate the version...
         * it's really not their responsibility
         */
        if (Environment::enableSemanticVersionConstraints()) {
            if ($version = $this->getSchemaFieldVersion($objectTypeResolver, $fieldName)) {
                $schemaDefinition[SchemaDefinition::ARGNAME_VERSION] = $version;
            }
        }
        if ($this->getFieldMutationResolver($objectTypeResolver, $fieldName) !== null) {
            $schemaDefinition[SchemaDefinition::ARGNAME_FIELD_IS_MUTATION] = true;
        }

        // Hook to override the values, eg: by the Field Deprecation List
        return $this->triggerHookToOverrideSchemaDefinition(
            $schemaDefinition,
            $objectTypeResolver,
            $fieldName,
            $fieldArgs
        );
    }

    protected function getInterfaceSchemaDefinitionResolverAdapterClass(): string
    {
        return InterfaceSchemaDefinitionResolverAdapter::class;
    }

    /**
     * Processes the field args:
     *
     * 1. Adds the version constraint (if enabled)
     * 2. Places all entries under their own name
     * 3. If any entry has no name, it is skipped
     *
     * @return array<string, array>
     */
    protected function getFilteredSchemaFieldArgs(
        ObjectTypeResolverInterface $objectTypeResolver,
        string $fieldName,
        array $schemaFieldArgs
    ): array {
        /**
         * Add the "versionConstraint" param. Add it at the end, so it doesn't affect the order of params for "orderedSchemaFieldArgs"
         */
        $this->maybeAddVersionConstraintSchemaFieldOrDirectiveArg(
            $schemaFieldArgs,
            $this->hasSchemaFieldVersion($objectTypeResolver, $fieldName)
        );

        // Add the args under their name. Watch out: the name is mandatory!
        // If it hasn't been set, then skip the entry
        $schemaFieldArgsByName = [];
        foreach ($schemaFieldArgs as $arg) {
            if (!isset($arg[SchemaDefinition::ARGNAME_NAME])) {
                continue;
            }
            $schemaFieldArgsByName[$arg[SchemaDefinition::ARGNAME_NAME]] = $arg;
        }
        return $schemaFieldArgsByName;
    }

    public function enableOrderedSchemaFieldArgs(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): bool
    {
        return true;
    }

    public function getSchemaFieldVersion(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ?string
    {
        return null;
    }

    protected function hasSchemaFieldVersion(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): bool
    {
        return !empty($this->getSchemaFieldVersion($objectTypeResolver, $fieldName));
    }

    public function resolveSchemaValidationWarningDescriptions(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, array $fieldArgs = []): ?array
    {
        $warnings = [];
        if (Environment::enableSemanticVersionConstraints()) {
            /**
             * If restricting the version, and this fieldResolver doesn't have any version, then show a warning
             */
            if ($versionConstraint = $fieldArgs[SchemaDefinition::ARGNAME_VERSION_CONSTRAINT] ?? null) {
                /**
                 * If this fieldResolver doesn't have versioning, then it accepts everything
                 */
                if (!$this->decideCanProcessBasedOnVersionConstraint($objectTypeResolver)) {
                    $warnings[] = sprintf(
                        $this->translationAPI->__('The ObjectTypeFieldResolver used to process field with name \'%s\' (which has version \'%s\') does not pay attention to the version constraint; hence, argument \'versionConstraint\', with value \'%s\', was ignored', 'component-model'),
                        $fieldName,
                        $this->getSchemaFieldVersion($objectTypeResolver, $fieldName) ?? '',
                        $versionConstraint
                    );
                }
            }
        }
        // If a MutationResolver is declared, let it resolve the value
        $mutationResolver = $this->getFieldMutationResolver($objectTypeResolver, $fieldName);
        if ($mutationResolver !== null) {
            return $mutationResolver->validateWarnings($fieldArgs);
        }
        return $warnings;
    }

    /**
     * @param array<string, mixed> $fieldArgs
     */
    public function resolveCanProcessObject(
        ObjectTypeResolverInterface $objectTypeResolver,
        object $object,
        string $fieldName,
        array $fieldArgs = []
    ): bool {
        return true;
    }

    /**
     * @param array<string, mixed> $fieldArgs
     * @return array<array>|null A checkpoint set, or null
     */
    protected function getValidationCheckpoints(
        ObjectTypeResolverInterface $objectTypeResolver,
        object $object,
        string $fieldName,
        array $fieldArgs = []
    ): ?array {
        // Check that mutations can be executed
        if ($this->getFieldMutationResolver($objectTypeResolver, $fieldName) !== null) {
            return CheckpointSets::CAN_EXECUTE_MUTATIONS;
        }
        return null;
    }

    /**
     * @param array<string, mixed> $fieldArgs
     */
    protected function getValidationCheckpointsErrorMessage(
        Error $error,
        string $errorMessage,
        ObjectTypeResolverInterface $objectTypeResolver,
        object $object,
        string $fieldName,
        array $fieldArgs = []
    ): string {
        return $errorMessage;
    }

    /**
     * @param array<string, mixed> $fieldArgs
     */
    public function getValidationErrorDescriptions(
        ObjectTypeResolverInterface $objectTypeResolver,
        object $object,
        string $fieldName,
        array $fieldArgs = []
    ): ?array {
        // Can perform validation through checkpoints
        if ($checkpoints = $this->getValidationCheckpoints($objectTypeResolver, $object, $fieldName, $fieldArgs)) {
            $engine = EngineFacade::getInstance();
            $validation = $engine->validateCheckpoints($checkpoints);
            if (GeneralUtils::isError($validation)) {
                $error = $validation;
                $errorMessage = $error->getMessageOrCode();
                // Allow to customize the error message for the failing entity
                return [
                    $this->getValidationCheckpointsErrorMessage($error, $errorMessage, $objectTypeResolver, $object, $fieldName, $fieldArgs)
                ];
            }
        }

        // If a MutationResolver is declared, let it resolve the value
        $mutationResolver = $this->getFieldMutationResolver($objectTypeResolver, $fieldName);
        if ($mutationResolver !== null && $this->validateMutationOnObject($objectTypeResolver, $fieldName)) {
            // Validate on the object
            $mutationFieldArgs = $this->getFieldArgsToExecuteMutation(
                $fieldArgs,
                $objectTypeResolver,
                $object,
                $fieldName
            );
            return $mutationResolver->validateErrors($mutationFieldArgs);
        }

        return null;
    }

    /**
     * The mutation can be validated either on the schema (`false`)
     * on on the object (`true`)
     */
    public function validateMutationOnObject(
        ObjectTypeResolverInterface $objectTypeResolver,
        string $fieldName
    ): bool {
        return false;
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
        // If a MutationResolver is declared, let it resolve the value
        $mutationResolver = $this->getFieldMutationResolver($objectTypeResolver, $fieldName);
        if ($mutationResolver !== null) {
            $mutationFieldArgs = $this->getFieldArgsToExecuteMutation(
                $fieldArgs,
                $objectTypeResolver,
                $object,
                $fieldName
            );
            return $mutationResolver->execute($mutationFieldArgs);
        }
        return null;
    }

    protected function getFieldArgsToExecuteMutation(
        array $fieldArgs,
        ObjectTypeResolverInterface $objectTypeResolver,
        object $object,
        string $fieldName
    ): array {
        return $fieldArgs;
    }

    public function getFieldMutationResolver(
        ObjectTypeResolverInterface $objectTypeResolver,
        string $fieldName
    ): ?MutationResolverInterface {
        return null;
    }
}
