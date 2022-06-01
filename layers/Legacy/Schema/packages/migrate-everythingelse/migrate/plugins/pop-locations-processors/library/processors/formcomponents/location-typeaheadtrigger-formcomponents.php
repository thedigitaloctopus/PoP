<?php

class PoP_Module_Processor_LocationSelectableTypeaheadTriggerFormComponents extends PoP_Module_Processor_LocationTriggerLayoutFormComponentValuesBase
{
    public final const COMPONENT_FORMCOMPONENT_SELECTABLETYPEAHEADTRIGGER_LOCATIONS = 'formcomponent-selectabletypeaheadtrigger-locations';
    public final const COMPONENT_FORMCOMPONENT_SELECTABLETYPEAHEADTRIGGER_LOCATION = 'formcomponent-selectabletypeaheadtrigger-location';

    public function getComponentsToProcess(): array
    {
        return array(
            [self::class, self::COMPONENT_FORMCOMPONENT_SELECTABLETYPEAHEADTRIGGER_LOCATIONS],
            [self::class, self::COMPONENT_FORMCOMPONENT_SELECTABLETYPEAHEADTRIGGER_LOCATION],
        );
    }

    public function getTriggerSubcomponent(\PoP\ComponentModel\Component\Component $component): ?\PoP\ComponentModel\Component\Component
    {
        switch ($component[1]) {
            case self::COMPONENT_FORMCOMPONENT_SELECTABLETYPEAHEADTRIGGER_LOCATIONS:
            case self::COMPONENT_FORMCOMPONENT_SELECTABLETYPEAHEADTRIGGER_LOCATION:
                $layouts = array(
                    self::COMPONENT_FORMCOMPONENT_SELECTABLETYPEAHEADTRIGGER_LOCATIONS => [PoP_Module_Processor_LocationSelectableTypeaheadAlertFormComponents::class, PoP_Module_Processor_LocationSelectableTypeaheadAlertFormComponents::COMPONENT_FORMCOMPONENT_SELECTABLETYPEAHEADALERT_LOCATIONS],
                    self::COMPONENT_FORMCOMPONENT_SELECTABLETYPEAHEADTRIGGER_LOCATION => [PoP_Module_Processor_LocationSelectableTypeaheadAlertFormComponents::class, PoP_Module_Processor_LocationSelectableTypeaheadAlertFormComponents::COMPONENT_FORMCOMPONENT_SELECTABLETYPEAHEADALERT_LOCATION],
                );
                return $layouts[$component[1]];
        }

        return parent::getTriggerSubcomponent($component);
    }

    public function getDbobjectField(\PoP\ComponentModel\Component\Component $component): ?string
    {
        switch ($component[1]) {
            case self::COMPONENT_FORMCOMPONENT_SELECTABLETYPEAHEADTRIGGER_LOCATIONS:
                return 'locations';

            case self::COMPONENT_FORMCOMPONENT_SELECTABLETYPEAHEADTRIGGER_LOCATION:
                return 'location';
        }

        return parent::getDbobjectField($component);
    }
}



