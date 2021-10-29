<?php

declare(strict_types=1);

namespace PoPSitesWassup\SystemMutations\MutationResolvers;

use PoP\ComponentModel\MutationResolvers\AbstractMutationResolver;

class GenerateSystemMutationResolver extends AbstractMutationResolver
{
    public function executeMutation(array $form_data): mixed
    {
        $this->getHooksAPI()->doAction('PoP:system-generate');
        return true;
    }
}
