<?php

class PoP_Module_Processor_EmbedPreviewLayouts extends PoP_Module_Processor_EmbedPreviewLayoutsBase
{
    public final const COMPONENT_LAYOUT_EMBEDPREVIEW = 'layout-urlembedpreview';
    public final const COMPONENT_LAYOUT_USERINPUTEMBEDPREVIEW = 'layout-userinputembedpreview';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_LAYOUT_EMBEDPREVIEW,
            self::COMPONENT_LAYOUT_USERINPUTEMBEDPREVIEW,
        );
    }
    public function getFrameSrc(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_LAYOUT_USERINPUTEMBEDPREVIEW:
                return \PoP\Root\App::applyFilters('PoP_Module_Processor_EmbedPreviewLayouts:getFrameSrc', '');
        }

        return parent::getFrameSrc($component, $props);
    }
}



