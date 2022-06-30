<?php

declare(strict_types=1);

namespace PoPSitesWassup\NotificationMutations\MutationResolvers;

use PoP\GraphQLParser\Spec\Parser\Ast\WithArgumentsInterface;
use PoP_Notifications_API;
use PoP\Root\Exception\AbstractException;
use PoP\Root\App;
use PoP\ComponentModel\MutationResolvers\AbstractMutationResolver;

abstract class AbstractMarkAsReadOrUnreadNotificationMutationResolver extends AbstractMutationResolver
{
    public function validateErrors(\PoP\ComponentModel\Mutation\MutationDataProviderInterface $mutationDataProvider): array
    {
        $errors = [];
        $histid = $mutationDataProvider->getArgumentValue('histid');
        if (!$histid) {
            // @todo Migrate from string to FeedbackItemProvider
            // $errors[] = new FeedbackItemResolution(
            //     MutationErrorFeedbackItemProvider::class,
            //     MutationErrorFeedbackItemProvider::E1,
            // );
            $errors[] = $this->__('This URL is incorrect.', 'pop-notifications');
        } else {
            // $notification = AAL_Main::instance()->api->getNotification($histid);
            $notification = PoP_Notifications_API::getNotification($histid);
            if (!$notification) {
                // @todo Migrate from string to FeedbackItemProvider
                // $errors[] = new FeedbackItemResolution(
                //     MutationErrorFeedbackItemProvider::class,
                //     MutationErrorFeedbackItemProvider::E1,
                // );
                $errors[] = $this->__('This notification does not exist.', 'pop-notifications');
            }
        }
        return $errors;
    }

    protected function additionals($histid, \PoP\ComponentModel\Mutation\MutationDataProviderInterface $mutationDataProvider): void
    {
        App::doAction('GD_NotificationMarkAsReadUnread:additionals', $histid, $mutationDataProvider);
    }

    abstract protected function getStatus();

    protected function setStatus(\PoP\ComponentModel\Mutation\MutationDataProviderInterface $mutationDataProvider)
    {
        // return AAL_Main::instance()->api->setStatus($mutationDataProvider->getArgumentValue('histid'), $mutationDataProvider->getArgumentValue('user_id'), $this->getStatus());
        return PoP_Notifications_API::setStatus($mutationDataProvider->getArgumentValue('histid'), $mutationDataProvider->getArgumentValue('user_id'), $this->getStatus());
    }

    /**
     * @throws AbstractException In case of error
     */
    public function executeMutation(\PoP\ComponentModel\Mutation\MutationDataProviderInterface $mutationDataProvider): mixed
    {
        $hist_ids = $this->setStatus($mutationDataProvider);
        $this->additionals($mutationDataProvider->getArgumentValue('histid'), $mutationDataProvider);

        return $hist_ids; //$mutationDataProvider->getArgumentValue('histid');
    }
}
