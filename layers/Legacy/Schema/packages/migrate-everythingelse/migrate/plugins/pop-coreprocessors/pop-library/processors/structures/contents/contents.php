<?php

use PoP\ComponentModel\State\ApplicationState;

class PoPCore_Module_Processor_Contents extends PoP_Module_Processor_ContentsBase
{
    public final const COMPONENT_CONTENT_POSTCONCLUSIONSIDEBAR_HORIZONTAL = 'content-postconclusionsidebar-horizontal';
    public final const COMPONENT_CONTENT_SUBJUGATEDPOSTCONCLUSIONSIDEBAR_HORIZONTAL = 'content-subjugatedpostconclusionsidebar-horizontal';
    public final const COMPONENT_CONTENT_LATESTCOUNTS = 'content-latestcounts';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_CONTENT_POSTCONCLUSIONSIDEBAR_HORIZONTAL,
            self::COMPONENT_CONTENT_SUBJUGATEDPOSTCONCLUSIONSIDEBAR_HORIZONTAL,
            self::COMPONENT_CONTENT_LATESTCOUNTS,
        );
    }
    public function getInnerSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        $inners = array(
            self::COMPONENT_CONTENT_POSTCONCLUSIONSIDEBAR_HORIZONTAL => [PoPCore_Module_Processor_SingleContentInners::class, PoPCore_Module_Processor_SingleContentInners::COMPONENT_CONTENTINNER_POSTCONCLUSIONSIDEBAR_HORIZONTAL],
            self::COMPONENT_CONTENT_SUBJUGATEDPOSTCONCLUSIONSIDEBAR_HORIZONTAL => [PoPCore_Module_Processor_SingleContentInners::class, PoPCore_Module_Processor_SingleContentInners::COMPONENT_CONTENTINNER_SUBJUGATEDPOSTCONCLUSIONSIDEBAR_HORIZONTAL],
            self::COMPONENT_CONTENT_LATESTCOUNTS => [PoPCore_Module_Processor_MultipleContentInners::class, PoPCore_Module_Processor_MultipleContentInners::COMPONENT_CONTENTINNER_LATESTCOUNTS],
        );

        if ($inner = $inners[$component->name] ?? null) {
            return $inner;
        }

        return parent::getInnerSubcomponent($component);
    }

    public function initModelProps(\PoP\ComponentModel\Component\Component $component, array &$props): void
    {
        
        switch ($component->name) {
            case self::COMPONENT_CONTENT_POSTCONCLUSIONSIDEBAR_HORIZONTAL:
            case self::COMPONENT_CONTENT_SUBJUGATEDPOSTCONCLUSIONSIDEBAR_HORIZONTAL:
                $this->appendProp($component, $props, 'class', 'conclusion horizontal sidebar');
                break;
        }

        parent::initModelProps($component, $props);
    }
}


