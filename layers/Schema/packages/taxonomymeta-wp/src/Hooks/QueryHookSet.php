<?php

declare(strict_types=1);

namespace PoPSchema\TaxonomyMetaWP\Hooks;

use PoP\Root\Hooks\AbstractHookSet;
use PoPSchema\MetaQueryWP\Helpers\MetaQueryHelpers;
use PoPSchema\TaxonomiesWP\TypeAPIs\TaxonomyTypeAPI;

class QueryHookSet extends AbstractHookSet
{
    protected function init(): void
    {
        \PoP\Root\App::getHookManager()->addFilter(
            TaxonomyTypeAPI::HOOK_QUERY,
            [MetaQueryHelpers::class, 'convertMetaQuery']
        );
    }
}
