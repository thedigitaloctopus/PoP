<?php

class PoP_AddHighlights_Module_Processor_PostHiddenInputAlertFormComponents extends PoP_Module_Processor_PostHiddenInputAlertFormComponentsBase
{
    public final const COMPONENT_FORMCOMPONENT_HIDDENINPUTALERT_HIGHLIGHTEDPOST = 'formcomponent-hiddeninputalert-highlightedpost';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_FORMCOMPONENT_HIDDENINPUTALERT_HIGHLIGHTEDPOST,
        );
    }
    
    public function getHiddenInputComponent(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_FORMCOMPONENT_HIDDENINPUTALERT_HIGHLIGHTEDPOST:
                return [PoP_AddHighlights_Processor_HiddenInputFormInputs::class, PoP_AddHighlights_Processor_HiddenInputFormInputs::COMPONENT_FORMINPUT_HIDDENINPUT_HIGHLIGHTEDPOST];
        }

        return parent::getHiddenInputComponent($component);
    }
}



