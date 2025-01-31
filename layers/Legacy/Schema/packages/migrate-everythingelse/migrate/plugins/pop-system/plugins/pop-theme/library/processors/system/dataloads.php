<?php
use PoP\ComponentModel\ComponentProcessors\AbstractDataloadComponentProcessor;
use PoPSitesWassup\SystemMutations\MutationResolverBridges\GenerateThemeMutationResolverBridge;

class PoP_System_Theme_Module_Processor_SystemActions extends AbstractDataloadComponentProcessor
{
    public final const COMPONENT_DATALOADACTION_SYSTEM_GENERATETHEME = 'dataloadaction-system-generate-theme';

    // use PoP_System_Theme_Module_Processor_SystemActionsTrait;
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_DATALOADACTION_SYSTEM_GENERATETHEME,
        );
    }

    public function shouldExecuteMutation(\PoP\ComponentModel\Component\Component $component, array &$props): bool
    {

        // The actionexecution is triggered directly
        switch ($component->name) {
            case self::COMPONENT_DATALOADACTION_SYSTEM_GENERATETHEME:
                return true;
        }

        return parent::shouldExecuteMutation($component, $props);
    }

    public function getComponentMutationResolverBridge(\PoP\ComponentModel\Component\Component $component): ?\PoP\ComponentModel\MutationResolverBridges\ComponentMutationResolverBridgeInterface
    {
        switch ($component->name) {
            case self::COMPONENT_DATALOADACTION_SYSTEM_GENERATETHEME:
                return $this->instanceManager->getInstance(GenerateThemeMutationResolverBridge::class);
        }

        return parent::getComponentMutationResolverBridge($component);
    }
}



