<?php
use PoP\Engine\Route\RouteUtils;
use PoP\Root\Facades\Translation\TranslationAPIFacade;

class PoP_Events_PageSectionHooks
{
    public function __construct()
    {
        \PoP\Root\App::addAction(
            'PoP_Module_Processor_CustomTabPanePageSections:get_props_block_initial:sideinfo',
            $this->initModelPropsSideinfo(...),
            10,
            3
        );
    }

    public function initModelPropsSideinfo(\PoP\ComponentModel\Component\Component $component, $props_in_array, $processor)
    {
        $cmsengineapi = \PoP\Engine\FunctionAPIFactory::getInstance();
        $subcomponent = [PoP_Events_Module_Processor_CustomSectionBlocks::class, PoP_Events_Module_Processor_CustomSectionBlocks::COMPONENT_BLOCK_EVENTS_SCROLL_ADDONS];
        // if (in_array($subcomponent, $processor->getSubcomponents($component))) {

        $props = &$props_in_array[0];
        
        // We need to lazy-load it, so that it doesn't change the ETag value
        // for when visiting any one page on the site (eg: viewing a post should not say "click here to update" since the post itself was not updated,
        // only the sideinfo with some unrelated content was)
        if (defined('POP_SERVICEWORKERS_INITIALIZED')) {
            if (!PoP_ServiceWorkers_ServerUtils::disableServiceworkers()) {
                $processor->setProp($subcomponent, $props, 'lazy-load', true);
            }
        }

        // Comment Leo 29/10/2017: we can't use skeleton screen, since it will then load posts
        // which may change the ETag value for the page... not worth it
        // // Use the Skeleton screen to load the lazy-load content
        // $processor->setProp($subcomponent, $ret, 'use-skeletonscreen', true);
        // }

        // Add the link
        $processor->setProp($subcomponent, $props, 'title-htmltag', 'h4');
        $processor->setProp($subcomponent, $props, 'add-titlelink', true);
        
        // For the Events scroll
        $processor->setProp([PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_EVENTS_SCROLL_ADDONS], $props, 'limit', 6);
        $processor->setProp([PoP_Events_Module_Processor_CustomScrolls::class, PoP_Events_Module_Processor_CustomScrolls::COMPONENT_SCROLL_EVENTS_ADDONS], $props, 'show-fetchmore', false);

        $link = sprintf(
            '<div class="text-center"><a href="%s" class="btn btn-link">%s</a></div>',
            RouteUtils::getRouteURL(POP_EVENTS_ROUTE_EVENTS),
            TranslationAPIFacade::getInstance()->__('View all events', 'poptheme-wassup')
        );
        $processor->setProp($subcomponent, $props, 'description-bottom', $link);
        // }
    }
}

/**
 * Initialization
 */
new PoP_Events_PageSectionHooks();
