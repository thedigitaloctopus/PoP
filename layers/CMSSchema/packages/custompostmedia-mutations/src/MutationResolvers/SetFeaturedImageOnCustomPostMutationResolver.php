<?php

declare(strict_types=1);

namespace PoPCMSSchema\CustomPostMediaMutations\MutationResolvers;

use PoP\GraphQLParser\Spec\Parser\Ast\WithArgumentsInterface;
use PoP\Root\Feedback\FeedbackItemResolution;
use PoP\ComponentModel\MutationResolvers\AbstractMutationResolver;
use PoP\Root\Exception\AbstractException;
use PoPCMSSchema\CustomPostMediaMutations\FeedbackItemProviders\MutationErrorFeedbackItemProvider;
use PoPCMSSchema\CustomPostMediaMutations\TypeAPIs\CustomPostMediaTypeMutationAPIInterface;
use PoPCMSSchema\UserStateMutations\MutationResolvers\ValidateUserLoggedInMutationResolverTrait;

class SetFeaturedImageOnCustomPostMutationResolver extends AbstractMutationResolver
{
    use ValidateUserLoggedInMutationResolverTrait;

    private ?CustomPostMediaTypeMutationAPIInterface $customPostMediaTypeMutationAPI = null;

    final public function setCustomPostMediaTypeMutationAPI(CustomPostMediaTypeMutationAPIInterface $customPostMediaTypeMutationAPI): void
    {
        $this->customPostMediaTypeMutationAPI = $customPostMediaTypeMutationAPI;
    }
    final protected function getCustomPostMediaTypeMutationAPI(): CustomPostMediaTypeMutationAPIInterface
    {
        return $this->customPostMediaTypeMutationAPI ??= $this->instanceManager->getInstance(CustomPostMediaTypeMutationAPIInterface::class);
    }

    /**
     * @throws AbstractException In case of error
     */
    public function executeMutation(\PoP\ComponentModel\Mutation\MutationDataProviderInterface $mutationDataProvider): mixed
    {
        $customPostID = $mutationDataProvider->getArgumentValue(MutationInputProperties::CUSTOMPOST_ID);
        $mediaItemID = $mutationDataProvider->getArgumentValue(MutationInputProperties::MEDIA_ITEM_ID);
        $this->getCustomPostMediaTypeMutationAPI()->setFeaturedImage($customPostID, $mediaItemID);
        return $customPostID;
    }

    public function validateErrors(\PoP\ComponentModel\Mutation\MutationDataProviderInterface $mutationDataProvider): array
    {
        // Check that the user is logged-in
        $errorFeedbackItemResolution = $this->validateUserIsLoggedIn();
        if ($errorFeedbackItemResolution !== null) {
            return [
                $errorFeedbackItemResolution,
            ];
        }

        $errors = [];
        if (!$mutationDataProvider->getArgumentValue(MutationInputProperties::CUSTOMPOST_ID)) {
            $errors[] = new FeedbackItemResolution(
                MutationErrorFeedbackItemProvider::class,
                MutationErrorFeedbackItemProvider::E1,
            );
        }
        if (!$mutationDataProvider->getArgumentValue(MutationInputProperties::MEDIA_ITEM_ID)) {
            $errors[] = new FeedbackItemResolution(
                MutationErrorFeedbackItemProvider::class,
                MutationErrorFeedbackItemProvider::E2,
            );
        }
        return $errors;
    }
}
