<?php
class PoP_ResourceLoader_ProcessorHooks {

	public function __construct() {

		\PoP\Root\App::addFilter(
			'PoP_WebPlatformQueryDataComponentProcessorBase:component-immutable-settings',
			$this->getImmutableSettings(...),
			10,
			4
		);
	}

	function getImmutableSettings($immutable_settings, \PoP\ComponentModel\Component\Component $component, array $props, $processor) {

		// Load the resources. Enable only if enabled by config
		if (PoP_ResourceLoader_ServerUtils::includeResourcesInBody()) {

	        global $pop_resourcemoduledecoratorprocessor_manager;
			if ($resources = $pop_resourcemoduledecoratorprocessor_manager->getProcessorDecorator($processor)->getResources($component, $props)) {
				
				$immutable_settings[GD_JS_RESOURCES] = $resources;
			}
		}

		return $immutable_settings;
	}
}

/**
 * Initialization
 */
new PoP_ResourceLoader_ProcessorHooks();
