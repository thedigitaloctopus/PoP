<?php

declare(strict_types=1);

namespace PoPSchema\TranslateDirectiveACL;

use PoP\Root\Component\AbstractComponent;
use PoP\Root\Component\CanDisableComponentTrait;
use PoPSchema\UserRolesAccessControl\Component as UserRolesAccessControlComponent;

/**
 * Initialize component
 */
class Component extends AbstractComponent
{
    use CanDisableComponentTrait;

    // const VERSION = '0.1.0';

    /**
     * Classes from PoP components that must be initialized before this component
     *
     * @return string[]
     */
    public static function getDependedComponentClasses(): array
    {
        return [
            \PoPSchema\TranslateDirective\Component::class,
            \PoPSchema\UserRolesAccessControl\Component::class,
        ];
    }

    /**
     * Initialize services for the system container
     *
     * @param array<string, mixed> $configuration
     */
    protected static function initializeSystemContainerServices(
        array $configuration = []
    ): void {
        if (self::isEnabled()) {
            parent::initializeSystemContainerServices($configuration);
            self::initYAMLSystemContainerServices(dirname(__DIR__));
        }
    }

    protected static function resolveEnabled()
    {
        return UserRolesAccessControlComponent::isEnabled();
    }
}
