<?php
use PoP\ComponentModel\State\ApplicationState;
use PoPCMSSchema\Comments\Facades\CommentTypeAPIFacade;
use PoPCMSSchema\CustomPosts\Facades\CustomPostTypeAPIFacade;

if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

// By not expending from class AAL_Hook_Base, this code is de-attached from AAL
class PoP_AddComments_Notifications_Hook_Comments /* extends AAL_Hook_Base*/
{
    public function __construct()
    {

        // Commented
        \PoP\Root\App::addAction(
            'gd_addcomment',
            $this->commented(...),
            10,
            2
        );

        // When a comment is marked as spam, tell the user about content guidelines
        \PoP\Root\App::addAction(
            'spam_comment',// Must add a loose contract instead: 'popcms:spamComment'
            $this->spamComment(...),
            10,
            1
        );

        // When a comment is deleted from the system, delete all notifications about that comment
        \PoP\Root\App::addAction(
            'delete_comment',// Must add a loose contract instead: 'popcms:deleteComment'
            array(PoP_AddComments_Notifications_API::class, 'clearComment'),
            10,
            1
        );

        // parent::__construct();
    }

    public function commented($comment_id, WithArgumentsInterface $withArgumentsAST)
    {
        $this->logComment($comment_id, $withArgumentsAST->getArgumentValue('user_id'), AAL_POP_ACTION_COMMENT_ADDED);
    }

    public function spamComment($comment_id)
    {

        // Enable if the current logged in user is the System Notification's defined user
        if (!POP_ADDCOMMENTS_URLPLACEHOLDER_SPAMMEDCOMMENTNOTIFICATION || \PoP\Root\App::getState('current-user-id') != POP_NOTIFICATIONS_USERPLACEHOLDER_SYSTEMNOTIFICATIONS) {
            return;
        }

        $this->logComment($comment_id, POP_NOTIFICATIONS_USERPLACEHOLDER_SYSTEMNOTIFICATIONS, AAL_POP_ACTION_COMMENT_SPAMMEDCOMMENT);
    }

    protected function logComment($comment_id, $user_id, $action)
    {
        $commentTypeAPI = CommentTypeAPIFacade::getInstance();
        $customPostTypeAPI = CustomPostTypeAPIFacade::getInstance();
        $comment = $commentTypeAPI->getComment($comment_id);
        PoP_Notifications_Utils::insertLog(
            array(
                'user_id' => $user_id,
                'action' => $action,
                'object_type' => 'Comments',
                'object_subtype' => $customPostTypeAPI->getCustomPostType($commentTypeAPI->getCommentPostID($comment)),
                'object_id' => $comment_id,
                'object_name' => $customPostTypeAPI->getTitle($commentTypeAPI->getCommentPostID($comment)),
            )
        );
    }
}
