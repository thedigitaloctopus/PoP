<?php

class Wassup_Module_Processor_CategoriesLayouts extends PoP_Module_Processor_CategoriesLayoutsBase
{
    public final const COMPONENT_LAYOUT_CATEGORIES = 'layout-categories';
    public final const COMPONENT_LAYOUT_APPLIESTO = 'layout-appliesto';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_LAYOUT_CATEGORIES,
            self::COMPONENT_LAYOUT_APPLIESTO,
        );
    }

    public function getCategoriesField(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_LAYOUT_CATEGORIES:
                return 'topicsByName';

            case self::COMPONENT_LAYOUT_APPLIESTO:
                return 'appliestoByName';
        }
        
        return parent::getCategoriesField($component, $props);
    }
    public function getLabelClass(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_LAYOUT_APPLIESTO:
                return 'label-primary';
        }
        
        return parent::getLabelClass($component, $props);
    }
}



