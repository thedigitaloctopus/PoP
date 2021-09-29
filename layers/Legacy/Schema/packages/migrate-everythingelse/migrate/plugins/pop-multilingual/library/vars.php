<?php
use PoP\ComponentModel\ModelInstance\ModelInstance;
use PoP\Hooks\Facades\HooksAPIFacade;

HooksAPIFacade::getInstance()->addFilter(
	ModelInstance::HOOK_COMPONENTS_RESULT, 
	function($components) {
	    // Add the language
	    $pluginapi = PoP_Multilingual_FunctionsAPIFactory::getInstance();
	    $components[] = $pluginapi->getCurrentLanguage();
	    return $components;
	}
);
