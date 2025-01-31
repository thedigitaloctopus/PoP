<?php
use PoP\Definitions\Facades\DefinitionManagerFacade;
use PoP\Root\Routing\DefinitionGroups;
$definitionManager = DefinitionManagerFacade::getInstance();

// System Pages
//--------------------------------------------------------
if (!defined('POP_SYSTEM_ROUTE_SYSTEM_SAVEDEFINITIONFILE')) {
	define('POP_SYSTEM_ROUTE_SYSTEM_SAVEDEFINITIONFILE', $definitionManager->getUniqueDefinition('system/savedefinitionfile', DefinitionGroups::ROUTES));
}

\PoP\Root\App::addFilter(
    \PoP\RootWP\Routing\HookNames::ROUTES,
    function($routes) {
    	return array_merge(
    		$routes,
    		[
    			POP_SYSTEM_ROUTE_SYSTEM_SAVEDEFINITIONFILE,
    		]
    	);
    }
);
