<?php

declare(strict_types=1);

namespace PoPSitesWassup\SocialNetworkMutations\MutationResolvers;

abstract class AbstractUpvoteOrUndoUpvoteCustomPostMutationResolver extends AbstractCustomPostUpdateUserMetaValueMutationResolver
{
    protected function eligible($post)
    {
        $eligible = in_array($this->getCustomPostTypeAPI()->getCustomPostType($post), \PoP_SocialNetwork_Utils::getUpdownvotePostTypes());
        return \PoP\Root\App::getHookManager()->applyFilters('GD_UpdownvoteUndoUpdownvotePost:eligible', $eligible, $post);
    }

    /**
     * Function to override
     */
    protected function additionals($target_id, $form_data): void
    {
        parent::additionals($target_id, $form_data);
        \PoP\Root\App::getHookManager()->doAction('gd_upvoteundoupvote_post', $target_id, $form_data);
    }
}
