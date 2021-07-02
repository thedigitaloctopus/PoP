<?php
use PoP\Hooks\Facades\HooksAPIFacade;

class PoPTheme_Wassup_LocationPostLinksCreation_WebPlatform_PreloadHooks
{
    public function __construct()
    {
        HooksAPIFacade::getInstance()->addFilter(
            'wassup:extra-routes:initialframes:'.\PoP\ComponentModel\Constants\Targets::MAIN,
            array($this, 'maybeGetRoutesForMain')
        );
        HooksAPIFacade::getInstance()->addFilter(
            'wassup:extra-routes:initialframes:'.POP_TARGET_ADDONS,
            array($this, 'maybeGetRoutesForAddons')
        );
    }

    public function maybeGetRoutesForMain($routes)
    {
        if (PoP_Application_Utils::getAddcontentTarget() == \PoP\ComponentModel\Constants\Targets::MAIN) {
            $routes[] = POP_LOCATIONPOSTLINKSCREATION_ROUTE_ADDLOCATIONPOSTLINK;
        }
        return $routes;
    }

    public function maybeGetRoutesForAddons($routes)
    {
        if (PoP_Application_Utils::getAddcontentTarget() == POP_TARGET_ADDONS) {
            $routes[] = POP_LOCATIONPOSTLINKSCREATION_ROUTE_ADDLOCATIONPOSTLINK;
        }
        return $routes;
    }
}

/**
 * Initialization
 */
new PoPTheme_Wassup_LocationPostLinksCreation_WebPlatform_PreloadHooks();