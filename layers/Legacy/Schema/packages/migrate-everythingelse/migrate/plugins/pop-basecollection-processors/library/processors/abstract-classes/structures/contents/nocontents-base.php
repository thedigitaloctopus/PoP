<?php

abstract class PoP_Module_Processor_NoContentsBase extends PoP_Module_Processor_StructuresBase
{
    public function getTemplateResource(\PoP\ComponentModel\Component\Component $component, array &$props): ?array
    {
        return [PoP_BaseCollectionWebPlatform_TemplateResourceLoaderProcessor::class, PoP_BaseCollectionWebPlatform_TemplateResourceLoaderProcessor::RESOURCE_NOCONTENT];
    }
}
