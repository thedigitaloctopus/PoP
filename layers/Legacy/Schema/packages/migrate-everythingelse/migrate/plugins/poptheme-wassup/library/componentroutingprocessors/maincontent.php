<?php

use PoP\Root\Routing\RequestNature;
use PoPCMSSchema\CustomPosts\Routing\RequestNature as CustomPostRequestNature;
use PoPCMSSchema\Pages\Routing\RequestNature as PageRequestNature;
use PoPCMSSchema\Tags\Routing\RequestNature as TagRequestNature;
use PoPCMSSchema\Users\Routing\RequestNature as UserRequestNature;

class PoP_Module_MainContentComponentRoutingProcessor extends \PoP\Application\AbstractMainContentComponentRoutingProcessor
{
    /**
     * @return array<string,array<string,array<array<string,mixed>>>>
     */
    public function getStatePropertiesToSelectComponentByNatureAndRoute(): array
    {
        $ret = array();

        // Author
        $components = array(
            POP_ROUTE_DESCRIPTION => [PoP_Module_Processor_CustomContentBlocks::class, PoP_Module_Processor_CustomContentBlocks::COMPONENT_BLOCK_AUTHOR_CONTENT],
        );
        foreach ($components as $route => $component) {
            $ret[UserRequestNature::USER][$route][] = ['component' => $component];
        }
        // Tag
        $components = array(
            POP_ROUTE_DESCRIPTION => [PoP_Module_Processor_CustomContentBlocks::class, PoP_Module_Processor_CustomContentBlocks::COMPONENT_BLOCK_TAG_CONTENT],
        );
        foreach ($components as $route => $component) {
            $ret[TagRequestNature::TAG][$route][] = ['component' => $component];
        }

        // Single main content
        $default_format_singleusers = PoP_Application_Utils::getDefaultformatByScreen(POP_SCREEN_SINGLEUSERS);
        $routeComponents_userdetails = array(
            POP_ROUTE_AUTHORS => [PoP_Module_Processor_SectionBlocks::class, PoP_Module_Processor_SectionBlocks::COMPONENT_BLOCK_SINGLEAUTHORS_SCROLL_DETAILS],
        );
        foreach ($routeComponents_userdetails as $route => $component) {
            $ret[CustomPostRequestNature::CUSTOMPOST][$route][] = [
                'component' => $component,
                'conditions' => [
                    'format' => POP_FORMAT_DETAILS,
                ],
            ];
            if ($default_format_singleusers == POP_FORMAT_DETAILS) {
                $ret[CustomPostRequestNature::CUSTOMPOST][$route][] = ['component' => $component];
            }
        }
        $routeComponents_userfullview = array(
            POP_ROUTE_AUTHORS => [PoP_Module_Processor_SectionBlocks::class, PoP_Module_Processor_SectionBlocks::COMPONENT_BLOCK_SINGLEAUTHORS_SCROLL_FULLVIEW],
        );
        foreach ($routeComponents_userfullview as $route => $component) {
            $ret[CustomPostRequestNature::CUSTOMPOST][$route][] = [
                'component' => $component,
                'conditions' => [
                    'format' => POP_FORMAT_FULLVIEW,
                ],
            ];
            if ($default_format_singleusers == POP_FORMAT_FULLVIEW) {
                $ret[CustomPostRequestNature::CUSTOMPOST][$route][] = ['component' => $component];
            }
        }
        $routeComponents_userthumbnail = array(
            POP_ROUTE_AUTHORS => [PoP_Module_Processor_SectionBlocks::class, PoP_Module_Processor_SectionBlocks::COMPONENT_BLOCK_SINGLEAUTHORS_SCROLL_THUMBNAIL],
        );
        foreach ($routeComponents_userthumbnail as $route => $component) {
            $ret[CustomPostRequestNature::CUSTOMPOST][$route][] = [
                'component' => $component,
                'conditions' => [
                    'format' => POP_FORMAT_THUMBNAIL,
                ],
            ];
            if ($default_format_singleusers == POP_FORMAT_THUMBNAIL) {
                $ret[CustomPostRequestNature::CUSTOMPOST][$route][] = ['component' => $component];
            }
        }
        $routeComponents_userlist = array(
            POP_ROUTE_AUTHORS => [PoP_Module_Processor_SectionBlocks::class, PoP_Module_Processor_SectionBlocks::COMPONENT_BLOCK_SINGLEAUTHORS_SCROLL_LIST],
        );
        foreach ($routeComponents_userlist as $route => $component) {
            $ret[CustomPostRequestNature::CUSTOMPOST][$route][] = [
                'component' => $component,
                'conditions' => [
                    'format' => POP_FORMAT_LIST,
                ],
            ];
            if ($default_format_singleusers == POP_FORMAT_LIST) {
                $ret[CustomPostRequestNature::CUSTOMPOST][$route][] = ['component' => $component];
            }
        }

        return $ret;
    }

    /**
     * @return array<string,array<array<string,mixed>>>
     */
    public function getStatePropertiesToSelectComponentByNature(): array
    {
        $ret = array();

        // 404
        $ret[RequestNature::NOTFOUND][] = [
            'component' => [PoP_Module_Processor_Codes::class, PoP_Module_Processor_Codes::COMPONENT_CODE_404]
        ];

        // Single
        $ret[CustomPostRequestNature::CUSTOMPOST][] = [
            'component' => [PoP_Module_Processor_CustomContentBlocks::class, PoP_Module_Processor_CustomContentBlocks::COMPONENT_BLOCK_SINGLE_CONTENT]
        ];

        // Page
        $ret[PageRequestNature::PAGE][] = [
            'component' => [PoP_Module_Processor_CustomContentBlocks::class, PoP_Module_Processor_CustomContentBlocks::COMPONENT_BLOCK_PAGE_CONTENT]
        ];

        return $ret;
    }
}

/**
 * Initialization
 */
add_action('init', function() {
	\PoP\ComponentRouting\Facades\ComponentRoutingProcessorManagerFacade::getInstance()->addComponentRoutingProcessor(
		new PoP_Module_MainContentComponentRoutingProcessor()
	);
}, 200);
