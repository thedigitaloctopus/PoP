<?php

use PoP\ComponentModel\State\ApplicationState;
use PoPCMSSchema\CustomPosts\Facades\CustomPostTypeAPIFacade;
use PoPCMSSchema\CustomPosts\Types\Status;

class PoP_AddHighlights_Module_Processor_SingleSectionTabPanelBlocks extends PoP_Module_Processor_SingleTabPanelSectionBlocksBase
{
    public final const COMPONENT_BLOCK_TABPANEL_SINGLERELATEDHIGHLIGHTCONTENT = 'block-tabpanel-singlerelatedhighlightcontent';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_BLOCK_TABPANEL_SINGLERELATEDHIGHLIGHTCONTENT,
        );
    }

    protected function getInnerSubcomponents(\PoP\ComponentModel\Component\Component $component): array
    {
        $ret = parent::getInnerSubcomponents($component);

        $inners = array(
            self::COMPONENT_BLOCK_TABPANEL_SINGLERELATEDHIGHLIGHTCONTENT => [PoP_AddHighlights_Module_Processor_SingleSectionTabPanelComponents::class, PoP_AddHighlights_Module_Processor_SingleSectionTabPanelComponents::COMPONENT_TABPANEL_SINGLERELATEDHIGHLIGHTCONTENT],
        );
        if ($inner = $inners[$component->name] ?? null) {
            $ret[] = $inner;
        }

        return $ret;
    }

    protected function getControlgroupBottomSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_BLOCK_TABPANEL_SINGLERELATEDHIGHLIGHTCONTENT:
                return [PoP_Module_Processor_CustomControlGroups::class, PoP_Module_Processor_CustomControlGroups::COMPONENT_CONTROLGROUP_SUBMENUPOSTLIST];
        }

        return parent::getControlgroupBottomSubcomponent($component);
    }

    public function initRequestProps(\PoP\ComponentModel\Component\Component $component, array &$props): void
    {
        $customPostTypeAPI = CustomPostTypeAPIFacade::getInstance();
        switch ($component->name) {
            case self::COMPONENT_BLOCK_TABPANEL_SINGLERELATEDHIGHLIGHTCONTENT:
                $post_id = \PoP\Root\App::getState(['routing', 'queried-object-id']);
                if ($customPostTypeAPI->getStatus($post_id) !== Status::PUBLISHED) {
                    $this->setProp($component, $props, 'show-controls-bottom', false);
                }
                break;
        }

        parent::initRequestProps($component, $props);
    }

    public function getDelegatorfilterSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_BLOCK_TABPANEL_SINGLERELATEDHIGHLIGHTCONTENT:
                return [PoP_AddHighlights_Module_Processor_CustomFilters::class, PoP_AddHighlights_Module_Processor_CustomFilters::COMPONENT_FILTER_HIGHLIGHTS];
        }

        return parent::getDelegatorfilterSubcomponent($component);
    }
}


