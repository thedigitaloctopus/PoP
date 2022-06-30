<?php

declare(strict_types=1);

namespace PoPSitesWassup\SocialNetworkMutations\MutationResolvers;

use PoP\GraphQLParser\Spec\Parser\Ast\WithArgumentsInterface;
use PoP\Root\Exception\AbstractException;
use PoP\Root\App;
use PoPCMSSchema\UserMeta\Utils;

class UnfollowUserMutationResolver extends AbstractFollowOrUnfollowUserMutationResolver
{
    public function validateErrors(\PoP\ComponentModel\Mutation\MutationDataProviderInterface $mutationDataProvider): array
    {
        $errors = parent::validateErrors($mutationDataProvider);
        if (!$errors) {
            $user_id = App::getState('current-user-id');
            $target_id = $mutationDataProvider->getArgumentValue('target_id');

            // Check that the logged in user does currently follow that user
            $value = Utils::getUserMeta($user_id, \GD_METAKEY_PROFILE_FOLLOWSUSERS);
            if (!in_array($target_id, $value)) {
                // @todo Migrate from string to FeedbackItemProvider
                // $errors[] = new FeedbackItemResolution(
                //     MutationErrorFeedbackItemProvider::class,
                //     MutationErrorFeedbackItemProvider::E1,
                // );
                $errors[] = sprintf(
                    $this->__('You were not following <em><strong>%s</strong></em>.', 'pop-coreprocessors'),
                    $this->getUserTypeAPI()->getUserDisplayName($target_id)
                );
            }
        }
        return $errors;
    }

    /**
     * Function to override
     */
    protected function additionals($target_id, \PoP\ComponentModel\Mutation\MutationDataProviderInterface $mutationDataProvider): void
    {
        parent::additionals($target_id, $mutationDataProvider);
        App::doAction('gd_unfollowuser', $target_id, $mutationDataProvider);
    }

    // protected function updateValue($value, \PoP\ComponentModel\Mutation\MutationDataProviderInterface $mutationDataProvider) {
    //     // Remove the user from the list
    //     $target_id = $mutationDataProvider->getArgumentValue('target_id');
    //     array_splice($value, array_search($target_id, $value), 1);
    // }
    /**
     * @throws AbstractException In case of error
     */
    protected function update(\PoP\ComponentModel\Mutation\MutationDataProviderInterface $mutationDataProvider): string | int
    {
        $user_id = App::getState('current-user-id');
        $target_id = $mutationDataProvider->getArgumentValue('target_id');

        // Update values
        Utils::deleteUserMeta($user_id, \GD_METAKEY_PROFILE_FOLLOWSUSERS, $target_id);
        Utils::deleteUserMeta($target_id, \GD_METAKEY_PROFILE_FOLLOWEDBY, $user_id);

        // Update the counter
        $count = Utils::getUserMeta($target_id, \GD_METAKEY_PROFILE_FOLLOWERSCOUNT, true);
        $count = $count ? $count : 0;
        Utils::updateUserMeta($target_id, \GD_METAKEY_PROFILE_FOLLOWERSCOUNT, ($count - 1), true);

        return parent::update($mutationDataProvider);
    }
}
