<?php

declare(strict_types=1);

namespace PoPSchema\CommentMutations\MutationResolvers;

use PoP\ComponentModel\ErrorHandling\Error;
use PoP\ComponentModel\Misc\GeneralUtils;
use PoP\ComponentModel\MutationResolvers\AbstractMutationResolver;
use PoP\ComponentModel\State\ApplicationState;
use PoP\Hooks\HooksAPIInterface;
use PoP\Translation\TranslationAPIInterface;
use PoPSchema\CommentMutations\TypeAPIs\CommentTypeMutationAPIInterface;
use PoPSchema\Comments\ComponentConfiguration;
use PoPSchema\Comments\TypeAPIs\CommentTypeAPIInterface;
use PoPSchema\Users\TypeAPIs\UserTypeAPIInterface;
use PoPSchema\UserStateMutations\MutationResolvers\ValidateUserLoggedInMutationResolverTrait;

/**
 * Add a comment to a custom post. The user may be logged-in or not
 */
class AddCommentToCustomPostMutationResolver extends AbstractMutationResolver
{
    use ValidateUserLoggedInMutationResolverTrait;

    public function __construct(
        TranslationAPIInterface $translationAPI,
        HooksAPIInterface $hooksAPI,
        protected CommentTypeAPIInterface $commentTypeAPI,
        protected CommentTypeMutationAPIInterface $commentTypeMutationAPI,
        protected UserTypeAPIInterface $userTypeAPI,
    ) {
        parent::__construct(
            $translationAPI,
            $hooksAPI,
        );
    }

    public function validateErrors(array $form_data): ?array
    {
        $errors = [];

        // Check that the user is logged-in
        if (ComponentConfiguration::mustUserBeLoggedInToAddComment()) {
            $this->validateUserIsLoggedIn($errors);
            if ($errors) {
                return $errors;
            }
        } else {
            // Commenter's name and email are mandatory
            if (!isset($form_data[MutationInputProperties::AUTHOR_NAME])) {
                $errors[] = $this->translationAPI->__('The comment author\'s name is missing', 'comment-mutations');
            }
            if (!isset($form_data[MutationInputProperties::AUTHOR_EMAIL])) {
                $errors[] = $this->translationAPI->__('The comment author\'s email is missing', 'comment-mutations');
            }
        }

        // Either provide the customPostID, or retrieve it from the parent comment
        if ((!isset($form_data[MutationInputProperties::CUSTOMPOST_ID]) || !$form_data[MutationInputProperties::CUSTOMPOST_ID]) && (!isset($form_data[MutationInputProperties::PARENT_COMMENT_ID]) || !$form_data[MutationInputProperties::PARENT_COMMENT_ID])) {
            $errors[] = $this->translationAPI->__('The custom post ID is missing.', 'comment-mutations');
        }
        if (!isset($form_data[MutationInputProperties::COMMENT]) || !$form_data[MutationInputProperties::COMMENT]) {
            $errors[] = $this->translationAPI->__('The comment is empty.', 'comment-mutations');
        }
        return $errors;
    }

    protected function additionals(string | int $comment_id, array $form_data): void
    {
        $this->hooksAPI->doAction('gd_addcomment', $comment_id, $form_data);
    }

    protected function getCommentData(array $form_data): array
    {
        $comment_data = [
            'author-IP' => $_SERVER['REMOTE_ADDR'],
            'agent' => $_SERVER['HTTP_USER_AGENT'],
            'content' => $form_data[MutationInputProperties::COMMENT],
            'parent' => $form_data[MutationInputProperties::PARENT_COMMENT_ID],
            'customPostID' => $form_data[MutationInputProperties::CUSTOMPOST_ID]
        ];
        /**
         * If the user is logged in, take his/her properties. This is independent
         * from `CommentsComponentConfiguration::mustUserBeLoggedInToAddComment()`
         */
        $vars = ApplicationState::getVars();
        if ($vars['global-userstate']['is-user-logged-in']) {
            $userID = $vars['global-userstate']['current-user-id'];
            $comment_data['userID'] = $userID;
            $comment_data['author'] = $this->userTypeAPI->getUserDisplayName($userID);
            $comment_data['authorEmail'] = $this->userTypeAPI->getUserEmail($userID);
            $comment_data['author-URL'] = $this->userTypeAPI->getUserURL($userID);
        }
        /**
         * Then, if these specific fields were provided via the form, either because the
         * user is not logged-in or can still add custom info, override the properties.
         */
        if ($authorName = $form_data[MutationInputProperties::AUTHOR_NAME]) {
            $comment_data['author'] = $authorName;
        }
        if ($authorEmail = $form_data[MutationInputProperties::AUTHOR_EMAIL]) {
            $comment_data['authorEmail'] = $authorEmail;
        }
        if ($authorURL = $form_data[MutationInputProperties::AUTHOR_URL]) {
            $comment_data['author-URL'] = $authorURL;
        }


        // If the parent comment is provided and the custom post is not,
        // then retrieve it from there
        if (isset($comment_data['parent']) && !isset($comment_data['customPostID'])) {
            $parentComment = $this->commentTypeAPI->getComment($comment_data['parent']);
            $comment_data['customPostID'] = $this->commentTypeAPI->getCommentPostId($parentComment);
        }

        return $comment_data;
    }

    protected function insertComment(array $comment_data): string | int | Error
    {
        return $this->commentTypeMutationAPI->insertComment($comment_data);
    }

    public function execute(array $form_data): mixed
    {
        $comment_data = $this->getCommentData($form_data);
        $comment_id = $this->insertComment($comment_data);
        if (GeneralUtils::isError($comment_id)) {
            return $comment_id;
        }

        // Allow for additional operations (eg: set Action categories)
        $this->additionals($comment_id, $form_data);

        return $comment_id;
    }
}
