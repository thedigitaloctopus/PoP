<?php

abstract class PoP_Module_Processor_MenuLayoutsBase extends PoPEngine_QueryDataComponentProcessorBase
{
    /**
     * @todo Migrate from string to LeafComponentFieldNode
     *
     * @return \PoP\ComponentModel\GraphQLEngine\Model\ComponentModelSpec\LeafComponentFieldNode[]
     */
    public function getLeafComponentFieldNodes(\PoP\ComponentModel\Component\Component $component, array &$props): array
    {
        return array('id', 'itemDataEntries(flat:true)@itemDataEntries');
    }

    public function getItemClass(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        return '';
    }

    public function getImmutableConfiguration(\PoP\ComponentModel\Component\Component $component, array &$props): array
    {
        $ret = parent::getImmutableConfiguration($component, $props);

        $ret[GD_JS_CLASSES]['item'] = $this->getItemClass($component, $props);

        return $ret;
    }
}
