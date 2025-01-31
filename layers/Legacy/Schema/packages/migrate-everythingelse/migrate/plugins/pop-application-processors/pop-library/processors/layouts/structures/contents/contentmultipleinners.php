<?php

class Wassup_Module_Processor_ContentMultipleInners extends PoP_Module_Processor_ContentMultipleInnersBase
{
    public final const COMPONENT_LAYOUTCONTENTINNER_HIGHLIGHTS = 'contentinnerlayout-highlights';
    public final const COMPONENT_LAYOUTCONTENTINNER_HIGHLIGHTS_APPENDABLE = 'contentinnerlayout-highlights-appendable';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_LAYOUTCONTENTINNER_HIGHLIGHTS,
            self::COMPONENT_LAYOUTCONTENTINNER_HIGHLIGHTS_APPENDABLE,
        );
    }

    /**
     * @return \PoP\ComponentModel\Component\Component[]
     */
    public function getLayoutSubcomponents(\PoP\ComponentModel\Component\Component $component): array
    {
        $ret = parent::getLayoutSubcomponents($component);

        switch ($component->name) {
            case self::COMPONENT_LAYOUTCONTENTINNER_HIGHLIGHTS:
                $ret[] = [PoP_Module_Processor_CustomPreviewPostLayouts::class, PoP_Module_Processor_CustomPreviewPostLayouts::COMPONENT_LAYOUT_PREVIEWPOST_HIGHLIGHT_CONTENT];
                break;

            case self::COMPONENT_LAYOUTCONTENTINNER_HIGHLIGHTS_APPENDABLE:
                // No need for anything, since this is the layout container, to be filled when the lazyload request comes back
                break;
        }

        return $ret;
    }
}


