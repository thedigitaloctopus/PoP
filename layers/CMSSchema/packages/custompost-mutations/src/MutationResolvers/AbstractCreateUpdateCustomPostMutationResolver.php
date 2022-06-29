<?php

declare(strict_types=1);

namespace PoPCMSSchema\CustomPostMutations\MutationResolvers;

use PoP\GraphQLParser\Spec\Parser\Ast\WithArgumentsInterface;
use PoP\Root\Feedback\FeedbackItemResolution;
use PoP\ComponentModel\MutationResolvers\AbstractMutationResolver;
use PoP\LooseContracts\NameResolverInterface;
use PoP\Root\App;
use PoPCMSSchema\CustomPostMutations\Exception\CustomPostCRUDMutationException;
use PoPCMSSchema\CustomPostMutations\FeedbackItemProviders\MutationErrorFeedbackItemProvider;
use PoPCMSSchema\CustomPostMutations\LooseContracts\LooseContractSet;
use PoPCMSSchema\CustomPostMutations\TypeAPIs\CustomPostTypeMutationAPIInterface;
use PoPCMSSchema\CustomPosts\Enums\CustomPostStatus;
use PoPCMSSchema\CustomPosts\TypeAPIs\CustomPostTypeAPIInterface;
use PoPCMSSchema\CustomPosts\TypeResolvers\EnumType\CustomPostStatusEnumTypeResolver;
use PoPCMSSchema\UserRoles\TypeAPIs\UserRoleTypeAPIInterface;
use PoPCMSSchema\UserStateMutations\MutationResolvers\ValidateUserLoggedInMutationResolverTrait;

abstract class AbstractCreateUpdateCustomPostMutationResolver extends AbstractMutationResolver implements CustomPostMutationResolverInterface
{
    use ValidateUserLoggedInMutationResolverTrait;

    public final const HOOK_EXECUTE_CREATE_OR_UPDATE = __CLASS__ . ':execute-create-or-update';
    public final const HOOK_EXECUTE_CREATE = __CLASS__ . ':execute-create';
    public final const HOOK_EXECUTE_UPDATE = __CLASS__ . ':execute-update';
    public final const HOOK_VALIDATE_CONTENT = __CLASS__ . ':validate-content';

    private ?CustomPostStatusEnumTypeResolver $customPostStatusEnumTypeResolver = null;
    private ?NameResolverInterface $nameResolver = null;
    private ?UserRoleTypeAPIInterface $userRoleTypeAPI = null;
    private ?CustomPostTypeAPIInterface $customPostTypeAPI = null;
    private ?CustomPostTypeMutationAPIInterface $customPostTypeMutationAPI = null;

    final public function setCustomPostStatusEnumTypeResolver(CustomPostStatusEnumTypeResolver $customPostStatusEnumTypeResolver): void
    {
        $this->customPostStatusEnumTypeResolver = $customPostStatusEnumTypeResolver;
    }
    final protected function getCustomPostStatusEnumTypeResolver(): CustomPostStatusEnumTypeResolver
    {
        return $this->customPostStatusEnumTypeResolver ??= $this->instanceManager->getInstance(CustomPostStatusEnumTypeResolver::class);
    }
    final public function setNameResolver(NameResolverInterface $nameResolver): void
    {
        $this->nameResolver = $nameResolver;
    }
    final protected function getNameResolver(): NameResolverInterface
    {
        return $this->nameResolver ??= $this->instanceManager->getInstance(NameResolverInterface::class);
    }
    final public function setUserRoleTypeAPI(UserRoleTypeAPIInterface $userRoleTypeAPI): void
    {
        $this->userRoleTypeAPI = $userRoleTypeAPI;
    }
    final protected function getUserRoleTypeAPI(): UserRoleTypeAPIInterface
    {
        return $this->userRoleTypeAPI ??= $this->instanceManager->getInstance(UserRoleTypeAPIInterface::class);
    }
    final public function setCustomPostTypeAPI(CustomPostTypeAPIInterface $customPostTypeAPI): void
    {
        $this->customPostTypeAPI = $customPostTypeAPI;
    }
    final protected function getCustomPostTypeAPI(): CustomPostTypeAPIInterface
    {
        return $this->customPostTypeAPI ??= $this->instanceManager->getInstance(CustomPostTypeAPIInterface::class);
    }
    final public function setCustomPostTypeMutationAPI(CustomPostTypeMutationAPIInterface $customPostTypeMutationAPI): void
    {
        $this->customPostTypeMutationAPI = $customPostTypeMutationAPI;
    }
    final protected function getCustomPostTypeMutationAPI(): CustomPostTypeMutationAPIInterface
    {
        return $this->customPostTypeMutationAPI ??= $this->instanceManager->getInstance(CustomPostTypeMutationAPIInterface::class);
    }

