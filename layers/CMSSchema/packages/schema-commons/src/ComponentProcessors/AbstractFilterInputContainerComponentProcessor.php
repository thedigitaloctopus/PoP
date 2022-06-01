<?php

declare(strict_types=1);

namespace PoPCMSSchema\SchemaCommons\ComponentProcessors;

use PoP\ComponentModel\ComponentProcessors\AbstractFilterInputContainerComponentProcessor as UpstreamAbstractFilterInputContainerComponentProcessor;
use PoPCMSSchema\SchemaCommons\ComponentProcessors\FormInputs\CommonFilterInputComponentProcessor;

abstract class AbstractFilterInputContainerComponentProcessor extends UpstreamAbstractFilterInputContainerComponentProcessor
{
    public const HOOK_FILTER_INPUTS = __CLASS__ . ':filter-inputs';

    /**
     * @return string[]
     */
    protected function getFilterInputHookNames(): array
    {
        return [
            ...parent::getFilterInputHookNames(),
            self::HOOK_FILTER_INPUTS,
        ];
    }

    /**
     * @return array<array<mixed>>
     */
    protected function getPaginationFilterInputComponents(): array
    {
        return [
            new \PoP\ComponentModel\Component\Component(CommonFilterInputComponentProcessor::class, CommonFilterInputComponentProcessor::COMPONENT_FILTERINPUT_SORT),
            new \PoP\ComponentModel\Component\Component(CommonFilterInputComponentProcessor::class, CommonFilterInputComponentProcessor::COMPONENT_FILTERINPUT_LIMIT),
            new \PoP\ComponentModel\Component\Component(CommonFilterInputComponentProcessor::class, CommonFilterInputComponentProcessor::COMPONENT_FILTERINPUT_OFFSET),
        ];
    }

    /**
     * @return array<array<mixed>>
     */
    protected function getIDFilterInputComponents(): array
    {
        return [
            new \PoP\ComponentModel\Component\Component(CommonFilterInputComponentProcessor::class, CommonFilterInputComponentProcessor::COMPONENT_FILTERINPUT_IDS),
            new \PoP\ComponentModel\Component\Component(CommonFilterInputComponentProcessor::class, CommonFilterInputComponentProcessor::COMPONENT_FILTERINPUT_EXCLUDE_IDS),
        ];
    }
}
