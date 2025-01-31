<?php

class PoP_LocationPosts_Module_Processor_CustomSectionBlocks extends PoP_Module_Processor_SectionBlocksBase
{
    public final const COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_NAVIGATOR = 'block-locationposts-scroll-navigator';
    public final const COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_ADDONS = 'block-locationposts-scroll-addons';
    public final const COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_DETAILS = 'block-locationposts-scroll-details';
    public final const COMPONENT_BLOCK_AUTHORLOCATIONPOSTS_SCROLL_DETAILS = 'block-authorlocationposts-scroll-details';
    public final const COMPONENT_BLOCK_TAGLOCATIONPOSTS_SCROLL_DETAILS = 'block-taglocationposts-scroll-details';
    public final const COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_SIMPLEVIEW = 'block-locationposts-scroll-simpleview';
    public final const COMPONENT_BLOCK_AUTHORLOCATIONPOSTS_SCROLL_SIMPLEVIEW = 'block-authorlocationposts-scroll-simpleview';
    public final const COMPONENT_BLOCK_TAGLOCATIONPOSTS_SCROLL_SIMPLEVIEW = 'block-taglocationposts-scroll-simpleview';
    public final const COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_FULLVIEW = 'block-locationposts-scroll-fullview';
    public final const COMPONENT_BLOCK_AUTHORLOCATIONPOSTS_SCROLL_FULLVIEW = 'block-authorlocationposts-scroll-fullview';
    public final const COMPONENT_BLOCK_TAGLOCATIONPOSTS_SCROLL_FULLVIEW = 'block-taglocationposts-scroll-fullview';
    public final const COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_THUMBNAIL = 'block-locationposts-scroll-thumbnail';
    public final const COMPONENT_BLOCK_AUTHORLOCATIONPOSTS_SCROLL_THUMBNAIL = 'block-authorlocationposts-scroll-thumbnail';
    public final const COMPONENT_BLOCK_TAGLOCATIONPOSTS_SCROLL_THUMBNAIL = 'block-taglocationposts-scroll-thumbnail';
    public final const COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_LIST = 'block-locationposts-scroll-list';
    public final const COMPONENT_BLOCK_AUTHORLOCATIONPOSTS_SCROLL_LIST = 'block-authorlocationposts-scroll-list';
    public final const COMPONENT_BLOCK_TAGLOCATIONPOSTS_SCROLL_LIST = 'block-taglocationposts-scroll-list';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_NAVIGATOR,
            self::COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_ADDONS,
            self::COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_DETAILS,
            self::COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_SIMPLEVIEW,
            self::COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_FULLVIEW,
            self::COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_THUMBNAIL,
            self::COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_LIST,

            self::COMPONENT_BLOCK_AUTHORLOCATIONPOSTS_SCROLL_DETAILS,
            self::COMPONENT_BLOCK_AUTHORLOCATIONPOSTS_SCROLL_SIMPLEVIEW,
            self::COMPONENT_BLOCK_AUTHORLOCATIONPOSTS_SCROLL_FULLVIEW,
            self::COMPONENT_BLOCK_AUTHORLOCATIONPOSTS_SCROLL_THUMBNAIL,
            self::COMPONENT_BLOCK_AUTHORLOCATIONPOSTS_SCROLL_LIST,

