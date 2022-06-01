<?php

declare(strict_types=1);

namespace PoP\SiteBuilderAPI\Hooks;

use PoP\Root\App;
use PoP\ComponentModel\ModelInstance\ModelInstance;
use PoP\Root\Hooks\AbstractHookSet;

class ApplicationStateHookSet extends AbstractHookSet
{
    protected function init(): void
    {
        App::addFilter(
            ModelInstance::HOOK_COMPONENTSFROMVARS_RESULT,
            $this->maybeAddComponent(...)
        );
    }

    public function maybeAddComponent(array $elements): array
    {
        if ($stratum = App::getState('stratum')) {
            $elements[] = $this->__('stratum:', 'component-model') . $stratum;
        }

        return $elements;
    }
}
