<?php

class PoP_ContentPostLinksCreation_Module_Processor_CustomScrollInners extends PoP_Module_Processor_ScrollInnersBase
{
    public final const COMPONENT_SCROLLINNER_MYLINKS_SIMPLEVIEWPREVIEW = 'scrollinner-mylinks-simpleviewpreview';
    public final const COMPONENT_SCROLLINNER_MYLINKS_FULLVIEWPREVIEW = 'scrollinner-mylinks-fullviewpreview';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_SCROLLINNER_MYLINKS_SIMPLEVIEWPREVIEW,
            self::COMPONENT_SCROLLINNER_MYLINKS_FULLVIEWPREVIEW,
        );
    }

    public function getLayoutGrid(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_SCROLLINNER_MYLINKS_SIMPLEVIEWPREVIEW:
            case self::COMPONENT_SCROLLINNER_MYLINKS_FULLVIEWPREVIEW:
                return array(
                    'row-items' => 1,
                    'class' => 'col-sm-12'
                );
        }

        return parent::getLayoutGrid($component, $props);
    }

    /**
     * @return \PoP\ComponentModel\Component\Component[]
     */
    public function getLayoutSubcomponents(\PoP\ComponentModel\Component\Component $component): array
    {
        $ret = parent::getLayoutSubcomponents($component);

        $layouts = array(
            self::COMPONENT_SCROLLINNER_MYLINKS_SIMPLEVIEWPREVIEW => [PoP_Module_Processor_CustomSimpleViewPreviewPostLayouts::class, PoP_Module_Processor_CustomSimpleViewPreviewPostLayouts::COMPONENT_LAYOUT_PREVIEWPOST_SIMPLEVIEW],
            self::COMPONENT_SCROLLINNER_MYLINKS_FULLVIEWPREVIEW => [PoP_ContentPostLinks_Module_Processor_CustomFullViewLayouts::class, PoP_ContentPostLinks_Module_Processor_CustomFullViewLayouts::COMPONENT_LAYOUT_FULLVIEW_LINK],
        );

        if ($layout = $layouts[$component->name] ?? null) {
            $ret[] = $layout;
        }

        return $ret;
    }
}


