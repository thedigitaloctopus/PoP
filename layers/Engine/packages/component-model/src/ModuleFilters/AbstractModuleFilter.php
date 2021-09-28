<?php

declare(strict_types=1);

namespace PoP\ComponentModel\ModuleFilters;

use Symfony\Contracts\Service\Attribute\Required;
use PoP\ComponentModel\ModuleProcessors\ModuleProcessorManagerInterface;

abstract class AbstractModuleFilter implements ModuleFilterInterface
{
    protected ModuleProcessorManagerInterface $moduleProcessorManager;
    
    #[Required]
    public function autowireAbstractModuleFilter(ModuleProcessorManagerInterface $moduleProcessorManager)
    {
        $this->moduleProcessorManager = $moduleProcessorManager;
    }

    public function excludeModule(array $module, array &$props): bool
    {
        return false;
    }

    public function removeExcludedSubmodules(array $module, array $submodules): array
    {
        return $submodules;
    }

    public function prepareForPropagation(array $module, array &$props): void
    {
    }

    public function restoreFromPropagation(array $module, array &$props): void
    {
    }
}
