<?php

declare(strict_types=1);

namespace PoPSchema\LocationPosts;

use PoPSchema\LocationPosts\Environment;
use PoP\Root\Component\AbstractComponent;

/**
 * Initialize component
 */
class Component extends AbstractComponent
{
    /**
     * Classes from PoP components that must be initialized before this component
     *
     * @return string[]
     */
    public static function getDependedComponentClasses(): array
    {
        return [
            \PoPSchema\Posts\Component::class,
        ];
    }

    /**
     * All conditional component classes that this component depends upon, to initialize them
     *
     * @return array
     */
    public static function getDependedConditionalComponentClasses(): array
    {
        return [
            \PoPSchema\Users\Component::class,
            \PoPSchema\Tags\Component::class,
        ];
    }

    /**
     * Initialize services
     *
     * @param array<string, mixed> $configuration
     * @param string[] $skipSchemaComponentClasses
     */
    protected static function initializeContainerServices(
        array $configuration = [],
        bool $skipSchema = false,
        array $skipSchemaComponentClasses = []
    ): void {
        parent::initializeContainerServices($configuration, $skipSchema, $skipSchemaComponentClasses);
        self::maybeInitYAMLSchemaServices(dirname(__DIR__), $skipSchema);

        if (Environment::addLocationPostTypeToCustomPostUnionTypes()) {
            self::maybeInitPHPSchemaServices(dirname(__DIR__), $skipSchema, '/ConditionalOnEnvironment/AddLocationPostTypeToCustomPostUnionTypes');
        }

        if (
            class_exists('\PoPSchema\Tags\Component')
            && !in_array(\PoPSchema\Tags\Component::class, $skipSchemaComponentClasses)
        ) {
            self::maybeInitYAMLSchemaServices(dirname(__DIR__), $skipSchema, '/Conditional/Tags');
        }

        if (
            class_exists('\PoPSchema\Users\Component')
            && !in_array(\PoPSchema\Users\Component::class, $skipSchemaComponentClasses)
        ) {
            self::maybeInitYAMLSchemaServices(dirname(__DIR__), $skipSchema, '/Conditional/Users');
        }
    }
}
