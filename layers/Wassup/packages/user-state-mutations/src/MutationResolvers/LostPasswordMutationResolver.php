<?php

declare(strict_types=1);

namespace PoPSitesWassup\UserStateMutations\MutationResolvers;

use PoP\Application\FunctionAPIFactory;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\Misc\GeneralUtils;
use PoP\ComponentModel\MutationResolvers\AbstractMutationResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\Engine\Route\RouteUtils;
use PoP\Root\App;
use PoP\Root\Exception\AbstractException;
use PoP_EmailSender_Utils;
use PoPCMSSchema\SchemaCommons\CMS\CMSServiceInterface;
use PoPCMSSchema\Users\TypeAPIs\UserTypeAPIInterface;
use PoPSitesWassup\UserStateMutations\MutationResolverUtils\MutationResolverUtils;

class LostPasswordMutationResolver extends AbstractMutationResolver
{
    private ?UserTypeAPIInterface $userTypeAPI = null;
    private ?CMSServiceInterface $cmsService = null;

    final public function setUserTypeAPI(UserTypeAPIInterface $userTypeAPI): void
    {
        $this->userTypeAPI = $userTypeAPI;
    }
    final protected function getUserTypeAPI(): UserTypeAPIInterface
    {
        /** @var UserTypeAPIInterface */
        return $this->userTypeAPI ??= $this->instanceManager->getInstance(UserTypeAPIInterface::class);
    }
    final public function setCMSService(CMSServiceInterface $cmsService): void
    {
        $this->cmsService = $cmsService;
    }
    final protected function getCMSService(): CMSServiceInterface
    {
        /** @var CMSServiceInterface */
        return $this->cmsService ??= $this->instanceManager->getInstance(CMSServiceInterface::class);
    }

    public function retrievePasswordMessage($key, $user_login, $user_id): string
    {
        $code = MutationResolverUtils::getLostPasswordCode($key, $user_login);
        $cmsapplicationapi = FunctionAPIFactory::getInstance();

        // protected ComponentProcessorManagerInterface $componentprocessor_manager,
        // $input_name = $componentprocessor_manager->getComponentProcessor([PoP_Module_Processor_LoginTextFormInputs::class, PoP_Module_Processor_LoginTextFormInputs::COMPONENT_FORMINPUT_LOSTPWDRESET_CODE])->getName([PoP_Module_Processor_LoginTextFormInputs::class, PoP_Module_Processor_LoginTextFormInputs::COMPONENT_FORMINPUT_LOSTPWDRESET_CODE]);
        $input_name = POP_INPUTNAME_CODE;
        $link = GeneralUtils::addQueryArgs([
            $input_name => $code,
        ], RouteUtils::getRouteURL(POP_USERLOGIN_ROUTE_LOSTPWDRESET));

        $message = sprintf(
            '<p>%s</p><br/>',
            sprintf(
                $this->__('Someone requested that the password be reset for your account on <a href="%s">%s</a>. If this was a mistake, or if it was not you who requested the password reset, just ignore this email and nothing will happen.', 'pop-application'),
                GeneralUtils::maybeAddTrailingSlash($this->getCMSService()->getHomeURL()),
                $cmsapplicationapi->getSiteName()
            )
        );
        $message .= sprintf(
            '<p>%s</p>',
            $this->__('To reset your password, please click on the following link:</p>', 'pop-application')
        );
        $message .= sprintf(
            '<p>%s</p><br/>',
            sprintf(
                '<a href="%1$s">%1$s</a>',
                $link
            )
        );
        $message .= sprintf(
            '<p>%s</p>',
            $this->__('Alternatively, please paste the following code in the "Code" input:', 'pop-application')
        );
        $message .= sprintf(
            // '<p><pre style="%s">%s</pre></p><br/>',
            // 'background-color: #f1f1f2; width: 100%; padding: 5px;',
            '<p><em>%s</em></p>',
            $code
        );

        return $message;
    }

