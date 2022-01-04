<?php

declare(strict_types=1);

namespace PoPSchema\Settings;

use PoP\ComponentModel\ComponentConfiguration\EnvironmentValueHelpers;
use PoPSchema\SchemaCommons\Constants\Behaviors;

class ComponentConfiguration extends \PoP\BasicService\Component\AbstractComponentConfiguration
{
    private array $getSettingsEntries = [];
    private string $getSettingsBehavior = Behaviors::ALLOWLIST;

    public function getSettingsEntries(): array
    {
        // Define properties
        $envVariable = Environment::SETTINGS_ENTRIES;
        $selfProperty = &$this->getSettingsEntries;
        $defaultValue = [];
        $callback = [EnvironmentValueHelpers::class, 'commaSeparatedStringToArray'];

        // Initialize property from the environment/hook
        $this->maybeInitializeConfigurationValue(
            $envVariable,
            $selfProperty,
            $defaultValue,
            $callback
        );
        return $selfProperty;
    }

    public function getSettingsBehavior(): string
    {
        // Define properties
        $envVariable = Environment::SETTINGS_BEHAVIOR;
        $selfProperty = &$this->getSettingsBehavior;
        $defaultValue = Behaviors::ALLOWLIST;

        // Initialize property from the environment/hook
        $this->maybeInitializeConfigurationValue(
            $envVariable,
            $selfProperty,
            $defaultValue
        );
        return $selfProperty;
    }
}
