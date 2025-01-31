<?php

use PoP\Root\Routing\RequestNature;
use PoPCMSSchema\CustomPosts\Routing\RequestNature as CustomPostRequestNature;
use PoPCMSSchema\Tags\Routing\RequestNature as TagRequestNature;
use PoPCMSSchema\Users\Routing\RequestNature as UserRequestNature;

class PoPTheme_Wassup_UserStance_Module_SideInfoContentPageSectionComponentRoutingProcessor extends PoP_Module_SideInfoContentPageSectionComponentRoutingProcessorBase
{
    /**
     * @return array<string,array<string,array<array<string,mixed>>>>
     */
    public function getStatePropertiesToSelectComponentByNatureAndRoute(): array
    {
        $ret = array();

        $components = array(
            POP_USERSTANCE_ROUTE_STANCES => [PoPVP_Module_Processor_SidebarMultiples::class, PoPVP_Module_Processor_SidebarMultiples::COMPONENT_MULTIPLE_TAG_STANCES_SIDEBAR],
            POP_USERSTANCE_ROUTE_STANCES_PRO => [PoPVP_Module_Processor_SidebarMultiples::class, PoPVP_Module_Processor_SidebarMultiples::COMPONENT_MULTIPLE_TAG_STANCES_STANCE_SIDEBAR],
            POP_USERSTANCE_ROUTE_STANCES_NEUTRAL => [PoPVP_Module_Processor_SidebarMultiples::class, PoPVP_Module_Processor_SidebarMultiples::COMPONENT_MULTIPLE_TAG_STANCES_STANCE_SIDEBAR],
            POP_USERSTANCE_ROUTE_STANCES_AGAINST => [PoPVP_Module_Processor_SidebarMultiples::class, PoPVP_Module_Processor_SidebarMultiples::COMPONENT_MULTIPLE_TAG_STANCES_STANCE_SIDEBAR],
        );
        foreach ($components as $route => $component) {
            $ret[TagRequestNature::TAG][$route][] = ['component' => $component];
        }

        $components = array(
            POP_USERSTANCE_ROUTE_STANCES => [PoPVP_Module_Processor_SidebarMultiples::class, PoPVP_Module_Processor_SidebarMultiples::COMPONENT_MULTIPLE_AUTHOR_STANCES_SIDEBAR],
            POP_USERSTANCE_ROUTE_STANCES_PRO => [PoPVP_Module_Processor_SidebarMultiples::class, PoPVP_Module_Processor_SidebarMultiples::COMPONENT_MULTIPLE_AUTHOR_STANCES_STANCE_SIDEBAR],
            POP_USERSTANCE_ROUTE_STANCES_NEUTRAL => [PoPVP_Module_Processor_SidebarMultiples::class, PoPVP_Module_Processor_SidebarMultiples::COMPONENT_MULTIPLE_AUTHOR_STANCES_STANCE_SIDEBAR],
            POP_USERSTANCE_ROUTE_STANCES_AGAINST => [PoPVP_Module_Processor_SidebarMultiples::class, PoPVP_Module_Processor_SidebarMultiples::COMPONENT_MULTIPLE_AUTHOR_STANCES_STANCE_SIDEBAR],
        );
        foreach ($components as $route => $component) {
            $ret[UserRequestNature::USER][$route][] = ['component' => $component];
        }

        $components = array(
            POP_USERSTANCE_ROUTE_MYSTANCES => [PoPVP_Module_Processor_SidebarMultiples::class, PoPVP_Module_Processor_SidebarMultiples::COMPONENT_MULTIPLE_SECTION_MYSTANCES_SIDEBAR],
            POP_USERSTANCE_ROUTE_STANCES => [PoPVP_Module_Processor_SidebarMultiples::class, PoPVP_Module_Processor_SidebarMultiples::COMPONENT_MULTIPLE_SECTION_STANCES_SIDEBAR],
            POP_USERSTANCE_ROUTE_STANCES_PRO => [PoPVP_Module_Processor_SidebarMultiples::class, PoPVP_Module_Processor_SidebarMultiples::COMPONENT_MULTIPLE_SECTION_STANCES_STANCE_SIDEBAR],
            POP_USERSTANCE_ROUTE_STANCES_AGAINST => [PoPVP_Module_Processor_SidebarMultiples::class, PoPVP_Module_Processor_SidebarMultiples::COMPONENT_MULTIPLE_SECTION_STANCES_STANCE_SIDEBAR],
            POP_USERSTANCE_ROUTE_STANCES_NEUTRAL => [PoPVP_Module_Processor_SidebarMultiples::class, PoPVP_Module_Processor_SidebarMultiples::COMPONENT_MULTIPLE_SECTION_STANCES_STANCE_SIDEBAR],
            POP_USERSTANCE_ROUTE_STANCES_PRO_ARTICLE => [PoPVP_Module_Processor_SidebarMultiples::class, PoPVP_Module_Processor_SidebarMultiples::COMPONENT_MULTIPLE_SECTION_STANCES_STANCE_SIDEBAR],
            POP_USERSTANCE_ROUTE_STANCES_AGAINST_ARTICLE => [PoPVP_Module_Processor_SidebarMultiples::class, PoPVP_Module_Processor_SidebarMultiples::COMPONENT_MULTIPLE_SECTION_STANCES_STANCE_SIDEBAR],
            POP_USERSTANCE_ROUTE_STANCES_NEUTRAL_ARTICLE => [PoPVP_Module_Processor_SidebarMultiples::class, PoPVP_Module_Processor_SidebarMultiples::COMPONENT_MULTIPLE_SECTION_STANCES_STANCE_SIDEBAR],
            POP_USERSTANCE_ROUTE_STANCES_PRO_GENERAL => [PoPVP_Module_Processor_SidebarMultiples::class, PoPVP_Module_Processor_SidebarMultiples::COMPONENT_MULTIPLE_SECTION_STANCES_GENERALSTANCE_SIDEBAR],
            POP_USERSTANCE_ROUTE_STANCES_AGAINST_GENERAL => [PoPVP_Module_Processor_SidebarMultiples::class, PoPVP_Module_Processor_SidebarMultiples::COMPONENT_MULTIPLE_SECTION_STANCES_GENERALSTANCE_SIDEBAR],
            POP_USERSTANCE_ROUTE_STANCES_NEUTRAL_GENERAL => [PoPVP_Module_Processor_SidebarMultiples::class, PoPVP_Module_Processor_SidebarMultiples::COMPONENT_MULTIPLE_SECTION_STANCES_GENERALSTANCE_SIDEBAR],
        );
        foreach ($components as $route => $component) {
            $ret[RequestNature::GENERIC][$route][] = ['component' => $component];
        }

        return $ret;
    }

    /**
     * @return array<string,array<array<string,mixed>>>
     */
    public function getStatePropertiesToSelectComponentByNature(): array
    {
        $ret = array();

        $ret[CustomPostRequestNature::CUSTOMPOST][] = [
            'component' => [PoPVP_Module_Processor_SidebarMultiples::class, PoPVP_Module_Processor_SidebarMultiples::COMPONENT_MULTIPLE_SINGLE_STANCE_SIDEBAR],
            'conditions' => [
                'routing' => [
                    'queried-object-post-type' => POP_USERSTANCE_POSTTYPE_USERSTANCE,
                ],
            ],
        ];

        return $ret;
    }
}

/**
 * Initialization
 */
add_action('init', function() {
	\PoP\ComponentRouting\Facades\ComponentRoutingProcessorManagerFacade::getInstance()->addComponentRoutingProcessor(
		new PoPTheme_Wassup_UserStance_Module_SideInfoContentPageSectionComponentRoutingProcessor()
	);
}, 200);
