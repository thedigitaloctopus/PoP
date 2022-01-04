<?php

declare(strict_types=1);

namespace PoP\AccessControl;

use PoP\ComponentModel\ComponentConfiguration\EnvironmentValueHelpers;

class ComponentConfiguration extends \PoP\BasicService\Component\AbstractComponentConfiguration
{
    private bool $usePrivateSchemaMode = false;
    private bool $enableIndividualControlForPublicPrivateSchemaMode = true;

    public function usePrivateSchemaMode(): bool
    {
        // Define properties
        $envVariable = Environment::USE_PRIVATE_SCHEMA_MODE;
        $selfProperty = &$this->usePrivateSchemaMode;
        $defaultValue = false;
        $callback = [EnvironmentValueHelpers::class, 'toBool'];

        // Initialize property from the environment/hook
        $this->maybeInitializeConfigurationValue(
            $envVariable,
            $selfProperty,
            $defaultValue,
            $callback
        );
        return $selfProperty;
    }

    public function enableIndividualControlForPublicPrivateSchemaMode(): bool
    {
        // Define properties
        $envVariable = Environment::ENABLE_INDIVIDUAL_CONTROL_FOR_PUBLIC_PRIVATE_SCHEMA_MODE;
        $selfProperty = &$this->enableIndividualControlForPublicPrivateSchemaMode;
        $defaultValue = true;
        $callback = [EnvironmentValueHelpers::class, 'toBool'];

        // Initialize property from the environment/hook
        $this->maybeInitializeConfigurationValue(
            $envVariable,
            $selfProperty,
            $defaultValue,
            $callback
        );
        return $selfProperty;
    }

    /**
     * If either constant `USE_PRIVATE_SCHEMA_MODE` or `ENABLE_INDIVIDUAL_CONTROL_FOR_PUBLIC_PRIVATE_SCHEMA_MODE`
     * (which enables to define the private schema mode for a specific entry) is true,
     * then the schema (as obtained by querying the "__schema" field) is dynamic:
     * Fields will be available or not depending on the user being logged in or not
     */
    public function canSchemaBePrivate(): bool
    {
        return
            $this->enableIndividualControlForPublicPrivateSchemaMode()
            || $this->usePrivateSchemaMode();
    }
}
