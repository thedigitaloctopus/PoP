<?php
use PoP\Root\Facades\Translation\TranslationAPIFacade;

class PoP_AddHighlights_Module_Processor_FormComponentGroups extends PoP_Module_Processor_FormComponentGroupsBase
{
    public final const COMPONENT_FORMCOMPONENTGROUP_CARD_HIGHLIGHTEDPOST = 'formcomponentgroup-card-highlightedpost';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_FORMCOMPONENTGROUP_CARD_HIGHLIGHTEDPOST,
        );
    }

    public function getComponentSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_FORMCOMPONENTGROUP_CARD_HIGHLIGHTEDPOST:
                return [PoP_AddHighlights_Module_Processor_PostTriggerLayoutFormComponentValues::class, PoP_AddHighlights_Module_Processor_PostTriggerLayoutFormComponentValues::COMPONENT_FORMCOMPONENT_CARD_HIGHLIGHTEDPOST];
        }
        
        return parent::getComponentSubcomponent($component);
    }

    public function getLabel(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_FORMCOMPONENTGROUP_CARD_HIGHLIGHTEDPOST:
                return TranslationAPIFacade::getInstance()->__('Highlight from:', 'poptheme-wassup');
        }
        
        return parent::getLabel($component, $props);
    }
}