    public function validateErrors(
        FieldDataAccessorInterface $fieldDataAccessor,
        ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore,
    ): void {
        $user_login = $fieldDataAccessor->getValue(MutationInputProperties::USER_LOGIN);

        // Code copied from file wp-login.php (We can't invoke it directly, since wp-login.php has not been loaded, and we can't do it since it executes a lot of unwanted code producing and output)
        if (empty($user_login)) {
            // @todo Migrate from string to FeedbackItemProvider
            // $objectTypeFieldResolutionFeedbackStore->addError(
            //     new ObjectTypeFieldResolutionFeedback(
            //         new FeedbackItemResolution(
            //             MutationErrorFeedbackItemProvider::class,
            //             MutationErrorFeedbackItemProvider::E1,
            //         ),
            //         $fieldDataAccessor->getField(),
            //     )
            // );
            $errors = [];
            $errors[] = $this->__('Enter a username or e-mail address.');
        } elseif (strpos($user_login, '@')) {
            $user = $this->getUserTypeAPI()->getUserByEmail(trim($user_login));
            if (empty($user)) {
                // @todo Migrate from string to FeedbackItemProvider
            // $objectTypeFieldResolutionFeedbackStore->addError(
            //     new ObjectTypeFieldResolutionFeedback(
            //         new FeedbackItemResolution(
            //             MutationErrorFeedbackItemProvider::class,
            //             MutationErrorFeedbackItemProvider::E1,
            //         ),
            //         $fieldDataAccessor->getField(),
            //     )
            // );
                $errors[] = $this->__('There is no user registered with that email address.');
            }
        } else {
            $login = trim($user_login);
            $user = $this->getUserTypeAPI()->getUserByLogin($login);
        }

        if (!$user) {
            // @todo Migrate from string to FeedbackItemProvider
            // $objectTypeFieldResolutionFeedbackStore->addError(
            //     new ObjectTypeFieldResolutionFeedback(
            //         new FeedbackItemResolution(
            //             MutationErrorFeedbackItemProvider::class,
            //             MutationErrorFeedbackItemProvider::E1,
            //         ),
            //         $fieldDataAccessor->getField(),
            //     )
            // );
            $errors = [];
            $errors[] = $this->__('Invalid username or e-mail.');
        }
    }

    /**
     * @throws AbstractException In case of error
     */
    public function executeMutation(
        FieldDataAccessorInterface $fieldDataAccessor,
        ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore,
    ): mixed {
        $cmsuseraccountapi = \PoP\UserAccount\FunctionAPIFactory::getInstance();
        $user_login = $fieldDataAccessor->getValue(MutationInputProperties::USER_LOGIN);

        if (strpos($user_login, '@')) {
            $user = $this->getUserTypeAPI()->getUserByEmail(trim($user_login));
        } else {
            $login = trim($user_login);
            $user = $this->getUserTypeAPI()->getUserByLogin($login);
        }

        // Generate something random for a password reset key.
        $key = $cmsuseraccountapi->getPasswordResetKey($user);

        /*
        * The blogname option is escaped with esc_html on the way into the database
        * in sanitize_option we want to reverse this for the plain text arena of emails.
        */
        // $site_name = wp_specialchars_decode($cmsapplicationapi->getSiteName(), ENT_QUOTES);
        // $title = sprintf($this->__('[%s] Password Reset'), $site_name);
        $user_id = $this->getUserTypeAPI()->getUserID($user);
        $cmsapplicationapi = FunctionAPIFactory::getInstance();
        $title = sprintf($this->__('[%s] Password Reset'), $cmsapplicationapi->getSiteName());
        $title = App::applyFilters('popcms:retrievePasswordTitle', $title, $user_login, $user);
        $message = $this->retrievePasswordMessage($key, $user_login, $user_id);
        $message = App::applyFilters('popcms:retrievePasswordMessage', $message, $key, $user_login, $user);

        $user_email = $this->getUserTypeAPI()->getUserEmail($user);
        return PoP_EmailSender_Utils::sendEmail($user_email, htmlspecialchars_decode($title)/*wp_specialchars_decode($title)*/, $message);
    }
}
