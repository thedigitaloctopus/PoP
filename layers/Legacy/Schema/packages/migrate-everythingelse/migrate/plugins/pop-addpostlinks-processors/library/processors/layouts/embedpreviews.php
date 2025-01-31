<?php

class PoP_AddPostLinks_Module_Processor_EmbedPreviewLayouts extends PoP_Module_Processor_EmbedPreviewLayoutsBase
{
    public final const COMPONENT_ADDPOSTLINKS_LAYOUT_EMBEDPREVIEW_LINK = 'layout-addpostlinks-embedpreview-link';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_ADDPOSTLINKS_LAYOUT_EMBEDPREVIEW_LINK,
        );
    }
    public function getFrameSrcField(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_ADDPOSTLINKS_LAYOUT_EMBEDPREVIEW_LINK:
                return 'link';
        }

        return parent::getFrameSrcField($component, $props);
    }
    public function getFrameHeight(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_ADDPOSTLINKS_LAYOUT_EMBEDPREVIEW_LINK:
                return '400';
        }

        return parent::getFrameHeight($component, $props);
    }
    // function printSource(\PoP\ComponentModel\Component\Component $component, array &$props) {

    //     switch ($component->name) {
            
    //         case self::COMPONENT_ADDPOSTLINKS_LAYOUT_EMBEDPREVIEW_LINK:

    //             return true;
    //     }

    //     return parent::printSource($component, $props);
    // }
}



