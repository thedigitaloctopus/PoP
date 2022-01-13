<?php

declare(strict_types=1);

namespace PoPSitesWassup\SocialNetworkMutations\MutationResolvers;

use PoP\Application\PostsFunctionAPIFactory;

abstract class AbstractRecommendOrUnrecommendCustomPostMutationResolver extends AbstractCustomPostUpdateUserMetaValueMutationResolver
{
    protected function eligible($post)
    {
        $cmsapplicationpostsapi = PostsFunctionAPIFactory::getInstance();
        $eligible = in_array($this->getCustomPostTypeAPI()->getCustomPostType($post), $cmsapplicationpostsapi->getAllcontentPostTypes());
        return \PoP\Root\App::getHookManager()->applyFilters('GD_RecommendUnrecommendPost:eligible', $eligible, $post);
    }

    /**
     * Function to override
     */
    protected function additionals($target_id, $form_data): void
    {
        parent::additionals($target_id, $form_data);
        \PoP\Root\App::getHookManager()->doAction('gd_recommendunrecommend_post', $target_id, $form_data);
    }
}
