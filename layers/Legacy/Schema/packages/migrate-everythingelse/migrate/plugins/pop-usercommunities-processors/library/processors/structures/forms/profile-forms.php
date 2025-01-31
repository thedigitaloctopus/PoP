<?php

class GD_URE_Module_Processor_ProfileForms extends PoP_Module_Processor_FormsBase
{
    public final const COMPONENT_FORM_EDITMEMBERSHIP = 'form-editmembership';
    public final const COMPONENT_FORM_MYCOMMUNITIES_UPDATE = 'form-mycommunities-update';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_FORM_EDITMEMBERSHIP,
            self::COMPONENT_FORM_MYCOMMUNITIES_UPDATE,
        );
    }

    public function getInnerSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_FORM_EDITMEMBERSHIP:
                return [GD_URE_Module_Processor_ProfileFormInners::class, GD_URE_Module_Processor_ProfileFormInners::COMPONENT_FORMINNER_EDITMEMBERSHIP];

            case self::COMPONENT_FORM_MYCOMMUNITIES_UPDATE:
                return [GD_URE_Module_Processor_ProfileFormInners::class, GD_URE_Module_Processor_ProfileFormInners::COMPONENT_FORMINNER_MYCOMMUNITIES_UPDATE];
        }

        return parent::getInnerSubcomponent($component);
    }
}



