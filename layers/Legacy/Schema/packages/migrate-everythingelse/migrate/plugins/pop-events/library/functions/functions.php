<?php
use PoP\ComponentModel\Constants\HookNames;
use PoP\Root\Facades\Translation\TranslationAPIFacade;
use PoPCMSSchema\Events\Facades\EventTypeAPIFacade;

// \PoP\Root\App::addFilter('gd_dataload:post_types', 'gdEmAddEventPosttype');
function gdEmAddEventPosttype($post_types)
{
    $eventTypeAPI = EventTypeAPIFacade::getInstance();
    $post_types[] = $eventTypeAPI->getEventCustomPostType();
    return $post_types;
}

function eventHasCategory($event, $cat)
{
    $eventTypeAPI = EventTypeAPIFacade::getInstance();
    $categories = $eventTypeAPI->getCategories($event);
    return isset($categories[$cat]);
}

// \PoP\Root\App::addFilter('gdGetCategories', gdEmGetCategories(...), 10, 2);
// function gdEmGetCategories($categories, $post_id)
// {
//     $eventTypeAPI = EventTypeAPIFacade::getInstance();
//     if ($eventTypeAPI->isEvent($post_id)) {
//         $event = $eventTypeAPI->getEvent($post_id);
//         return array_keys($eventTypeAPI->getCategories($event));
//     }

//     return $categories;
// }

\PoP\Root\App::addFilter('gd_postname', gdEmPostnameImpl(...), 10, 2);
function gdEmPostnameImpl($name, $post_id)
{
    $eventTypeAPI = EventTypeAPIFacade::getInstance();
    if ($eventTypeAPI->isEvent($post_id)) {
        return TranslationAPIFacade::getInstance()->__('Event', 'poptheme-wassup');
    }

    return $name;
}
\PoP\Root\App::addFilter('gd_posticon', gdEmPosticonImpl(...), 10, 2);
function gdEmPosticonImpl($icon, $post_id)
{
    $eventTypeAPI = EventTypeAPIFacade::getInstance();
    if ($eventTypeAPI->isEvent($post_id)) {
        return getRouteIcon(POP_EVENTS_ROUTE_EVENTS, false);
    }

    return $icon;
}

\PoP\Root\App::addFilter(
    HookNames::QUERYDATA_WHITELISTEDPARAMS,
    function($params) {
        $params[] = GD_URLPARAM_YEAR;
        $params[] = GD_URLPARAM_MONTH;
        return $params;
    }
);
