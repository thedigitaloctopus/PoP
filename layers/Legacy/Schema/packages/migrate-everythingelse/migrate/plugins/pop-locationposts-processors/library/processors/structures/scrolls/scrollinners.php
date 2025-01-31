<?php

class PoP_LocationPosts_Module_Processor_CustomScrollInners extends PoP_Module_Processor_ScrollInnersBase
{
    public final const COMPONENT_SCROLLINNER_LOCATIONPOSTS_MAP = 'scrollinner-locationposts-map';
    public final const COMPONENT_SCROLLINNER_LOCATIONPOSTS_HORIZONTALMAP = 'scrollinner-locationposts-horizontalmap';
    public final const COMPONENT_SCROLLINNER_LOCATIONPOSTS_NAVIGATOR = 'scrollinner-locationposts-navigator';
    public final const COMPONENT_SCROLLINNER_LOCATIONPOSTS_ADDONS = 'scrollinner-locationposts-addons';
    public final const COMPONENT_SCROLLINNER_LOCATIONPOSTS_DETAILS = 'scrollinner-locationposts-details';
    public final const COMPONENT_SCROLLINNER_LOCATIONPOSTS_SIMPLEVIEW = 'scrollinner-locationposts-simpleview';
    public final const COMPONENT_SCROLLINNER_LOCATIONPOSTS_FULLVIEW = 'scrollinner-locationposts-fullview';
    public final const COMPONENT_SCROLLINNER_AUTHORLOCATIONPOSTS_FULLVIEW = 'scrollinner-authorlocationposts-fullview';
    public final const COMPONENT_SCROLLINNER_LOCATIONPOSTS_THUMBNAIL = 'scrollinner-locationposts-thumbnail';
    public final const COMPONENT_SCROLLINNER_LOCATIONPOSTS_LIST = 'scrollinner-locationposts-list';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_SCROLLINNER_LOCATIONPOSTS_MAP,
            self::COMPONENT_SCROLLINNER_LOCATIONPOSTS_HORIZONTALMAP,
            self::COMPONENT_SCROLLINNER_LOCATIONPOSTS_NAVIGATOR,
            self::COMPONENT_SCROLLINNER_LOCATIONPOSTS_ADDONS,
            self::COMPONENT_SCROLLINNER_LOCATIONPOSTS_DETAILS,
            self::COMPONENT_SCROLLINNER_LOCATIONPOSTS_SIMPLEVIEW,
            self::COMPONENT_SCROLLINNER_LOCATIONPOSTS_FULLVIEW,
            self::COMPONENT_SCROLLINNER_LOCATIONPOSTS_THUMBNAIL,
            self::COMPONENT_SCROLLINNER_LOCATIONPOSTS_LIST,
            self::COMPONENT_SCROLLINNER_AUTHORLOCATIONPOSTS_FULLVIEW,
        );
    }

    public function getLayoutGrid(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_SCROLLINNER_LOCATIONPOSTS_THUMBNAIL:
                // Allow ThemeStyle Expansive to override the grid
                return \PoP\Root\App::applyFilters(
                    POP_HOOK_SCROLLINNER_THUMBNAIL_GRID,
                    array(
                        'row-items' => 2,
                        'class' => 'col-xsm-6'
                    )
                );

            case self::COMPONENT_SCROLLINNER_LOCATIONPOSTS_MAP:
            case self::COMPONENT_SCROLLINNER_LOCATIONPOSTS_HORIZONTALMAP:
            case self::COMPONENT_SCROLLINNER_LOCATIONPOSTS_NAVIGATOR:
            case self::COMPONENT_SCROLLINNER_LOCATIONPOSTS_ADDONS:
            case self::COMPONENT_SCROLLINNER_LOCATIONPOSTS_DETAILS:
            case self::COMPONENT_SCROLLINNER_LOCATIONPOSTS_SIMPLEVIEW:
            case self::COMPONENT_SCROLLINNER_LOCATIONPOSTS_FULLVIEW:
            case self::COMPONENT_SCROLLINNER_LOCATIONPOSTS_LIST:
            case self::COMPONENT_SCROLLINNER_AUTHORLOCATIONPOSTS_FULLVIEW:
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
            self::COMPONENT_SCROLLINNER_LOCATIONPOSTS_MAP => [GD_Custom_EM_Module_Processor_CustomPreviewPostLayouts::class, GD_Custom_EM_Module_Processor_CustomPreviewPostLayouts::COMPONENT_LAYOUT_PREVIEWPOST_LOCATIONPOST_MAPDETAILS],
            self::COMPONENT_SCROLLINNER_LOCATIONPOSTS_HORIZONTALMAP => [GD_Custom_EM_Module_Processor_CustomPreviewPostLayouts::class, GD_Custom_EM_Module_Processor_CustomPreviewPostLayouts::COMPONENT_LAYOUT_PREVIEWPOST_LOCATIONPOST_HORIZONTALMAPDETAILS],
            self::COMPONENT_SCROLLINNER_LOCATIONPOSTS_NAVIGATOR => [GD_Custom_EM_Module_Processor_CustomPreviewPostLayouts::class, GD_Custom_EM_Module_Processor_CustomPreviewPostLayouts::COMPONENT_LAYOUT_PREVIEWPOST_LOCATIONPOST_NAVIGATOR],
            self::COMPONENT_SCROLLINNER_LOCATIONPOSTS_ADDONS => [GD_Custom_EM_Module_Processor_CustomPreviewPostLayouts::class, GD_Custom_EM_Module_Processor_CustomPreviewPostLayouts::COMPONENT_LAYOUT_PREVIEWPOST_LOCATIONPOST_ADDONS],
            self::COMPONENT_SCROLLINNER_LOCATIONPOSTS_DETAILS => [GD_Custom_EM_Module_Processor_CustomPreviewPostLayouts::class, GD_Custom_EM_Module_Processor_CustomPreviewPostLayouts::COMPONENT_LAYOUT_PREVIEWPOST_LOCATIONPOST_DETAILS],
            self::COMPONENT_SCROLLINNER_LOCATIONPOSTS_THUMBNAIL => [GD_Custom_EM_Module_Processor_CustomPreviewPostLayouts::class, GD_Custom_EM_Module_Processor_CustomPreviewPostLayouts::COMPONENT_LAYOUT_PREVIEWPOST_LOCATIONPOST_THUMBNAIL],
            self::COMPONENT_SCROLLINNER_LOCATIONPOSTS_LIST => [GD_Custom_EM_Module_Processor_CustomPreviewPostLayouts::class, GD_Custom_EM_Module_Processor_CustomPreviewPostLayouts::COMPONENT_LAYOUT_PREVIEWPOST_LOCATIONPOST_LIST],
            self::COMPONENT_SCROLLINNER_LOCATIONPOSTS_SIMPLEVIEW => [PoPSFEM_Module_Processor_SimpleViewPreviewPostLayouts::class, PoPSFEM_Module_Processor_SimpleViewPreviewPostLayouts::COMPONENT_LAYOUT_PREVIEWPOST_LOCATIONPOST_SIMPLEVIEW],
            self::COMPONENT_SCROLLINNER_LOCATIONPOSTS_FULLVIEW => [GD_Custom_EM_Module_Processor_CustomFullViewLayouts::class, GD_Custom_EM_Module_Processor_CustomFullViewLayouts::COMPONENT_LAYOUT_FULLVIEW_LOCATIONPOST],
            self::COMPONENT_SCROLLINNER_AUTHORLOCATIONPOSTS_FULLVIEW => [GD_Custom_EM_Module_Processor_CustomFullViewLayouts::class, GD_Custom_EM_Module_Processor_CustomFullViewLayouts::COMPONENT_LAYOUT_FULLVIEW_LOCATIONPOST],
        );

        if ($layout = $layouts[$component->name] ?? null) {
            $ret[] = $layout;
        }

        return $ret;
    }
}


