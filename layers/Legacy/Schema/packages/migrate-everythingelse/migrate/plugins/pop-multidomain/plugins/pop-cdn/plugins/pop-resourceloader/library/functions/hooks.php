<?php
use PoP\ComponentModel\State\ApplicationState;

class PoP_MultiDomain_CDN_ResourceLoaderProcessor_Hooks
{
    public function __construct()
    {
        \PoP\Root\App::addFilter(
            'PoP_FrontEnd_ResourceLoaderProcessor:dependencies:manager',
            $this->getManagerDependencies(...)
        );
    }

    public function getManagerDependencies($dependencies)
    {

        // If accessing the External page, then we must load the resource-config.js and initialresources.js for the external domain
        // if (\PoP\Root\App::getState('external-url-domain')) {
        if (\PoP\Root\App::getState(['routing', 'is-generic']) && \PoP\Root\App::getState('route') == POP_MULTIDOMAIN_ROUTE_EXTERNAL) {
            $dependencies[] = [PoP_MultiDomain_CDN_DynamicJSResourceLoaderProcessor::class, PoP_MultiDomain_CDN_DynamicJSResourceLoaderProcessor::RESOURCE_CDNCONFIG_EXTERNAL];
        }
        
        return $dependencies;
    }
}

/**
 * Initialization
 */
new PoP_MultiDomain_CDN_ResourceLoaderProcessor_Hooks();
