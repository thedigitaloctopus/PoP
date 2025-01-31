<?php

use PoP\Root\Routing\RequestNature;

class PoPTheme_Wassup_AddComments_Module_MainContentComponentRoutingProcessor extends \PoP\Application\AbstractMainContentComponentRoutingProcessor
{
    /**
     * @return array<string,array<string,array<array<string,mixed>>>>
     */
    public function getStatePropertiesToSelectComponentByNatureAndRoute(): array
    {
        $ret = array();

        $routeComponents = array(
            POP_ADDCOMMENTS_ROUTE_ADDCOMMENT => [PoP_Module_Processor_CommentsBlocks::class, PoP_Module_Processor_CommentsBlocks::COMPONENT_BLOCK_ADDCOMMENT],
        );
        foreach ($routeComponents as $route => $component) {
            $ret[RequestNature::GENERIC][$route][] = ['component' => $component];
        }

        return $ret;
    }
}

/**
 * Initialization
 */
add_action('init', function() {
	\PoP\ComponentRouting\Facades\ComponentRoutingProcessorManagerFacade::getInstance()->addComponentRoutingProcessor(
		new PoPTheme_Wassup_AddComments_Module_MainContentComponentRoutingProcessor()
	);
}, 200);
