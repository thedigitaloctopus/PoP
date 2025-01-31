<?php

class AAL_PoPProcessors_ProcessorHooks
{
    public function __construct()
    {
        \PoP\Root\App::addFilter(
            'PoP_Module_Processor_UserAccountUtils:login:modules',
            $this->getLoginComponents(...)
        );
    }

    protected function enableLatestnotifications()
    {
        return \PoP\Root\App::applyFilters(
            'AAL_PoPProcessors_ProcessorHooks:latestnotifications:enabled',
            true
        );
    }

    public function getLoginComponents($components)
    {

        // Add the Notifications since the last time the user fetched content from website
        if ($this->enableLatestnotifications()) {
            $components[] = [AAL_PoPProcessors_Module_Processor_Multiples::class, AAL_PoPProcessors_Module_Processor_Multiples::COMPONENT_MULTIPLE_LATESTNOTIFICATIONS];
        }
        return $components;
    }
}

/**
 * Initialization
 */
new AAL_PoPProcessors_ProcessorHooks();
