<?php
use PoP\Definitions\Facades\DefinitionManagerFacade;
use PoP\Root\Routing\DefinitionGroups;
$definitionManager = DefinitionManagerFacade::getInstance();

// Routes
//--------------------------------------------------------
if (!defined('POP_CONTACTUS_ROUTE_CONTACTUS')) {
	define('POP_CONTACTUS_ROUTE_CONTACTUS', $definitionManager->getUniqueDefinition('contact-us', DefinitionGroups::ROUTES));
}

\PoP\Root\App::addFilter(
    \PoP\RootWP\Routing\HookNames::ROUTES,
    function($routes) {
    	return array_merge(
    		$routes,
    		[
    			POP_CONTACTUS_ROUTE_CONTACTUS,
    		]
    	);
    }
);
