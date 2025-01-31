<?php

class GD_UserLogin_Module_Processor_UserFeedbackMessages extends PoP_Module_Processor_FeedbackMessagesBase
{
    public final const COMPONENT_FEEDBACKMESSAGE_LOGIN = 'feedbackmessage-login';
    public final const COMPONENT_FEEDBACKMESSAGE_LOSTPWD = 'feedbackmessage-lostpwd';
    public final const COMPONENT_FEEDBACKMESSAGE_LOSTPWDRESET = 'feedbackmessage-lostpwdreset';
    public final const COMPONENT_FEEDBACKMESSAGE_LOGOUT = 'feedbackmessage-logout';
    public final const COMPONENT_FEEDBACKMESSAGE_USER_CHANGEPASSWORD = 'feedbackmessage-user-changepassword';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_FEEDBACKMESSAGE_LOGIN,
            self::COMPONENT_FEEDBACKMESSAGE_LOSTPWD,
            self::COMPONENT_FEEDBACKMESSAGE_LOSTPWDRESET,
            self::COMPONENT_FEEDBACKMESSAGE_LOGOUT,
            self::COMPONENT_FEEDBACKMESSAGE_USER_CHANGEPASSWORD,
        );
    }

    public function getInnerSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        $inners = array(
            self::COMPONENT_FEEDBACKMESSAGE_LOGIN => [GD_UserLogin_Module_Processor_UserFeedbackMessageInners::class, GD_UserLogin_Module_Processor_UserFeedbackMessageInners::COMPONENT_FEEDBACKMESSAGEINNER_LOGIN],
            self::COMPONENT_FEEDBACKMESSAGE_LOSTPWD => [GD_UserLogin_Module_Processor_UserFeedbackMessageInners::class, GD_UserLogin_Module_Processor_UserFeedbackMessageInners::COMPONENT_FEEDBACKMESSAGEINNER_LOSTPWD],
            self::COMPONENT_FEEDBACKMESSAGE_LOSTPWDRESET => [GD_UserLogin_Module_Processor_UserFeedbackMessageInners::class, GD_UserLogin_Module_Processor_UserFeedbackMessageInners::COMPONENT_FEEDBACKMESSAGEINNER_LOSTPWDRESET],
            self::COMPONENT_FEEDBACKMESSAGE_LOGOUT => [GD_UserLogin_Module_Processor_UserFeedbackMessageInners::class, GD_UserLogin_Module_Processor_UserFeedbackMessageInners::COMPONENT_FEEDBACKMESSAGEINNER_LOGOUT],
            self::COMPONENT_FEEDBACKMESSAGE_USER_CHANGEPASSWORD => [GD_UserLogin_Module_Processor_UserFeedbackMessageInners::class, GD_UserLogin_Module_Processor_UserFeedbackMessageInners::COMPONENT_FEEDBACKMESSAGEINNER_USER_CHANGEPASSWORD],
        );

        if ($inner = $inners[$component->name] ?? null) {
            return $inner;
        }

        return parent::getInnerSubcomponent($component);
    }
}



