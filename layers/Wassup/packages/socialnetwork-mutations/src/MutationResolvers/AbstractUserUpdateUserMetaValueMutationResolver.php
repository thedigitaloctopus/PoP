<?php

declare(strict_types=1);

namespace PoPSitesWassup\SocialNetworkMutations\MutationResolvers;

use PoP\GraphQLParser\Spec\Parser\Ast\WithArgumentsInterface;
use PoP\Root\App;
use PoPCMSSchema\Users\Constants\InputNames;
use PoPCMSSchema\Users\TypeAPIs\UserTypeAPIInterface;

class AbstractUserUpdateUserMetaValueMutationResolver extends AbstractUpdateUserMetaValueMutationResolver
{
    private ?UserTypeAPIInterface $userTypeAPI = null;

    final public function setUserTypeAPI(UserTypeAPIInterface $userTypeAPI): void
    {
        $this->userTypeAPI = $userTypeAPI;
    }
    final protected function getUserTypeAPI(): UserTypeAPIInterface
    {
        return $this->userTypeAPI ??= $this->instanceManager->getInstance(UserTypeAPIInterface::class);
    }

    public function validateErrors(\PoP\ComponentModel\Mutation\MutationDataProviderInterface $mutationDataProvider): array
    {
        $errors = parent::validateErrors($mutationDataProvider);
        if (!$errors) {
            $target_id = $mutationDataProvider->getArgumentValue('target_id');

            // Make sure the user exists
            $target = $this->getUserTypeAPI()->getUserByID($target_id);
            if (!$target) {
                // @todo Migrate from string to FeedbackItemProvider
                // $errors[] = new FeedbackItemResolution(
                //     MutationErrorFeedbackItemProvider::class,
                //     MutationErrorFeedbackItemProvider::E1,
                // );
                $errors[] = $this->__('The requested user does not exist.', 'pop-coreprocessors');
            }
        }
        return $errors;
    }

    protected function getRequestKey()
    {
        return InputNames::USER_ID;
    }

    protected function additionals($target_id, \PoP\ComponentModel\Mutation\MutationDataProviderInterface $mutationDataProvider): void
    {
        App::doAction('gd_updateusermetavalue:user', $target_id, $mutationDataProvider);
        parent::additionals($target_id, $mutationDataProvider);
    }
}
