<?php

class PoP_Newsletter_Module_Processor_FormGroups extends PoP_Module_Processor_FormComponentGroupsBase
{
    public final const COMPONENT_FORMINPUTGROUP_NEWSLETTERNAME = 'forminputgroup-field-newslettername';
    public final const COMPONENT_FORMINPUTGROUP_NEWSLETTEREMAIL = 'forminputgroup-field-newsletteremail';
    public final const COMPONENT_FORMINPUTGROUP_NEWSLETTEREMAILVERIFICATIONEMAIL = 'forminputgroup-field-newsletteremailverificationemail';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_FORMINPUTGROUP_NEWSLETTERNAME,
            self::COMPONENT_FORMINPUTGROUP_NEWSLETTEREMAIL,
            self::COMPONENT_FORMINPUTGROUP_NEWSLETTEREMAILVERIFICATIONEMAIL,
        );
    }

    public function getComponentSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        $components = array(
            self::COMPONENT_FORMINPUTGROUP_NEWSLETTERNAME => [PoP_Newsletter_Module_Processor_TextFormInputs::class, PoP_Newsletter_Module_Processor_TextFormInputs::COMPONENT_FORMINPUT_NEWSLETTERNAME],
            self::COMPONENT_FORMINPUTGROUP_NEWSLETTEREMAIL => [PoP_Newsletter_Module_Processor_TextFormInputs::class, PoP_Newsletter_Module_Processor_TextFormInputs::COMPONENT_FORMINPUT_NEWSLETTEREMAIL],
            self::COMPONENT_FORMINPUTGROUP_NEWSLETTEREMAILVERIFICATIONEMAIL => [PoP_Newsletter_Module_Processor_TextFormInputs::class, PoP_Newsletter_Module_Processor_TextFormInputs::COMPONENT_FORMINPUT_NEWSLETTEREMAILVERIFICATIONEMAIL],
        );

        if ($component = $components[$component->name] ?? null) {
            return $component;
        }

        return parent::getComponentSubcomponent($component);
    }
}



