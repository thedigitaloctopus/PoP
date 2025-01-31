<?php
use PoP\ComponentModel\Facades\ComponentProcessors\ComponentProcessorManagerFacade;

abstract class PoP_Module_Processor_FetchlinkTypeaheadFormComponentsBase extends PoP_Module_Processor_TypeaheadFormComponentsBase
{
    public function getTemplateResource(\PoP\ComponentModel\Component\Component $component, array &$props): ?array
    {
        // Hack: re-use multiple.tmpl
        return [PoP_BaseCollectionWebPlatform_TemplateResourceLoaderProcessor::class, PoP_BaseCollectionWebPlatform_TemplateResourceLoaderProcessor::RESOURCE_MULTIPLE];
    }

    public function getJsmethods(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        $ret = parent::getJsmethods($component, $props);
        $this->addJsmethod($ret, 'fetchlinkTypeahead');
        return $ret;
    }
    public function getTypeaheadJsmethod(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        return 'fetchlinkTypeahead';
    }

    /**
     * @todo Migrate from string to LeafComponentFieldNode
     *
     * @return \PoP\ComponentModel\GraphQLEngine\Model\ComponentModelSpec\LeafComponentFieldNode[]
     */
    public function getLeafComponentFieldNodes(\PoP\ComponentModel\Component\Component $component, array &$props): array
    {
        $ret = parent::getLeafComponentFieldNodes($component, $props);

        // Add the 'URL' since that's where it will go upon selection of the typeahead value
        $ret[] = 'url';

        return $ret;
    }
    
    public function getImmutableConfiguration(\PoP\ComponentModel\Component\Component $component, array &$props): array
    {
        $componentprocessor_manager = ComponentProcessorManagerFacade::getInstance();

        $ret = parent::getImmutableConfiguration($component, $props);

        // Hack: re-use multiple.tmpl
        $input = $this->getInputSubcomponent($component);
        $ret[GD_JS_SUBCOMPONENTOUTPUTNAMES]['elements'] = [
            \PoP\ComponentModel\Facades\ComponentHelpers\ComponentHelpersFacade::getInstance()->getComponentOutputName($input),
        ];

        return $ret;
    }
}
