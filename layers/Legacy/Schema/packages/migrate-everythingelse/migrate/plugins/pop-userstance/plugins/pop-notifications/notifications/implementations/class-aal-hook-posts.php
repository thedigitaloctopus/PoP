<?php
use PoPCMSSchema\CustomPosts\Facades\CustomPostTypeAPIFacade;
use PoPCMSSchema\CustomPosts\Types\Status;
use PoPCMSSchema\Users\ConditionalOnModule\CustomPosts\Facades\CustomPostUserTypeAPIFacade;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}


// By not expending from class AAL_Hook_Base, this code is de-attached from AAL
class PoP_UserStance_Notifications_Hook_Posts /* extends AAL_Hook_Base*/
{
    public function __construct()
    {
        \PoP\Root\App::addAction(
            'GD_CreateUpdate_Stance:createAdditionals',
            $this->createdStance(...)
        );
        \PoP\Root\App::addAction(
            'GD_CreateUpdate_Stance:updateAdditionals',
            $this->updatedStance(...),
            10,
            3
        );
    }

    public function createdStance($post_id)
    {
        $customPostTypeAPI = CustomPostTypeAPIFacade::getInstance();
        if ($customPostTypeAPI->getStatus($post_id) == Status::PUBLISHED) {
            $referenced_post_id = \PoPCMSSchema\CustomPostMeta\Utils::getCustomPostMeta($post_id, GD_METAKEY_POST_STANCETARGET, true);
            $this->referencedPost($post_id, $referenced_post_id);
        }
    }

    public function updatedStance($post_id, WithArgumentsInterface $withArgumentsAST, $log)
    {
        $customPostTypeAPI = CustomPostTypeAPIFacade::getInstance();
        if ($customPostTypeAPI->getStatus($post_id) == Status::PUBLISHED) {
            // If doing a create (changed "draft" to "publish"), then add all references
            if ($log['previous-status'] != Status::PUBLISHED) {
                $referenced_post_id = \PoPCMSSchema\CustomPostMeta\Utils::getCustomPostMeta($post_id, GD_METAKEY_POST_STANCETARGET, true);
                $this->referencedPost($post_id, $referenced_post_id);
            }
        }
    }

    protected function referencedPost($post_id, $referenced_post_id)
    {
        $customPostTypeAPI = CustomPostTypeAPIFacade::getInstance();
        $customPostUserTypeAPI = CustomPostUserTypeAPIFacade::getInstance();
        PoP_Notifications_Utils::insertLog(
            array(
                'user_id' => $customPostUserTypeAPI->getAuthorID($post_id),
                'action' => AAL_POP_ACTION_POST_CREATEDSTANCE,
                'object_type' => 'Post',
                'object_subtype' => $customPostTypeAPI->getCustomPostType($referenced_post_id),
                'object_id' => $referenced_post_id,
                'object_name' => $customPostTypeAPI->getTitle($referenced_post_id),
            )
        );
    }
}
