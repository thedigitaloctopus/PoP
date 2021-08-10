<?php

declare(strict_types=1);

namespace PoPSchema\Users\ModuleProcessors;

use PoPSchema\SchemaCommons\ModuleProcessors\AbstractFilterInputContainerModuleProcessor;
use PoPSchema\SchemaCommons\ModuleProcessors\FormInputs\CommonFilterInputModuleProcessor;
use PoPSchema\Users\ModuleProcessors\FormInputs\FilterInputModuleProcessor;

class UserFilterInputContainerModuleProcessor extends AbstractFilterInputContainerModuleProcessor
{
    public const HOOK_FILTER_INPUTS = __CLASS__ . ':filter-inputs';

    public const MODULE_FILTERINNER_USERS = 'filterinner-users';
    public const MODULE_FILTERINNER_USERCOUNT = 'filterinner-usercount';
    public const MODULE_FILTERINNER_ADMINUSERS = 'filterinner-adminusers';
    public const MODULE_FILTERINNER_ADMINUSERCOUNT = 'filterinner-adminusercount';

    public function getModulesToProcess(): array
    {
        return array(
            [self::class, self::MODULE_FILTERINNER_USERS],
            [self::class, self::MODULE_FILTERINNER_USERCOUNT],
            [self::class, self::MODULE_FILTERINNER_ADMINUSERS],
            [self::class, self::MODULE_FILTERINNER_ADMINUSERCOUNT],
        );
    }

    public function getFilterInputModules(array $module): array
    {
        $filterInputModules = match ($module[1]) {
            self::MODULE_FILTERINNER_USERS,
            self::MODULE_FILTERINNER_ADMINUSERS => [
                [FilterInputModuleProcessor::class, FilterInputModuleProcessor::MODULE_FILTERINPUT_NAME],
                [CommonFilterInputModuleProcessor::class, CommonFilterInputModuleProcessor::MODULE_FILTERINPUT_ORDER],
                [CommonFilterInputModuleProcessor::class, CommonFilterInputModuleProcessor::MODULE_FILTERINPUT_LIMIT],
                [CommonFilterInputModuleProcessor::class, CommonFilterInputModuleProcessor::MODULE_FILTERINPUT_OFFSET],
                [CommonFilterInputModuleProcessor::class, CommonFilterInputModuleProcessor::MODULE_FILTERINPUT_IDS],
                [CommonFilterInputModuleProcessor::class, CommonFilterInputModuleProcessor::MODULE_FILTERINPUT_ID],
            ],
            self::MODULE_FILTERINNER_USERCOUNT,
            self::MODULE_FILTERINNER_ADMINUSERCOUNT => [
                [FilterInputModuleProcessor::class, FilterInputModuleProcessor::MODULE_FILTERINPUT_NAME],
                [CommonFilterInputModuleProcessor::class, CommonFilterInputModuleProcessor::MODULE_FILTERINPUT_IDS],
                [CommonFilterInputModuleProcessor::class, CommonFilterInputModuleProcessor::MODULE_FILTERINPUT_ID],
            ],
            default => [],
        };
        // The "email" is a restricted arg
        if (
            in_array($module[1], [
            self::MODULE_FILTERINNER_ADMINUSERS,
            self::MODULE_FILTERINNER_ADMINUSERCOUNT,
            ])
        ) {
            $filterInputModules[] = [FilterInputModuleProcessor::class, FilterInputModuleProcessor::MODULE_FILTERINPUT_EMAILS];
        }
        return $filterInputModules;
    }

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
}