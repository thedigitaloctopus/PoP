<?php

use PoP\Root\Routing\RequestNature;
use PoPCMSSchema\Tags\Routing\RequestNature as TagRequestNature;
use PoPCMSSchema\Users\Routing\RequestNature as UserRequestNature;

class PoPTheme_Wassup_CPL_Bootstrap_Module_MainPageSectionComponentRoutingProcessor extends PoP_Module_MainPageSectionComponentRoutingProcessorBase
{
    /**
     * @return array<string,array<string,array<array<string,mixed>>>>
     */
    public function getStatePropertiesToSelectComponentByNatureAndRoute(): array
    {
        $ret = array();

        $routeComponents = array(
            POP_CONTENTPOSTLINKS_ROUTE_CONTENTPOSTLINKS => [PoP_ContentPostLinks_Module_Processor_SectionTabPanelBlocks::class, PoP_ContentPostLinks_Module_Processor_SectionTabPanelBlocks::COMPONENT_BLOCK_TABPANEL_LINKS],
        );
        foreach ($routeComponents as $route => $component) {
            $ret[RequestNature::GENERIC][$route][] = [
                'component' => $component,
                'conditions' => [
                    'themestyle' => GD_THEMESTYLE_WASSUP_EXPANSIVE,
                ],
            ];
        }

        $routeComponents = array(
            POP_CONTENTPOSTLINKS_ROUTE_CONTENTPOSTLINKS => [PoP_ContentPostLinks_Module_Processor_AuthorSectionTabPanelBlocks::class, PoP_ContentPostLinks_Module_Processor_AuthorSectionTabPanelBlocks::COMPONENT_BLOCK_TABPANEL_AUTHORLINKS],
        );
        foreach ($routeComponents as $route => $component) {
            $ret[UserRequestNature::USER][$route][] = [
                'component' => $component,
                'conditions' => [
                    'themestyle' => GD_THEMESTYLE_WASSUP_EXPANSIVE,
                ],
            ];
        }

        $routeComponents = array(
            POP_CONTENTPOSTLINKS_ROUTE_CONTENTPOSTLINKS => [PoP_ContentPostLinks_Module_Processor_TagSectionTabPanelBlocks::class, PoP_ContentPostLinks_Module_Processor_TagSectionTabPanelBlocks::COMPONENT_BLOCK_TABPANEL_TAGLINKS],
        );
        foreach ($routeComponents as $route => $component) {
            $ret[TagRequestNature::TAG][$route][] = [
                'component' => $component,
                'conditions' => [
                    'themestyle' => GD_THEMESTYLE_WASSUP_EXPANSIVE,
                ],
            ];
        }

        return $ret;
    }
}

/**
 * Initialization
 */
add_action('init', function() {
	\PoP\ComponentRouting\Facades\ComponentRoutingProcessorManagerFacade::getInstance()->addComponentRoutingProcessor(
		new PoPTheme_Wassup_CPL_Bootstrap_Module_MainPageSectionComponentRoutingProcessor()
	);
}, 200);
