<?php
use PoP\Root\Facades\Translation\TranslationAPIFacade;
use PoPCMSSchema\Users\Facades\UserTypeAPIFacade;

class PoP_UserLogin_EmailSender_Hooks
{
    public function __construct()
    {

        //----------------------------------------------------------------------
        // Functional emails
        //----------------------------------------------------------------------
        \PoP\Root\App::addFilter('popcms:retrievePasswordTitle', $this->retrievePasswordTitle(...));
        \PoP\Root\App::addFilter('popcms:retrievePasswordMessage', $this->retrievePasswordMessage(...), PHP_INT_MAX, 4);
        \PoP\Root\App::addAction('gd_lostpasswordreset', $this->lostpasswordreset(...), 10, 1);
    }

    public function retrievePasswordTitle($title)
    {
        return TranslationAPIFacade::getInstance()->__('Password reset code', 'pop-emailsender');
    }
    public function retrievePasswordMessage($message, $key, $user_login, $user)
    {
        $userTypeAPI = UserTypeAPIFacade::getInstance();
        return PoP_EmailTemplatesFactory::getInstance()->addEmailframe(
            TranslationAPIFacade::getInstance()->__('Retrieve password', 'pop-emailsender'), 
            $message, 
            [$userTypeAPI->getUserEmail($user)], 
            [$userTypeAPI->getUserDisplayName($user)]
        );
    }
    public function lostpasswordreset($user_id)
    {
        $cmsuseraccountapi = \PoP\UserAccount\FunctionAPIFactory::getInstance();
        $subject = TranslationAPIFacade::getInstance()->__('Password reset successful', 'pop-emailsender');
        $msg = sprintf(
            '<p>%s %s</p>',
            TranslationAPIFacade::getInstance()->__('Your password has been changed successfully.', 'pop-emailsender'),
            sprintf(
                TranslationAPIFacade::getInstance()->__('Please <a href="%s">click here to log-in</a>.', 'pop-emailsender'),
                $cmsuseraccountapi->getLoginURL()
            )
        );

        PoP_EmailSender_Utils::sendemailToUser($user_id, $subject, $msg);
    }
}

/**
 * Initialization
 */
new PoP_UserLogin_EmailSender_Hooks();
