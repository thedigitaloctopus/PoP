<?php

declare(strict_types=1);

namespace PoPSitesWassup\NotificationMutations\MutationResolverBridges;

use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoPSitesWassup\NotificationMutations\MutationResolvers\MarkAsReadNotificationMutationResolver;
use Symfony\Contracts\Service\Attribute\Required;

class MarkAsReadNotificationMutationResolverBridge extends AbstractMarkAsReadOrUnreadNotificationMutationResolverBridge
{
    private ?MarkAsReadNotificationMutationResolver $markAsReadNotificationMutationResolver = null;

    final public function setMarkAsReadNotificationMutationResolver(MarkAsReadNotificationMutationResolver $markAsReadNotificationMutationResolver): void
    {
        $this->markAsReadNotificationMutationResolver = $markAsReadNotificationMutationResolver;
    }
    final protected function getMarkAsReadNotificationMutationResolver(): MarkAsReadNotificationMutationResolver
    {
        return $this->markAsReadNotificationMutationResolver ??= $this->instanceManager->getInstance(MarkAsReadNotificationMutationResolver::class);
    }

    public function getMutationResolver(): MutationResolverInterface
    {
        return $this->getMarkAsReadNotificationMutationResolver();
    }

    protected function onlyExecuteWhenDoingPost(): bool
    {
        return false;
    }
}
