<?php

declare(strict_types=1);

namespace Leoloso\ExamplesForPoP;

use PoP\Root\Component\AbstractComponent;
use PoP\Root\Component\YAMLServicesTrait;
use PoP\ComponentModel\ComponentConfiguration as ComponentModelComponentConfiguration;

/**
 * Initialize component
 */
class Component extends AbstractComponent
{
    use YAMLServicesTrait;

    public const VERSION = '0.2.0';

    /**
     * Classes from PoP components that must be initialized before this component
     *
     * @return string[]
     */
    public static function getDependedComponentClasses(): array
    {
        return [
            \GraphQLByPoP\GraphQLServer\Component::class,
            \PoPSchema\Media\Component::class,
            \PoPSchema\TranslateDirective\Component::class,
            \PoPSchema\CDNDirective\Component::class,
        ];
    }

    /**
     * Initialize services
     *
     * @param array<string, mixed> $configuration
     * @param string[] $skipSchemaComponentClasses
     */
    protected static function doInitialize(
        array $configuration = [],
        bool $skipSchema = false,
        array $skipSchemaComponentClasses = []
    ): void {
        parent::doInitialize($configuration, $skipSchema, $skipSchemaComponentClasses);
        self::maybeInitYAMLSchemaServices(dirname(__DIR__), $skipSchema);
        if (ComponentModelComponentConfiguration::useComponentModelCache()) {
            self::maybeInitPHPSchemaServices(dirname(__DIR__), $skipSchema, '/ConditionalOnEnvironment/UseComponentModelCache');
        }
    }

    // /**
    //  * Boot component
    //  *
    //  * @return void
    //  */
    // public static function beforeBoot(): void
    // {
    //     parent::beforeBoot();

    //     // Initialize services
    //     ServiceBoot::beforeBoot();
    // }
}
