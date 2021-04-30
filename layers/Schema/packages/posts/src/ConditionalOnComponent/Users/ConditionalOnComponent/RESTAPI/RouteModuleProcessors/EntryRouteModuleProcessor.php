<?php

declare(strict_types=1);

namespace PoPSchema\Posts\ConditionalOnComponent\Users\ConditionalOnComponent\RESTAPI\RouteModuleProcessors;

use PoPSchema\Users\Routing\RouteNatures;
use PoP\API\Response\Schemes as APISchemes;
use PoPSchema\Posts\ComponentConfiguration;
use PoP\ComponentModel\State\ApplicationState;
use PoPSchema\Posts\ConditionalOnComponent\Users\ModuleProcessors\FieldDataloadModuleProcessor;
use PoPSchema\Users\ConditionalOnComponent\CustomPosts\ConditionalOnComponent\RESTAPI\Hooks\CustomPostHooks;
use PoPSchema\CustomPosts\ConditionalOnComponent\RESTAPI\RouteModuleProcessors\AbstractCustomPostRESTEntryRouteModuleProcessor;

class EntryRouteModuleProcessor extends AbstractCustomPostRESTEntryRouteModuleProcessor
{
    protected function getInitialRESTFields(): string
    {
        return str_replace(
            ',' . CustomPostHooks::AUTHOR_RESTFIELDS,
            '',
            parent::getInitialRESTFields()
        );
    }

    /**
     * @return array<string, array<string, array<array>>>
     */
    public function getModulesVarsPropertiesByNatureAndRoute(): array
    {
        $ret = array();
        $vars = ApplicationState::getVars();
        // Author's posts
        $routemodules = array(
            ComponentConfiguration::getPostsRoute() => [
                FieldDataloadModuleProcessor::class,
                FieldDataloadModuleProcessor::MODULE_DATALOAD_RELATIONALFIELDS_AUTHORPOSTLIST,
                [
                    'fields' => isset($vars['query']) ?
                        $vars['query'] :
                        $this->getRESTFields()
                    ]
                ],
        );
        foreach ($routemodules as $route => $module) {
            $ret[RouteNatures::USER][$route][] = [
                'module' => $module,
                'conditions' => [
                    'scheme' => APISchemes::API,
                    'datastructure' => $this->restDataStructureFormatter->getName(),
                ],
            ];
        }
        return $ret;
    }
}
