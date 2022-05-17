<?php

declare(strict_types=1);

namespace PoPCMSSchema\CustomPostCategoriesWP;

use PoP\Root\Module\AbstractModule;

class Module extends AbstractModule
{
    /**
     * @return string[]
     */
    public function getDependedModuleClasses(): array
    {
        return [
            \PoPCMSSchema\CustomPostsWP\Module::class,
            \PoPCMSSchema\CategoriesWP\Module::class,
        ];
    }
}
