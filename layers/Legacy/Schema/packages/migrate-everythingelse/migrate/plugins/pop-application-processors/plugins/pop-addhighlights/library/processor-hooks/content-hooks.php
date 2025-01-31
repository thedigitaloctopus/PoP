<?php
use PoPCMSSchema\CustomPosts\Facades\CustomPostTypeAPIFacade;

class PoPTheme_AddHighlights_Processors_ContentHooks
{
    public function __construct()
    {
        \PoP\Root\App::addFilter(
            'PoP_Module_Processor_Contents:inner_component',
            $this->getContentInnerComponent(...),
            10,
            2
        );
    }

    public function getContentInnerComponent(\PoP\ComponentModel\Component\Component $inner, \PoP\ComponentModel\Component\Component $component): \PoP\ComponentModel\Component\Component
    {
        if ($component == [PoP_Module_Processor_Contents::class, PoP_Module_Processor_Contents::COMPONENT_CONTENT_SINGLE] || $component == [PoP_Module_Processor_Contents::class, PoP_Module_Processor_Contents::COMPONENT_CONTENT_USERPOSTINTERACTION]) {
            $post_id = \PoP\Root\App::getState(['routing', 'queried-object-id']);
            $customPostTypeAPI = CustomPostTypeAPIFacade::getInstance();
            if ($customPostTypeAPI->getCustomPostType($post_id) == POP_ADDHIGHLIGHTS_POSTTYPE_HIGHLIGHT) {
                if (($component == [PoP_Module_Processor_Contents::class, PoP_Module_Processor_Contents::COMPONENT_CONTENT_SINGLE])) {
                    return [PoP_Module_Processor_SingleContentInners::class, PoP_Module_Processor_SingleContentInners::COMPONENT_CONTENTINNER_HIGHLIGHTSINGLE];
                }
                if (($component == [PoP_Module_Processor_Contents::class, PoP_Module_Processor_Contents::COMPONENT_CONTENT_USERPOSTINTERACTION])) {
                    return [PoP_Module_Processor_SingleContentInners::class, PoP_Module_Processor_SingleContentInners::COMPONENT_CONTENTINNER_USERHIGHLIGHTPOSTINTERACTION];
                }
            }
        }

        return $inner;
    }
}

/**
 * Initialization
 */
new PoPTheme_AddHighlights_Processors_ContentHooks();
