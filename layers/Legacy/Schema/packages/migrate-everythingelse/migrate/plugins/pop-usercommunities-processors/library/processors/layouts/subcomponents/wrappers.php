<?php

class GD_URE_Module_Processor_MembersLayoutWrappers extends PoP_Module_Processor_ConditionWrapperBase
{
    public final const COMPONENT_URE_LAYOUTWRAPPER_COMMUNITYMEMBERS = 'ure-layoutwrapper-communitymembers';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_URE_LAYOUTWRAPPER_COMMUNITYMEMBERS,
        );
    }

    public function getConditionSucceededSubcomponents(\PoP\ComponentModel\Component\Component $component)
    {
        $ret = parent::getConditionSucceededSubcomponents($component);

        switch ($component->name) {
            case self::COMPONENT_URE_LAYOUTWRAPPER_COMMUNITYMEMBERS:
                $ret[] = [GD_URE_Module_Processor_Codes::class, GD_URE_Module_Processor_Codes::COMPONENT_URE_CODE_MEMBERSLABEL];
                $ret[] = [GD_URE_Module_Processor_MembersLayoutMultipleComponents::class, GD_URE_Module_Processor_MembersLayoutMultipleComponents::COMPONENT_URE_MULTICOMPONENT_COMMUNITYMEMBERS];
                break;
        }

        return $ret;
    }

    public function getConditionField(\PoP\ComponentModel\Component\Component $component): ?string
    {
        switch ($component->name) {
            case self::COMPONENT_URE_LAYOUTWRAPPER_COMMUNITYMEMBERS:
                return 'hasMembers';
        }

        return null;
    }
}