    /**
     * @return FeedbackItemResolution[]
     */
    protected function validateCreateErrors(WithArgumentsInterface $withArgumentsAST): array
    {
        $errors = [];

        // If there are errors here, don't keep validating others
        $this->validateCreateUpdateErrors($errors, $withArgumentsAST);
        if ($errors) {
            return $errors;
        }

        // If already exists any of these errors above, return errors
        $this->validateCreate($errors, $withArgumentsAST);
        if ($errors) {
            return $errors;
        }

        $this->validateContent($errors, $withArgumentsAST);
        $this->validateCreateContent($errors, $withArgumentsAST);

        return $errors;
    }

    /**
     * @return FeedbackItemResolution[]
     */
    protected function validateUpdateErrors(WithArgumentsInterface $withArgumentsAST): array
    {
        $errors = [];

        // If there are errors here, don't keep validating others
        $this->validateCreateUpdateErrors($errors, $withArgumentsAST);
        if ($errors) {
            return $errors;
        }

        // If already exists any of these errors above, return errors
        $this->validateUpdate($errors, $withArgumentsAST);
        if ($errors) {
            return $errors;
        }

        $this->validateContent($errors, $withArgumentsAST);
        $this->validateUpdateContent($errors, $withArgumentsAST);

        return $errors;
    }

    /**
     * @param FeedbackItemResolution[] $errors
     */
    protected function validateCreateUpdateErrors(array &$errors, WithArgumentsInterface $withArgumentsAST): void
    {
        // Check that the user is logged-in
        $errorFeedbackItemResolution = $this->validateUserIsLoggedIn();
        if ($errorFeedbackItemResolution !== null) {
            $errors[] = $errorFeedbackItemResolution;
            return;
        }


        // Validate user permission
        $userID = App::getState('current-user-id');
        $editCustomPostsCapability = $this->getNameResolver()->getName(LooseContractSet::NAME_EDIT_CUSTOMPOSTS_CAPABILITY);
        if (
            !$this->getUserRoleTypeAPI()->userCan(
                $userID,
                $editCustomPostsCapability
            )
        ) {
            $errors[] = new FeedbackItemResolution(
                MutationErrorFeedbackItemProvider::class,
                MutationErrorFeedbackItemProvider::E2,
            );
            return;
        }

        // Check if the user can publish custom posts
        if ($withArgumentsAST->getArgumentValue(MutationInputProperties::STATUS) === CustomPostStatus::PUBLISH) {
            $publishCustomPostsCapability = $this->getNameResolver()->getName(LooseContractSet::NAME_PUBLISH_CUSTOMPOSTS_CAPABILITY);
            if (
                !$this->getUserRoleTypeAPI()->userCan(
                    $userID,
                    $publishCustomPostsCapability
                )
            ) {
                $errors[] = new FeedbackItemResolution(
                    MutationErrorFeedbackItemProvider::class,
                    MutationErrorFeedbackItemProvider::E3,
                );
                return;
            }
        }
    }

    protected function getUserNotLoggedInError(): FeedbackItemResolution
    {
        return new FeedbackItemResolution(
            MutationErrorFeedbackItemProvider::class,
            MutationErrorFeedbackItemProvider::E1,
        );
    }

