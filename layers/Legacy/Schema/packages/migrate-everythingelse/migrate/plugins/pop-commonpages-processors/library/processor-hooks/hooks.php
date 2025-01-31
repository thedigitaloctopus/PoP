<?php

class PoP_CommonPagesProcessors_Application_Hooks
{
    public function __construct()
    {
        \PoP\Root\App::addFilter(
            'PoP_Module_Processor_CustomControlGroups:layouts',
            $this->getSubcomponents(...),
            0,
            2
        );
    }

    public function getSubcomponents($subcomponents, \PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case PoP_Module_Processor_CustomControlGroups::COMPONENT_CONTROLGROUP_CREATEPOST:
            case PoP_Module_Processor_CustomControlGroups::COMPONENT_CONTROLGROUP_CREATERESETPOST:
            case PoP_Module_Processor_CustomControlGroups::COMPONENT_CONTROLGROUP_EDITPOST:
                $subcomponents[] = [GD_CommonPages_Module_Processor_CustomControlButtonGroups::class, GD_CommonPages_Module_Processor_CustomControlButtonGroups::COMPONENT_CUSTOMCONTROLBUTTONGROUP_ADDCONTENTFAQ];
                break;
        
            case PoP_Module_Processor_CustomControlGroups::COMPONENT_CONTROLGROUP_ACCOUNT:
            case PoP_Module_Processor_CustomControlGroups::COMPONENT_CONTROLGROUP_CREATEACCOUNT:
                $subcomponents[] = [GD_CommonPages_Module_Processor_CustomControlButtonGroups::class, GD_CommonPages_Module_Processor_CustomControlButtonGroups::COMPONENT_CUSTOMCONTROLBUTTONGROUP_ACCOUNTFAQ];
                break;
        }
        
        return $subcomponents;
    }
}

/**
 * Initialization
 */
new PoP_CommonPagesProcessors_Application_Hooks();
