<?php

declare(strict_types=1);

namespace PoPSchema\Settings\TypeAPIs;

use PoPSchema\SchemaCommons\Facades\Services\AllowOrDenySettingsServiceFacade;
use PoPSchema\SchemaCommons\Services\AllowOrDenySettingsServiceInterface;
use PoPSchema\Settings\ComponentConfiguration;
use PoPSchema\Settings\TypeAPIs\SettingsTypeAPIInterface;

abstract class AbstractSettingsTypeAPI implements SettingsTypeAPIInterface
{
    public function __construct(
        protected AllowOrDenySettingsServiceInterface $allowOrDenySettingsService,
    ) {
    }
    
    final public function getOption(string $name): mixed
    {
        /**
         * Check if the allow/denylist validation fails
         * Compare for full match or regex
         */
        $settingsEntries = ComponentConfiguration::getSettingsEntries();
        $settingsBehavior = ComponentConfiguration::getSettingsBehavior();
        if (!$this->allowOrDenySettingsService->isEntryAllowed($name, $settingsEntries, $settingsBehavior)) {
            return null;
        }
        return $this->doGetOption($name);
    }

    abstract protected function doGetOption(string $name): mixed;
}