    /**
     * @param FeedbackItemResolution[] $errors
     */
    protected function validateContent(array &$errors, WithArgumentsInterface $withArgumentsAST): void
    {
        // Validate that the status is valid
        if ($withArgumentsAST->hasArgument(MutationInputProperties::STATUS)) {
            $status = $withArgumentsAST->getArgumentValue(MutationInputProperties::STATUS);
            if (!in_array($status, $this->getCustomPostStatusEnumTypeResolver()->getConsolidatedEnumValues())) {
                $errors[] = new FeedbackItemResolution(
                    MutationErrorFeedbackItemProvider::class,
                    MutationErrorFeedbackItemProvider::E5,
                    [
                        $status
                    ]
                );
            }
        }

        // Allow plugins to add validation for their fields
        App::doAction(
            self::HOOK_VALIDATE_CONTENT,
            array(&$errors),
            $withArgumentsAST
        );
    }

    /**
     * @param FeedbackItemResolution[] $errors
     */
    protected function validateCreateContent(array &$errors, WithArgumentsInterface $withArgumentsAST): void
    {
    }

    /**
     * @param FeedbackItemResolution[] $errors
     */
    protected function validateUpdateContent(array &$errors, WithArgumentsInterface $withArgumentsAST): void
    {
    }

    /**
     * @param FeedbackItemResolution[] $errors
     */
    protected function validateCreate(array &$errors, WithArgumentsInterface $withArgumentsAST): void
    {
        // Either the title or the content must be set
        if (
            !$withArgumentsAST->hasArgument(MutationInputProperties::TITLE)
            && !$withArgumentsAST->hasArgument(MutationInputProperties::CONTENT)
        ) {
            $errors[] = new FeedbackItemResolution(
                MutationErrorFeedbackItemProvider::class,
                MutationErrorFeedbackItemProvider::E4,
            );
        }
    }

    /**
     * @param FeedbackItemResolution[] $errors
     */
    protected function validateUpdate(array &$errors, WithArgumentsInterface $withArgumentsAST): void
    {
        $customPostID = $withArgumentsAST->getArgumentValue(MutationInputProperties::ID);
        if (!$customPostID) {
            $errors[] = new FeedbackItemResolution(
                MutationErrorFeedbackItemProvider::class,
                MutationErrorFeedbackItemProvider::E6,
            );
            return;
        }

        $post = $this->getCustomPostTypeAPI()->getCustomPost($customPostID);
        if (!$post) {
            $errors[] = new FeedbackItemResolution(
                MutationErrorFeedbackItemProvider::class,
                MutationErrorFeedbackItemProvider::E7,
                [
                    $customPostID,
                ]
            );
            return;
        }

        // Check that the user has access to the edited custom post
        $userID = App::getState('current-user-id');
        if (!$this->getCustomPostTypeMutationAPI()->canUserEditCustomPost($userID, $customPostID)) {
            $errors[] = new FeedbackItemResolution(
                MutationErrorFeedbackItemProvider::class,
                MutationErrorFeedbackItemProvider::E8,
                [
                    $customPostID,
                ]
            );
            return;
        }
    }

    protected function additionals(int | string $customPostID, WithArgumentsInterface $withArgumentsAST): void
    {
    }
    protected function updateAdditionals(int | string $customPostID, WithArgumentsInterface $withArgumentsAST, array $log): void
    {
    }
    protected function createAdditionals(int | string $customPostID, WithArgumentsInterface $withArgumentsAST): void
    {
    }

    // protected function addCustomPostType(&$post_data)
    // {
    //     $post_data['custompost-type'] = $this->getCustomPostType();
    // }

    protected function addCreateUpdateCustomPostData(array &$post_data, WithArgumentsInterface $withArgumentsAST): void
    {
        if ($withArgumentsAST->hasArgument(MutationInputProperties::CONTENT)) {
            $post_data['content'] = $withArgumentsAST->getArgumentValue(MutationInputProperties::CONTENT);
        }
        if ($withArgumentsAST->hasArgument(MutationInputProperties::TITLE)) {
            $post_data['title'] = $withArgumentsAST->getArgumentValue(MutationInputProperties::TITLE);
        }
        if ($withArgumentsAST->hasArgument(MutationInputProperties::STATUS)) {
            $post_data['status'] = $withArgumentsAST->getArgumentValue(MutationInputProperties::STATUS);
        }
    }

