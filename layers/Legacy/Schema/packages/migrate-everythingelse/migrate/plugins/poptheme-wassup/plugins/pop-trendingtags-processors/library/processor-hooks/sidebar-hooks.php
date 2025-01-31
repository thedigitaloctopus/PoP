<?php

class PoP_TrendingTags_SidebarHooks
{
    public function __construct()
    {
        \PoP\Root\App::addFilter(
            'PoP_Module_Processor_SidebarMultiplesBase:modules',
            $this->getSidebarSubcomponents(...),
            0,
            4
        );
    }

    public function getSidebarSubcomponents($components, $screengroup, $screen, \PoP\ComponentModel\Component\Component $component)
    {

        // Add the Trending Tags to all Groups in the Sideinfo
        // Allow GetPoP to remove it
        $includeScreengroups = \PoP\Root\App::applyFilters(
            'PoPTheme_Wassup_SidebarHooks:sidebar_components:includeScreengroups',
            array(
                POP_SCREENGROUP_CONTENTREAD,
            )
        );
        $exclude_screens = array(
            POP_SCREEN_TAGS,
        );
        if (in_array($screengroup, $includeScreengroups) && !in_array($screen, $exclude_screens)) {
            $components[] = [PoP_TrendingTags_Module_Processor_SectionBlocks::class, PoP_TrendingTags_Module_Processor_SectionBlocks::COMPONENT_BLOCK_TRENDINGTAGS_SCROLL_LIST];
        }

        return $components;
    }
}

/**
 * Initialization
 */
new PoP_TrendingTags_SidebarHooks();
