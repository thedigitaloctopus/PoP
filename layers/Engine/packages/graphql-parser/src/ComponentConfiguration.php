<?php

declare(strict_types=1);

namespace PoP\GraphQLParser;

use PoP\ComponentModel\ComponentConfiguration\EnvironmentValueHelpers;

class ComponentConfiguration extends \PoP\BasicService\Component\AbstractComponentConfiguration
{
    private bool $enableMultipleQueryExecution = false;
    private bool $enableComposableDirectives = false;

    /**
     * Disable hook, because it is invoked by `export-directive`
     * on its Component's `resolveEnabled` function.
     */
    public function enableMultipleQueryExecution(): bool
    {
        // Define properties
        $envVariable = Environment::ENABLE_MULTIPLE_QUERY_EXECUTION;
        $selfProperty = &$this->enableMultipleQueryExecution;
        $defaultValue = false;
        $callback = [EnvironmentValueHelpers::class, 'toBool'];

        // Initialize property from the environment
        $this->maybeInitializeConfigurationValue(
            $envVariable,
            $selfProperty,
            $defaultValue,
            $callback
        );
        return $selfProperty;
    }

    public function enableComposableDirectives(): bool
    {
        // Define properties
        $envVariable = Environment::ENABLE_COMPOSABLE_DIRECTIVES;
        $selfProperty = &$this->enableComposableDirectives;
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
}
