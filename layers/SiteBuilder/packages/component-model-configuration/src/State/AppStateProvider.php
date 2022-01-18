<?php

declare(strict_types=1);

namespace PoP\ConfigurationComponentModel\State;

use PoP\ComponentModel\Component as ComponentModelComponent;
use PoP\ComponentModel\ComponentConfiguration as ComponentModelComponentConfiguration;
use PoP\ConfigurationComponentModel\Configuration\EngineRequest;
use PoP\ConfigurationComponentModel\Constants\Params;
use PoP\ConfigurationComponentModel\Constants\Targets;
use PoP\ConfigurationComponentModel\Constants\Values;
use PoP\Root\App;
use PoP\Root\State\AbstractAppStateProvider;

class AppStateProvider extends AbstractAppStateProvider
{
    public function initialize(array &$state): void
    {
        // Override the settings from ComponentModel
        /** @var ComponentModelComponentConfiguration */
        $componentModelComponentConfiguration = App::getComponent(ComponentModelComponent::class)->getConfiguration();
        $enableModifyingEngineBehaviorViaRequest = $componentModelComponentConfiguration->enableModifyingEngineBehaviorViaRequest();
        $state['dataoutputitems'] = EngineRequest::getDataOutputItems($enableModifyingEngineBehaviorViaRequest);

        // If not target, or invalid, reset it to "main"
        // We allow an empty target if none provided, so that we can generate the settings cache when no target is provided
        // (ie initial load) and when target is provided (ie loading pageSection)
        $target = strtolower($_REQUEST[Params::TARGET] ?? '');
        $targets = (array) App::applyFilters(
            'ApplicationState:targets',
            [
                Targets::MAIN,
            ]
        );
        if (!in_array($target, $targets)) {
            $target = Targets::MAIN;
        }

        // If there is not format, then set it to 'default'
        // This is needed so that the /generate/ generated configurations under a $model_instance_id (based on the value of $state)
        // can match the same $model_instance_id when visiting that page
        $format = isset($_REQUEST[Params::FORMAT]) ? strtolower($_REQUEST[Params::FORMAT]) : Values::DEFAULT;

        $state['target'] = $target;
        $state['format'] = $format;
    }
}
