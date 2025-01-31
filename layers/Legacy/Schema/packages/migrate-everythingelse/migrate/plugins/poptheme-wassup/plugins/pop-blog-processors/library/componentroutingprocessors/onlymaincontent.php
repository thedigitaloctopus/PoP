<?php

use PoP\Root\Routing\RequestNature;
use PoPCMSSchema\Tags\Routing\RequestNature as TagRequestNature;
use PoPCMSSchema\Users\Routing\RequestNature as UserRequestNature;

class PoPTheme_Wassup_Blog_Module_OnlyMainContentComponentRoutingProcessor extends PoP_Module_OnlyMainContentComponentRoutingProcessorBase
{
    /**
     * @return array<string,array<array<string,mixed>>>
     */
    public function getStatePropertiesToSelectComponentByNature(): array
    {
        $ret = array();

        $default_format_section = PoP_Application_Utils::getDefaultformatByScreen(POP_SCREEN_SECTION);

        // Home modules
        $format_components = array(
            POP_FORMAT_DETAILS => [PoP_Blog_Module_Processor_CustomSectionBlocks::class, PoP_Blog_Module_Processor_CustomSectionBlocks::COMPONENT_BLOCK_HOMECONTENT_SCROLL_DETAILS],
            POP_FORMAT_SIMPLEVIEW => [PoP_Blog_Module_Processor_CustomSectionBlocks::class, PoP_Blog_Module_Processor_CustomSectionBlocks::COMPONENT_BLOCK_HOMECONTENT_SCROLL_SIMPLEVIEW],
            POP_FORMAT_FULLVIEW => [PoP_Blog_Module_Processor_CustomSectionBlocks::class, PoP_Blog_Module_Processor_CustomSectionBlocks::COMPONENT_BLOCK_HOMECONTENT_SCROLL_FULLVIEW],
            POP_FORMAT_THUMBNAIL => [PoP_Blog_Module_Processor_CustomSectionBlocks::class, PoP_Blog_Module_Processor_CustomSectionBlocks::COMPONENT_BLOCK_HOMECONTENT_SCROLL_THUMBNAIL],
            POP_FORMAT_LIST => [PoP_Blog_Module_Processor_CustomSectionBlocks::class, PoP_Blog_Module_Processor_CustomSectionBlocks::COMPONENT_BLOCK_HOMECONTENT_SCROLL_LIST],
        );
        foreach ($format_components as $format => $component) {
            $ret[RequestNature::HOME][] = [
                'component' => $component,
                'conditions' => [
                    'format' => $format,
                ],
            ];
            if ($default_format_section == $format) {
                $ret[RequestNature::HOME][] = [
                    'component' => $component,
                ];
            }
        }

        // Author route blocks
        $format_components = array(
            POP_FORMAT_DETAILS => [PoP_Blog_Module_Processor_CustomSectionBlocks::class, PoP_Blog_Module_Processor_CustomSectionBlocks::COMPONENT_BLOCK_AUTHORCONTENT_SCROLL_DETAILS],
            POP_FORMAT_SIMPLEVIEW => [PoP_Blog_Module_Processor_CustomSectionBlocks::class, PoP_Blog_Module_Processor_CustomSectionBlocks::COMPONENT_BLOCK_AUTHORCONTENT_SCROLL_SIMPLEVIEW],
            POP_FORMAT_FULLVIEW => [PoP_Blog_Module_Processor_CustomSectionBlocks::class, PoP_Blog_Module_Processor_CustomSectionBlocks::COMPONENT_BLOCK_AUTHORCONTENT_SCROLL_FULLVIEW],
            POP_FORMAT_THUMBNAIL => [PoP_Blog_Module_Processor_CustomSectionBlocks::class, PoP_Blog_Module_Processor_CustomSectionBlocks::COMPONENT_BLOCK_AUTHORCONTENT_SCROLL_THUMBNAIL],
            POP_FORMAT_LIST => [PoP_Blog_Module_Processor_CustomSectionBlocks::class, PoP_Blog_Module_Processor_CustomSectionBlocks::COMPONENT_BLOCK_AUTHORCONTENT_SCROLL_LIST],
        );
        foreach ($format_components as $format => $component) {
            $ret[UserRequestNature::USER][] = [
                'component' => $component,
                'conditions' => [
                    'format' => $format,
                ],
            ];
            if ($default_format_section == $format) {
                $ret[UserRequestNature::USER][] = [
                    'component' => $component,
                ];
            }
        }

        // Tag modules
        $format_components = array(
            POP_FORMAT_DETAILS => [PoPTheme_Wassup_Blog_Module_Processor_Groups::class, PoPTheme_Wassup_Blog_Module_Processor_Groups::COMPONENT_GROUP_TAGCONTENT_SCROLL_DETAILS],
            POP_FORMAT_SIMPLEVIEW => [PoPTheme_Wassup_Blog_Module_Processor_Groups::class, PoPTheme_Wassup_Blog_Module_Processor_Groups::COMPONENT_GROUP_TAGCONTENT_SCROLL_SIMPLEVIEW],
            POP_FORMAT_FULLVIEW => [PoPTheme_Wassup_Blog_Module_Processor_Groups::class, PoPTheme_Wassup_Blog_Module_Processor_Groups::COMPONENT_GROUP_TAGCONTENT_SCROLL_FULLVIEW],
            POP_FORMAT_THUMBNAIL => [PoPTheme_Wassup_Blog_Module_Processor_Groups::class, PoPTheme_Wassup_Blog_Module_Processor_Groups::COMPONENT_GROUP_TAGCONTENT_SCROLL_THUMBNAIL],
            POP_FORMAT_LIST => [PoPTheme_Wassup_Blog_Module_Processor_Groups::class, PoPTheme_Wassup_Blog_Module_Processor_Groups::COMPONENT_GROUP_TAGCONTENT_SCROLL_LIST],
        );
        foreach ($format_components as $format => $component) {
            $ret[TagRequestNature::TAG][] = [
                'component' => $component,
                'conditions' => [
                    'format' => $format,
                ],
            ];
            if ($default_format_section == $format) {
                $ret[TagRequestNature::TAG][] = [
                    'component' => $component,
                ];
            }
        }

        return $ret;
    }
}

/**
 * Initialization
 */
add_action('init', function() {
	\PoP\ComponentRouting\Facades\ComponentRoutingProcessorManagerFacade::getInstance()->addComponentRoutingProcessor(
		new PoPTheme_Wassup_Blog_Module_OnlyMainContentComponentRoutingProcessor()
	);
}, 200);