            self::COMPONENT_BLOCK_TAGLOCATIONPOSTS_SCROLL_DETAILS,
            self::COMPONENT_BLOCK_TAGLOCATIONPOSTS_SCROLL_SIMPLEVIEW,
            self::COMPONENT_BLOCK_TAGLOCATIONPOSTS_SCROLL_FULLVIEW,
            self::COMPONENT_BLOCK_TAGLOCATIONPOSTS_SCROLL_THUMBNAIL,
            self::COMPONENT_BLOCK_TAGLOCATIONPOSTS_SCROLL_LIST,
        );
    }

    public function getRelevantRoute(\PoP\ComponentModel\Component\Component $component, array &$props): ?string
    {
        return match($component->name) {
            self::COMPONENT_BLOCK_AUTHORLOCATIONPOSTS_SCROLL_DETAILS => POP_LOCATIONPOSTS_ROUTE_LOCATIONPOSTS,
            self::COMPONENT_BLOCK_AUTHORLOCATIONPOSTS_SCROLL_FULLVIEW => POP_LOCATIONPOSTS_ROUTE_LOCATIONPOSTS,
            self::COMPONENT_BLOCK_AUTHORLOCATIONPOSTS_SCROLL_LIST => POP_LOCATIONPOSTS_ROUTE_LOCATIONPOSTS,
            self::COMPONENT_BLOCK_AUTHORLOCATIONPOSTS_SCROLL_SIMPLEVIEW => POP_LOCATIONPOSTS_ROUTE_LOCATIONPOSTS,
            self::COMPONENT_BLOCK_AUTHORLOCATIONPOSTS_SCROLL_THUMBNAIL => POP_LOCATIONPOSTS_ROUTE_LOCATIONPOSTS,
            self::COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_ADDONS => POP_LOCATIONPOSTS_ROUTE_LOCATIONPOSTS,
            self::COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_DETAILS => POP_LOCATIONPOSTS_ROUTE_LOCATIONPOSTS,
            self::COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_FULLVIEW => POP_LOCATIONPOSTS_ROUTE_LOCATIONPOSTS,
            self::COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_LIST => POP_LOCATIONPOSTS_ROUTE_LOCATIONPOSTS,
            self::COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_NAVIGATOR => POP_LOCATIONPOSTS_ROUTE_LOCATIONPOSTS,
            self::COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_SIMPLEVIEW => POP_LOCATIONPOSTS_ROUTE_LOCATIONPOSTS,
            self::COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_THUMBNAIL => POP_LOCATIONPOSTS_ROUTE_LOCATIONPOSTS,
            self::COMPONENT_BLOCK_TAGLOCATIONPOSTS_SCROLL_DETAILS => POP_LOCATIONPOSTS_ROUTE_LOCATIONPOSTS,
            self::COMPONENT_BLOCK_TAGLOCATIONPOSTS_SCROLL_FULLVIEW => POP_LOCATIONPOSTS_ROUTE_LOCATIONPOSTS,
            self::COMPONENT_BLOCK_TAGLOCATIONPOSTS_SCROLL_LIST => POP_LOCATIONPOSTS_ROUTE_LOCATIONPOSTS,
            self::COMPONENT_BLOCK_TAGLOCATIONPOSTS_SCROLL_SIMPLEVIEW => POP_LOCATIONPOSTS_ROUTE_LOCATIONPOSTS,
            self::COMPONENT_BLOCK_TAGLOCATIONPOSTS_SCROLL_THUMBNAIL => POP_LOCATIONPOSTS_ROUTE_LOCATIONPOSTS,
            default => parent::getRelevantRoute($component, $props),
        };
    }

    protected function getInnerSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        $inner_components = array(
            self::COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_NAVIGATOR => [PoP_LocationPosts_Module_Processor_CustomSectionDataloads::class, PoP_LocationPosts_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_LOCATIONPOSTS_SCROLL_NAVIGATOR],
            self::COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_ADDONS => [PoP_LocationPosts_Module_Processor_CustomSectionDataloads::class, PoP_LocationPosts_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_LOCATIONPOSTS_SCROLL_ADDONS],
            self::COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_DETAILS => [PoP_LocationPosts_Module_Processor_CustomSectionDataloads::class, PoP_LocationPosts_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_LOCATIONPOSTS_SCROLL_DETAILS],
            self::COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_SIMPLEVIEW => [PoP_LocationPosts_Module_Processor_CustomSectionDataloads::class, PoP_LocationPosts_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_LOCATIONPOSTS_SCROLL_SIMPLEVIEW],
            self::COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_FULLVIEW => [PoP_LocationPosts_Module_Processor_CustomSectionDataloads::class, PoP_LocationPosts_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_LOCATIONPOSTS_SCROLL_FULLVIEW],
            self::COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_THUMBNAIL => [PoP_LocationPosts_Module_Processor_CustomSectionDataloads::class, PoP_LocationPosts_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_LOCATIONPOSTS_SCROLL_THUMBNAIL],
            self::COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_LIST => [PoP_LocationPosts_Module_Processor_CustomSectionDataloads::class, PoP_LocationPosts_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_LOCATIONPOSTS_SCROLL_LIST],
            self::COMPONENT_BLOCK_AUTHORLOCATIONPOSTS_SCROLL_DETAILS => [PoP_LocationPosts_Module_Processor_CustomSectionDataloads::class, PoP_LocationPosts_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_AUTHORLOCATIONPOSTS_SCROLL_DETAILS],
            self::COMPONENT_BLOCK_AUTHORLOCATIONPOSTS_SCROLL_SIMPLEVIEW => [PoP_LocationPosts_Module_Processor_CustomSectionDataloads::class, PoP_LocationPosts_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_AUTHORLOCATIONPOSTS_SCROLL_SIMPLEVIEW],
            self::COMPONENT_BLOCK_AUTHORLOCATIONPOSTS_SCROLL_FULLVIEW => [PoP_LocationPosts_Module_Processor_CustomSectionDataloads::class, PoP_LocationPosts_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_AUTHORLOCATIONPOSTS_SCROLL_FULLVIEW],
            self::COMPONENT_BLOCK_AUTHORLOCATIONPOSTS_SCROLL_THUMBNAIL => [PoP_LocationPosts_Module_Processor_CustomSectionDataloads::class, PoP_LocationPosts_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_AUTHORLOCATIONPOSTS_SCROLL_THUMBNAIL],
            self::COMPONENT_BLOCK_AUTHORLOCATIONPOSTS_SCROLL_LIST => [PoP_LocationPosts_Module_Processor_CustomSectionDataloads::class, PoP_LocationPosts_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_AUTHORLOCATIONPOSTS_SCROLL_LIST],
            self::COMPONENT_BLOCK_TAGLOCATIONPOSTS_SCROLL_DETAILS => [PoP_LocationPosts_Module_Processor_CustomSectionDataloads::class, PoP_LocationPosts_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_TAGLOCATIONPOSTS_SCROLL_DETAILS],
            self::COMPONENT_BLOCK_TAGLOCATIONPOSTS_SCROLL_SIMPLEVIEW => [PoP_LocationPosts_Module_Processor_CustomSectionDataloads::class, PoP_LocationPosts_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_TAGLOCATIONPOSTS_SCROLL_SIMPLEVIEW],
            self::COMPONENT_BLOCK_TAGLOCATIONPOSTS_SCROLL_FULLVIEW => [PoP_LocationPosts_Module_Processor_CustomSectionDataloads::class, PoP_LocationPosts_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_TAGLOCATIONPOSTS_SCROLL_FULLVIEW],
            self::COMPONENT_BLOCK_TAGLOCATIONPOSTS_SCROLL_THUMBNAIL => [PoP_LocationPosts_Module_Processor_CustomSectionDataloads::class, PoP_LocationPosts_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_TAGLOCATIONPOSTS_SCROLL_THUMBNAIL],
            self::COMPONENT_BLOCK_TAGLOCATIONPOSTS_SCROLL_LIST => [PoP_LocationPosts_Module_Processor_CustomSectionDataloads::class, PoP_LocationPosts_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_TAGLOCATIONPOSTS_SCROLL_LIST],
        );

        return $inner_components[$component->name] ?? null;
    }

    protected function getControlgroupTopSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_BLOCK_AUTHORLOCATIONPOSTS_SCROLL_DETAILS:
            case self::COMPONENT_BLOCK_AUTHORLOCATIONPOSTS_SCROLL_SIMPLEVIEW:
            case self::COMPONENT_BLOCK_AUTHORLOCATIONPOSTS_SCROLL_FULLVIEW:
            case self::COMPONENT_BLOCK_AUTHORLOCATIONPOSTS_SCROLL_THUMBNAIL:
            case self::COMPONENT_BLOCK_AUTHORLOCATIONPOSTS_SCROLL_LIST:
                // Allow URE to add the ContentSource switch
                return [PoP_Module_Processor_CustomControlGroups::class, PoP_Module_Processor_CustomControlGroups::COMPONENT_CONTROLGROUP_BLOCKAUTHORPOSTLIST];

            case self::COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_DETAILS:
            case self::COMPONENT_BLOCK_TAGLOCATIONPOSTS_SCROLL_DETAILS:
            case self::COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_SIMPLEVIEW:
            case self::COMPONENT_BLOCK_TAGLOCATIONPOSTS_SCROLL_SIMPLEVIEW:
            case self::COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_FULLVIEW:
            case self::COMPONENT_BLOCK_TAGLOCATIONPOSTS_SCROLL_FULLVIEW:
            case self::COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_THUMBNAIL:
            case self::COMPONENT_BLOCK_TAGLOCATIONPOSTS_SCROLL_THUMBNAIL:
            case self::COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_LIST:
            case self::COMPONENT_BLOCK_TAGLOCATIONPOSTS_SCROLL_LIST:
                return [PoP_Module_Processor_CustomControlGroups::class, PoP_Module_Processor_CustomControlGroups::COMPONENT_CONTROLGROUP_BLOCKPOSTLIST];
        }

        return parent::getControlgroupTopSubcomponent($component);
    }

    public function getLatestcountSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_DETAILS:
            case self::COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_SIMPLEVIEW:
            case self::COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_FULLVIEW:
            case self::COMPONENT_BLOCK_LOCATIONPOSTS_SCROLL_LIST:
                return [PoPThemeWassup_CommonPages_EM_Module_Processor_SectionLatestCounts::class, PoPThemeWassup_CommonPages_EM_Module_Processor_SectionLatestCounts::COMPONENT_LATESTCOUNT_LOCATIONPOSTS];

            case self::COMPONENT_BLOCK_AUTHORLOCATIONPOSTS_SCROLL_DETAILS:
            case self::COMPONENT_BLOCK_AUTHORLOCATIONPOSTS_SCROLL_SIMPLEVIEW:
            case self::COMPONENT_BLOCK_AUTHORLOCATIONPOSTS_SCROLL_FULLVIEW:
            case self::COMPONENT_BLOCK_AUTHORLOCATIONPOSTS_SCROLL_LIST:
                return [PoPThemeWassup_CommonPages_EM_Module_Processor_SectionLatestCounts::class, PoPThemeWassup_CommonPages_EM_Module_Processor_SectionLatestCounts::COMPONENT_LATESTCOUNT_AUTHOR_LOCATIONPOSTS];

            case self::COMPONENT_BLOCK_TAGLOCATIONPOSTS_SCROLL_DETAILS:
            case self::COMPONENT_BLOCK_TAGLOCATIONPOSTS_SCROLL_SIMPLEVIEW:
            case self::COMPONENT_BLOCK_TAGLOCATIONPOSTS_SCROLL_FULLVIEW:
            case self::COMPONENT_BLOCK_TAGLOCATIONPOSTS_SCROLL_LIST:
                return [PoPThemeWassup_CommonPages_EM_Module_Processor_SectionLatestCounts::class, PoPThemeWassup_CommonPages_EM_Module_Processor_SectionLatestCounts::COMPONENT_LATESTCOUNT_TAG_LOCATIONPOSTS];
        }

        return parent::getLatestcountSubcomponent($component);
    }
}



