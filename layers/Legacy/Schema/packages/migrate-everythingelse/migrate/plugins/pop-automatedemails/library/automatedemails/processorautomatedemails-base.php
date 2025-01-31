<?php
use PoP\ComponentRouting\Facades\ComponentRoutingProcessorManagerFacade;

class PoP_ProcessorAutomatedEmailsBase extends PoP_AutomatedEmailsBase
{
    protected function getPagesectionSettingsid()
    {
        
        // By default, use the main pageSection
        return [PoP_Module_Processor_PageSections::class, PoP_Module_Processor_PageSections::COMPONENT_PAGESECTION_BODY];
    }

    protected function getBlockComponent()
    {
        $pop_component_componentroutingprocessor_manager = ComponentRoutingProcessorManagerFacade::getInstance();
        return $pop_component_componentroutingprocessor_manager->getRoutingComponentByMostAllMatchingStateProperties(POP_PAGECOMPONENTGROUPPLACEHOLDER_MAINCONTENTCOMPONENT);
    }
    
    protected function getContent()
    {
        $content = PoP_ServerSideRenderingFactory::getInstance()->renderBlock($this->getPagesectionSettingsid(), $this->getBlockComponent());

        // Newsletter: remove all unwanted HTML output, such as Javascript code
        // Taken from https://stackoverflow.com/questions/7130867/remove-script-tag-from-html-content#7131156
        $content = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $content);

        return $content;
    }
    
    protected function hasResults()
    {
        $pagesection_settings_id = $this->getPagesectionSettingsid();
        $block_component = $this->getBlockComponent();
        $block_settings_id = \PoP\ComponentModel\Facades\ComponentHelpers\ComponentHelpersFacade::getInstance()->getComponentOutputName($block_component);
        $json = PoP_ServerSideRenderingFactory::getInstance()->getJson();
        return !empty($json['datasetcomponentdata']['combinedstate']['objectIDs'][$pagesection_settings_id][$block_settings_id]);
    }
}
