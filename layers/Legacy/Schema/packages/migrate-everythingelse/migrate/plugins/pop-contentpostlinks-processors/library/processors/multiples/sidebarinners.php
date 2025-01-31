<?php

class PoP_ContentPostLinks_Module_Processor_SidebarInners extends PoP_Module_Processor_MultiplesBase
{
    public final const COMPONENT_MULTIPLE_SECTIONINNER_POSTLINKS_SIDEBAR = 'multiple-sectioninner-contentpostlinks-sidebar';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_MULTIPLE_SECTIONINNER_POSTLINKS_SIDEBAR,
        );
    }

    /**
     * @return \PoP\ComponentModel\Component\Component[]
     */
    public function getSubcomponents(\PoP\ComponentModel\Component\Component $component): array
    {
        $ret = parent::getSubcomponents($component);

        switch ($component->name) {
            case self::COMPONENT_MULTIPLE_SECTIONINNER_POSTLINKS_SIDEBAR:
                $ret[] = [GD_Custom_Module_Processor_ButtonGroups::class, GD_Custom_Module_Processor_ButtonGroups::COMPONENT_BUTTONGROUP_SECTION];
                $ret[] = [PoP_ContentPostLinks_Module_Processor_CustomDelegatorFilters::class, PoP_ContentPostLinks_Module_Processor_CustomDelegatorFilters::COMPONENT_DELEGATORFILTER_CONTENTPOSTLINKS];
                break;
        }
        
        return $ret;
    }
}


