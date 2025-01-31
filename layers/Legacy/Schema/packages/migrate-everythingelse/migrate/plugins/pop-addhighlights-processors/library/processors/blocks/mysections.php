<?php

class PoP_AddHighlights_Module_Processor_MySectionBlocks extends PoP_Module_Processor_MySectionBlocksBase
{
    public final const COMPONENT_BLOCK_MYHIGHLIGHTS_TABLE_EDIT = 'block-myhighlights-table-edit';
    public final const COMPONENT_BLOCK_MYHIGHLIGHTS_SCROLL_FULLVIEWPREVIEW = 'block-myhighlights-scroll-fullviewpreview';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_BLOCK_MYHIGHLIGHTS_TABLE_EDIT,
            self::COMPONENT_BLOCK_MYHIGHLIGHTS_SCROLL_FULLVIEWPREVIEW,
        );
    }

    public function getRelevantRoute(\PoP\ComponentModel\Component\Component $component, array &$props): ?string
    {
        return match($component->name) {
            self::COMPONENT_BLOCK_MYHIGHLIGHTS_SCROLL_FULLVIEWPREVIEW => POP_ADDHIGHLIGHTS_ROUTE_MYHIGHLIGHTS,
            self::COMPONENT_BLOCK_MYHIGHLIGHTS_TABLE_EDIT => POP_ADDHIGHLIGHTS_ROUTE_MYHIGHLIGHTS,
            default => parent::getRelevantRoute($component, $props),
        };
    }

    protected function getInnerSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        $inner_components = array(
            self::COMPONENT_BLOCK_MYHIGHLIGHTS_TABLE_EDIT => [PoP_AddHighlights_Module_Processor_MySectionDataloads::class, PoP_AddHighlights_Module_Processor_MySectionDataloads::COMPONENT_DATALOAD_MYHIGHLIGHTS_TABLE_EDIT],
            self::COMPONENT_BLOCK_MYHIGHLIGHTS_SCROLL_FULLVIEWPREVIEW => [PoP_AddHighlights_Module_Processor_MySectionDataloads::class, PoP_AddHighlights_Module_Processor_MySectionDataloads::COMPONENT_DATALOAD_MYHIGHLIGHTS_SCROLL_FULLVIEWPREVIEW],
        );

        return $inner_components[$component->name] ?? null;
    }

    protected function getControlgroupTopSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_BLOCK_MYHIGHLIGHTS_TABLE_EDIT:
            case self::COMPONENT_BLOCK_MYHIGHLIGHTS_SCROLL_FULLVIEWPREVIEW:
                return [PoP_AddHighlights_Module_Processor_CustomControlGroups::class, PoP_AddHighlights_Module_Processor_CustomControlGroups::COMPONENT_CONTROLGROUP_MYHIGHLIGHTLIST];
        }

        return parent::getControlgroupTopSubcomponent($component);
    }
}



