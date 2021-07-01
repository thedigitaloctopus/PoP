<?php

declare(strict_types=1);

namespace PoP\PoP\Config\Rector\Downgrade\Configurators\ChainedRules;

class MonorepoCacheItemContainerConfigurationService extends AbstractCacheItemContainerConfigurationService
{
    protected function getPaths(): array
    {
        return [
            $this->rootDirectory . '/vendor/symfony/cache/CacheItem.php',
        ];
    }
}
