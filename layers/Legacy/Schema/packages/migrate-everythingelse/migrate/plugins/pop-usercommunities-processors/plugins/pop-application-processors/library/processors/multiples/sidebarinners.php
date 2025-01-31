<?php

class PoP_UserCommunities_Module_Processor_SectionSidebarInners extends PoP_Module_Processor_MultiplesBase
{
    public final const COMPONENT_MULTIPLE_SECTIONINNER_MYMEMBERS_SIDEBAR = 'multiple-sectioninner-mymembers-sidebar';
    public final const COMPONENT_MULTIPLE_SECTIONINNER_COMMUNITIES_SIDEBAR = 'multiple-sectioninner-communities-sidebar';
    public final const COMPONENT_MULTIPLE_AUTHORSECTIONINNER_COMMUNITYMEMBERS_SIDEBAR = 'multiple-authorsectioninner-communitymembers-sidebar';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_MULTIPLE_SECTIONINNER_MYMEMBERS_SIDEBAR,
            self::COMPONENT_MULTIPLE_SECTIONINNER_COMMUNITIES_SIDEBAR,
            self::COMPONENT_MULTIPLE_AUTHORSECTIONINNER_COMMUNITYMEMBERS_SIDEBAR,
        );
    }

    /**
     * @return \PoP\ComponentModel\Component\Component[]
     */
    public function getSubcomponents(\PoP\ComponentModel\Component\Component $component): array
    {
        $ret = parent::getSubcomponents($component);

        switch ($component->name) {
            case self::COMPONENT_MULTIPLE_SECTIONINNER_MYMEMBERS_SIDEBAR:
                $ret[] = [PoP_UserCommunities_ComponentProcessor_ButtonGroups::class, PoP_UserCommunities_ComponentProcessor_ButtonGroups::COMPONENT_BUTTONGROUP_MYUSERS];
                $ret[] = [PoP_UserCommunities_Module_Processor_CustomDelegatorFilters::class, PoP_UserCommunities_Module_Processor_CustomDelegatorFilters::COMPONENT_DELEGATORFILTER_MYMEMBERS];
                break;
                    
            case self::COMPONENT_MULTIPLE_SECTIONINNER_COMMUNITIES_SIDEBAR:
                $ret[] = [GD_Custom_Module_Processor_ButtonGroups::class, GD_Custom_Module_Processor_ButtonGroups::COMPONENT_BUTTONGROUP_USERS];
                $ret[] = [PoP_UserCommunities_Module_Processor_CustomDelegatorFilters::class, PoP_UserCommunities_Module_Processor_CustomDelegatorFilters::COMPONENT_DELEGATORFILTER_COMMUNITIES];
                break;

            case self::COMPONENT_MULTIPLE_AUTHORSECTIONINNER_COMMUNITYMEMBERS_SIDEBAR:
                $ret[] = [GD_Custom_Module_Processor_ButtonGroups::class, GD_Custom_Module_Processor_ButtonGroups::COMPONENT_BUTTONGROUP_AUTHORUSERS];
                $ret[] = [PoP_Module_Processor_CustomDelegatorFilters::class, PoP_Module_Processor_CustomDelegatorFilters::COMPONENT_DELEGATORFILTER_AUTHORCOMMUNITYMEMBERS];
                break;
        }
        
        return $ret;
    }
}



