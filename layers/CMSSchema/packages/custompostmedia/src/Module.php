<?php

declare(strict_types=1);

namespace PoPCMSSchema\CustomPostMedia;

use PoP\Root\Module\AbstractModule;

/**
 * Initialize component
 */
class Module extends AbstractModule
{
    protected function requiresSatisfyingModule(): bool
    {
        return true;
    }

    /**
     * Classes from PoP components that must be initialized before this component
     *
     * @return string[]
     */
    public function getDependedComponentClasses(): array
    {
        return [
            \PoPCMSSchema\CustomPosts\Module::class,
            \PoPCMSSchema\Media\Module::class,
        ];
    }

    /**
     * Initialize services
     *
     * @param string[] $skipSchemaComponentClasses
     */
    protected function initializeContainerServices(
        bool $skipSchema,
        array $skipSchemaComponentClasses,
    ): void {
        $this->initSchemaServices(dirname(__DIR__), $skipSchema);
    }
}
