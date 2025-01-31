<?php
use PoP\Root\Facades\Translation\TranslationAPIFacade;

class GD_CommonUserRoles_UserCommunities_Module_Processor_ProfileFormGroups extends PoP_Module_Processor_FormComponentGroupsBase
{
    public final const COMPONENT_URE_FORMINPUTGROUP_CUP_ISCOMMUNITY = 'ure-forminputgroup-cup-iscommunity';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_URE_FORMINPUTGROUP_CUP_ISCOMMUNITY,
        );
    }

    public function getComponentSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        $components = array(
            self::COMPONENT_URE_FORMINPUTGROUP_CUP_ISCOMMUNITY => [GD_CommonUserRoles_UserCommunities_Module_Processor_SelectFormInputs::class, GD_CommonUserRoles_UserCommunities_Module_Processor_SelectFormInputs::COMPONENT_URE_FORMINPUT_CUP_ISCOMMUNITY],
        );

        if ($component = $components[$component->name] ?? null) {
            return $component;
        }

        return parent::getComponentSubcomponent($component);
    }

    public function getInfo(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_URE_FORMINPUTGROUP_CUP_ISCOMMUNITY:
                return TranslationAPIFacade::getInstance()->__('Become a Community: all the content posted by your members will also appear under your Organization\'s profile.');
        }

        return parent::getInfo($component, $props);
    }
}



