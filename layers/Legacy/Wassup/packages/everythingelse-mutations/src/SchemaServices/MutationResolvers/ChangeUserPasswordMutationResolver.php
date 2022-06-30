<?php

declare(strict_types=1);

namespace PoPSitesWassup\EverythingElseMutations\SchemaServices\MutationResolvers;

use PoP\GraphQLParser\Spec\Parser\Ast\WithArgumentsInterface;
use PoP\Root\Exception\AbstractException;
use PoP\Root\App;
use PoP\ComponentModel\MutationResolvers\AbstractMutationResolver;
use PoP\UserAccount\FunctionAPIFactory;

class ChangeUserPasswordMutationResolver extends AbstractMutationResolver
{
    public function validateErrors(\PoP\ComponentModel\Mutation\MutationDataProviderInterface $mutationDataProvider): array
    {
        $errors = [];
        $cmsuseraccountapi = FunctionAPIFactory::getInstance();
        // Validate Password
        // Check current password really belongs to the user
        $current_password = $mutationDataProvider->getArgumentValue('current_password');
        $password = $mutationDataProvider->getArgumentValue('password');
        $repeatpassword =  $mutationDataProvider->getArgumentValue('repeat_password');

        if (!$current_password) {
            // @todo Migrate from string to FeedbackItemProvider
            // $errors[] = new FeedbackItemResolution(
            //     MutationErrorFeedbackItemProvider::class,
            //     MutationErrorFeedbackItemProvider::E1,
            // );
            $errors[] = $this->getTranslationAPI()->__('Please provide the current password.', 'pop-application');
        } elseif (!$cmsuseraccountapi->checkPassword($mutationDataProvider->getArgumentValue('user_id'), $current_password)) {
            // @todo Migrate from string to FeedbackItemProvider
            // $errors[] = new FeedbackItemResolution(
            //     MutationErrorFeedbackItemProvider::class,
            //     MutationErrorFeedbackItemProvider::E1,
            // );
            $errors[] = $this->getTranslationAPI()->__('Current password is incorrect.', 'pop-application');
        }

        if (!$password) {
            // @todo Migrate from string to FeedbackItemProvider
            // $errors[] = new FeedbackItemResolution(
            //     MutationErrorFeedbackItemProvider::class,
            //     MutationErrorFeedbackItemProvider::E1,
            // );
            $errors[] = $this->getTranslationAPI()->__('The password cannot be emtpy.', 'pop-application');
        } elseif (strlen($password) < 8) {
            // @todo Migrate from string to FeedbackItemProvider
            // $errors[] = new FeedbackItemResolution(
            //     MutationErrorFeedbackItemProvider::class,
            //     MutationErrorFeedbackItemProvider::E1,
            // );
            $errors[] = $this->getTranslationAPI()->__('The password must be at least 8 characters long.', 'pop-application');
        } else {
            if (!$repeatpassword) {
                // @todo Migrate from string to FeedbackItemProvider
                // $errors[] = new FeedbackItemResolution(
                //     MutationErrorFeedbackItemProvider::class,
                //     MutationErrorFeedbackItemProvider::E1,
                // );
                $errors[] = $this->getTranslationAPI()->__('Please confirm the password.', 'pop-application');
            } elseif ($password !== $repeatpassword) {
                // @todo Migrate from string to FeedbackItemProvider
                // $errors[] = new FeedbackItemResolution(
                //     MutationErrorFeedbackItemProvider::class,
                //     MutationErrorFeedbackItemProvider::E1,
                // );
                $errors[] = $this->getTranslationAPI()->__('Passwords do not match.', 'pop-application');
            }
        }
        return $errors;
    }

    protected function executeChangepassword($user_data)
    {
        $cmseditusersapi = \PoP\EditUsers\FunctionAPIFactory::getInstance();
        return $cmseditusersapi->updateUser($user_data);
    }

    protected function getChangepasswordData(\PoP\ComponentModel\Mutation\MutationDataProviderInterface $mutationDataProvider)
    {
        $user_data = array(
            'id' => $mutationDataProvider->getArgumentValue('user_id'),
            'password' => $mutationDataProvider->getArgumentValue('password')
        );

        return $user_data;
    }

    /**
     * @throws AbstractException In case of error
     */
    public function executeMutation(\PoP\ComponentModel\Mutation\MutationDataProviderInterface $mutationDataProvider): mixed
    {
        $user_data = $this->getChangepasswordData($mutationDataProvider);
        $result = $this->executeChangepassword($user_data);

        $user_id = $user_data['ID'];

        App::doAction('gd_changepassword_user', $user_id, $mutationDataProvider);

        return $user_id;
    }
}
