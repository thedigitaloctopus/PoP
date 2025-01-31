<?php

abstract class PoP_Module_Processor_CreateUpdateProfileIndividualFormsUtils
{
    public static function getFormSubcomponents(\PoP\ComponentModel\Component\Component $component, &$components, $processor)
    {
        // Add extra components
        array_splice(
            $components, 
            array_search(
                [PoP_Module_Processor_UserFormGroups::class, PoP_Module_Processor_UserFormGroups::COMPONENT_FORMINPUTGROUP_CUU_FIRSTNAME], 
                $components
            )+1, 
            0, 
            [
                [GD_CommonUserRoles_Module_Processor_ProfileFormGroups::class, GD_CommonUserRoles_Module_Processor_ProfileFormGroups::COMPONENT_URE_FORMINPUTGROUP_CUP_LASTNAME],
            ]
        );
        array_splice(
            $components, 
            array_search(
                [PoP_Module_Processor_ProfileFormGroups::class, PoP_Module_Processor_ProfileFormGroups::COMPONENT_FORMINPUTGROUP_CUP_SHORTDESCRIPTION], 
                $components
            ), 
            0, 
            [
                [GD_CommonUserRoles_Module_Processor_ProfileFormGroups::class, GD_CommonUserRoles_Module_Processor_ProfileFormGroups::COMPONENT_URE_FORMINPUTGROUP_INDIVIDUALINTERESTS],
            ]
        );
    }
}