    protected function getUpdateCustomPostData(WithArgumentsInterface $withArgumentsAST): array
    {
        $post_data = array(
            'id' => $withArgumentsAST->getArgumentValue(MutationInputProperties::ID),
        );
        $this->addCreateUpdateCustomPostData($post_data, $withArgumentsAST);

        return $post_data;
    }

    protected function getCreateCustomPostData(WithArgumentsInterface $withArgumentsAST): array
    {
        $post_data = [
            'custompost-type' => $this->getCustomPostType(),
        ];
        $this->addCreateUpdateCustomPostData($post_data, $withArgumentsAST);

        return $post_data;
    }

    /**
     * @param array<string, mixed> $post_data
     * @return string|int the ID of the updated custom post
     * @throws CustomPostCRUDMutationException If there was an error (eg: Custom Post does not exists)
     */
    protected function executeUpdateCustomPost(array $post_data): string | int
    {
        return $this->getCustomPostTypeMutationAPI()->updateCustomPost($post_data);
    }

    protected function createUpdateCustomPost(WithArgumentsInterface $withArgumentsAST, int | string $customPostID): void
    {
    }

    protected function getUpdateCustomPostDataLog(int | string $customPostID, WithArgumentsInterface $withArgumentsAST): array
    {
        return [
            'previous-status' => $this->getCustomPostTypeAPI()->getStatus($customPostID),
        ];
    }

    /**
     * @return string|int The ID of the updated entity
     * @throws CustomPostCRUDMutationException If there was an error (eg: Custom Post does not exists)
     */
    protected function update(WithArgumentsInterface $withArgumentsAST): string | int
    {
        $post_data = $this->getUpdateCustomPostData($withArgumentsAST);
        $customPostID = $post_data['id'];

        // Create the operation log, to see what changed. Needed for
        // - Send email only when post published
        // - Add user notification of post being referenced, only when the reference is new (otherwise it will add the notification each time the user updates the post)
        $log = $this->getUpdateCustomPostDataLog($customPostID, $withArgumentsAST);

        $customPostID = $this->executeUpdateCustomPost($post_data);

        $this->createUpdateCustomPost($withArgumentsAST, $customPostID);

        // Allow for additional operations (eg: set Action categories)
        $this->additionals($customPostID, $withArgumentsAST);
        $this->updateAdditionals($customPostID, $withArgumentsAST, $log);

        // Inject Share profiles here
        App::doAction(self::HOOK_EXECUTE_CREATE_OR_UPDATE, $customPostID, $withArgumentsAST);
        App::doAction(self::HOOK_EXECUTE_UPDATE, $customPostID, $log, $withArgumentsAST);

        return $customPostID;
    }

    /**
     * @param array<string, mixed> $post_data
     * @return string|int the ID of the created custom post
     * @throws CustomPostCRUDMutationException If there was an error (eg: some Custom Post creation validation failed)
     */
    protected function executeCreateCustomPost(array $post_data): string | int
    {
        return $this->getCustomPostTypeMutationAPI()->createCustomPost($post_data);
    }

    /**
     * @return string|int The ID of the created entity
     * @throws CustomPostCRUDMutationException If there was an error (eg: some Custom Post creation validation failed)
     */
    protected function create(WithArgumentsInterface $withArgumentsAST): string | int
    {
        $post_data = $this->getCreateCustomPostData($withArgumentsAST);
        $customPostID = $this->executeCreateCustomPost($post_data);

        $this->createUpdateCustomPost($withArgumentsAST, $customPostID);

        // Allow for additional operations (eg: set Action categories)
        $this->additionals($customPostID, $withArgumentsAST);
        $this->createAdditionals($customPostID, $withArgumentsAST);

        // Inject Share profiles here
        App::doAction(self::HOOK_EXECUTE_CREATE_OR_UPDATE, $customPostID, $withArgumentsAST);
        App::doAction(self::HOOK_EXECUTE_CREATE, $customPostID, $withArgumentsAST);

        return $customPostID;
    }
}
