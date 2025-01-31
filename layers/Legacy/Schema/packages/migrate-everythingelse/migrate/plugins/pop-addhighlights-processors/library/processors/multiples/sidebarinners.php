<?php

class PoP_AddHighlights_Module_Processor_SidebarMultipleInners extends PoP_Module_Processor_MultiplesBase
{
    public final const COMPONENT_MULTIPLE_SECTIONINNER_HIGHLIGHTS_SIDEBAR = 'multiple-sectioninner-highlights-sidebar';
    public final const COMPONENT_MULTIPLE_SECTIONINNER_MYHIGHLIGHTS_SIDEBAR = 'multiple-sectioninner-myhighlights-sidebar';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_MULTIPLE_SECTIONINNER_HIGHLIGHTS_SIDEBAR,
            self::COMPONENT_MULTIPLE_SECTIONINNER_MYHIGHLIGHTS_SIDEBAR,
        );
    }

    /**
     * @return \PoP\ComponentModel\Component\Component[]
     */
    public function getSubcomponents(\PoP\ComponentModel\Component\Component $component): array
    {
        $ret = parent::getSubcomponents($component);

        switch ($component->name) {
            case self::COMPONENT_MULTIPLE_SECTIONINNER_HIGHLIGHTS_SIDEBAR:
                $ret[] = [PoP_AddHighlights_Module_Processor_ButtonGroups::class, PoP_AddHighlights_Module_Processor_ButtonGroups::COMPONENT_BUTTONGROUP_HIGHLIGHTS];
                $ret[] = [PoP_AddHighlights_Module_Processor_CustomDelegatorFilters::class, PoP_AddHighlights_Module_Processor_CustomDelegatorFilters::COMPONENT_DELEGATORFILTER_HIGHLIGHTS];
                break;

            case self::COMPONENT_MULTIPLE_SECTIONINNER_MYHIGHLIGHTS_SIDEBAR:
                $ret[] = [PoP_AddHighlights_Module_Processor_ButtonGroups::class, PoP_AddHighlights_Module_Processor_ButtonGroups::COMPONENT_BUTTONGROUP_MYHIGHLIGHTS];
                $ret[] = [PoP_AddHighlights_Module_Processor_CustomDelegatorFilters::class, PoP_AddHighlights_Module_Processor_CustomDelegatorFilters::COMPONENT_DELEGATORFILTER_MYHIGHLIGHTS];
                break;
        }
        
        return $ret;
    }
}



