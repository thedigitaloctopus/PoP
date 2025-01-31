<?php

class PoP_Module_Processor_CommentViewComponentHeaders extends PoP_Module_Processor_CommentViewComponentHeadersBase
{
    public final const COMPONENT_VIEWCOMPONENT_HEADER_COMMENTPOST = 'viewcomponent-header-commentpost';
    public final const COMPONENT_VIEWCOMPONENT_HEADER_COMMENTPOST_URL = 'viewcomponent-header-commentpost-url';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_VIEWCOMPONENT_HEADER_COMMENTPOST,
            self::COMPONENT_VIEWCOMPONENT_HEADER_COMMENTPOST_URL,
        );
    }

    public function getHeaderSubcomponent(\PoP\ComponentModel\Component\Component $component): ?\PoP\ComponentModel\Component\Component
    {
        switch ($component->name) {
            case self::COMPONENT_VIEWCOMPONENT_HEADER_COMMENTPOST:
                return [PoP_Module_Processor_PostViewComponentHeaders::class, PoP_Module_Processor_PostViewComponentHeaders::COMPONENT_VIEWCOMPONENT_HEADER_POST];

            case self::COMPONENT_VIEWCOMPONENT_HEADER_COMMENTPOST_URL:
                return [PoP_Module_Processor_PostViewComponentHeaders::class, PoP_Module_Processor_PostViewComponentHeaders::COMPONENT_VIEWCOMPONENT_HEADER_POST_URL];
        }

        return parent::getHeaderSubcomponent($component);
    }

    public function headerShowUrl(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_VIEWCOMPONENT_HEADER_COMMENTPOST_URL:
                return true;
        }

        return parent::headerShowUrl($component, $props);
    }
}


