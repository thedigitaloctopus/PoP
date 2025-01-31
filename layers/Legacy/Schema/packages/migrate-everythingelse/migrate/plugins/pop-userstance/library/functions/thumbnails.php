<?php
use PoPCMSSchema\CustomPosts\Facades\CustomPostTypeAPIFacade;

\PoP\Root\App::addFilter('getThumbId:default', 'userstanceThumbDefaulthighlight', 10, 2);
function userstanceThumbDefaulthighlight($thumb_id, $post_id)
{
    if (POP_USERSTANCE_IMAGE_NOFEATUREDIMAGESTANCEPOST) {
        $customPostTypeAPI = CustomPostTypeAPIFacade::getInstance();
        if ($customPostTypeAPI->getCustomPostType($post_id) == POP_USERSTANCE_POSTTYPE_USERSTANCE) {
            return POP_USERSTANCE_IMAGE_NOFEATUREDIMAGESTANCEPOST;
        }
    }

    return $thumb_id;
}
