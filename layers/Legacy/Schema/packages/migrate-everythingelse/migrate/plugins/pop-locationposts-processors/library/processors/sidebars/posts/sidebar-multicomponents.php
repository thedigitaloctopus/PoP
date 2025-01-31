<?php

class GD_SP_Custom_EM_Module_Processor_PostMultipleSidebarComponents extends PoP_Module_Processor_MultiplesBase
{
    public final const COMPONENT_SIDEBARMULTICOMPONENT_LOCATIONPOST = 'sidebarmulticomponent-locationpost';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_SIDEBARMULTICOMPONENT_LOCATIONPOST,
        );
    }

    /**
     * @return \PoP\ComponentModel\Component\Component[]
     */
    public function getSubcomponents(\PoP\ComponentModel\Component\Component $component): array
    {
        $ret = parent::getSubcomponents($component);

        switch ($component->name) {
            case self::COMPONENT_SIDEBARMULTICOMPONENT_LOCATIONPOST:
                $ret[] = [GD_Custom_EM_Module_Processor_PostWidgets::class, GD_Custom_EM_Module_Processor_PostWidgets::COMPONENT_WIDGETCOMPACT_LOCATIONPOSTINFO];
                $ret[] = [PoP_Module_Processor_SidebarComponentWrappers::class, PoP_Module_Processor_SidebarComponentWrappers::COMPONENT_WIDGETWRAPPER_REFERENCES];
                $ret[] = [PoP_Module_Processor_Widgets::class, PoP_Module_Processor_Widgets::COMPONENT_WIDGETCOMPACT_POST_AUTHORS];
                break;
        }

        return $ret;
    }
}



