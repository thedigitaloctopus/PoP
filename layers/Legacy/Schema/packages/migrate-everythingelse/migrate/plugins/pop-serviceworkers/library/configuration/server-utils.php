<?php

use PoP\ComponentModel\ModuleConfiguration as ComponentModelModuleConfiguration;

class PoP_ServiceWorkers_ServerUtils
{
    public static function disableServiceworkers()
    {
        if (PoP_WebPlatform_ServerUtils::disableJs()) {
            return false;
        }

        return getenv('DISABLE_SERVICE_WORKERS') !== false ? strtolower(getenv('DISABLE_SERVICE_WORKERS')) === "true" : false;
    }
}
