<?php

class GD_CommonPages_EM_Module_Processor_CustomScrollMapSectionBlocks extends GD_EM_Module_Processor_ScrollMapBlocksBase
{
    public final const COMPONENT_BLOCK_WHOWEARE_SCROLLMAP = 'block-whoweare-scrollmap';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_BLOCK_WHOWEARE_SCROLLMAP,
        );
    }

    protected function getInnerSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        $inner_components = array(
            self::COMPONENT_BLOCK_WHOWEARE_SCROLLMAP => [GD_CommonPages_EM_Module_Processor_CustomScrollMapSectionDataloads::class, GD_CommonPages_EM_Module_Processor_CustomScrollMapSectionDataloads::COMPONENT_DATALOAD_WHOWEARE_SCROLLMAP],
        );

        return $inner_components[$component->name] ?? null;
    }
}



