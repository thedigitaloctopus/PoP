<?php

class GD_EM_Module_Processor_CreateLocationFormInners extends PoP_Module_Processor_FormInnersBase
{
    public final const COMPONENT_FORMINNER_CREATELOCATION = 'em-forminner-createlocation';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_FORMINNER_CREATELOCATION,
        );
    }

    /**
     * @return \PoP\ComponentModel\Component\Component[]
     */
    public function getLayoutSubcomponents(\PoP\ComponentModel\Component\Component $component): array
    {
        $ret = parent::getLayoutSubcomponents($component);
    
        switch ($component->name) {
            case self::COMPONENT_FORMINNER_CREATELOCATION:
                $ret = array_merge(
                    $ret,
                    array(
                        [GD_EM_Module_Processor_CreateLocationTextFormInputs::class, GD_EM_Module_Processor_CreateLocationTextFormInputs::COMPONENT_FORMINPUT_EM_LOCATIONLAT],
                        [GD_EM_Module_Processor_CreateLocationTextFormInputs::class, GD_EM_Module_Processor_CreateLocationTextFormInputs::COMPONENT_FORMINPUT_EM_LOCATIONLNG],
                        [GD_EM_Module_Processor_CreateLocationFormGroups::class, GD_EM_Module_Processor_CreateLocationFormGroups::COMPONENT_FORMINPUTGROUP_EM_LOCATIONNAME],
                        [GD_EM_Module_Processor_CreateLocationFormGroups::class, GD_EM_Module_Processor_CreateLocationFormGroups::COMPONENT_FORMINPUTGROUP_EM_LOCATIONADDRESS],
                        [GD_EM_Module_Processor_CreateLocationFormGroups::class, GD_EM_Module_Processor_CreateLocationFormGroups::COMPONENT_FORMINPUTGROUP_EM_LOCATIONTOWN],
                        [GD_EM_Module_Processor_CreateLocationFormGroups::class, GD_EM_Module_Processor_CreateLocationFormGroups::COMPONENT_FORMINPUTGROUP_EM_LOCATIONSTATE],
                        [GD_EM_Module_Processor_CreateLocationFormGroups::class, GD_EM_Module_Processor_CreateLocationFormGroups::COMPONENT_FORMINPUTGROUP_EM_LOCATIONPOSTCODE],
                        [GD_EM_Module_Processor_CreateLocationFormGroups::class, GD_EM_Module_Processor_CreateLocationFormGroups::COMPONENT_FORMINPUTGROUP_EM_LOCATIONREGION],
                        [GD_EM_Module_Processor_CreateLocationFormGroups::class, GD_EM_Module_Processor_CreateLocationFormGroups::COMPONENT_FORMINPUTGROUP_EM_LOCATIONCOUNTRY],
                        [GD_EM_Module_Processor_SubmitButtons::class, GD_EM_Module_Processor_SubmitButtons::COMPONENT_EM_SUBMITBUTTON_ADDLOCATION],
                    )
                );
                break;
        }

        return $ret;
    }
}



