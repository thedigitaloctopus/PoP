<?php
use PoP\Root\Facades\Instances\InstanceManagerFacade;

class PoP_UserAvatarProcessors_UserPlatform_ActionExecuter_Hooks
{
    public function __construct()
    {
        \PoP\Root\App::addAction(
            'gd_createupdate_user:additionalsCreate',
            $this->additionalsCreate(...),
            10
        );
    }

    public function additionalsCreate($user_id)
    {
        // Save the user avatar
        $instanceManager = InstanceManagerFacade::getInstance();
        /** @var GD_UserAvatar_Update */
        $gd_useravatar_update = $instanceManager->getInstance(GD_UserAvatar_Update::class);
        $gd_useravatar_update->savePicture($user_id, true);
    }
}

/**
 * Initialization
 */
new PoP_UserAvatarProcessors_UserPlatform_ActionExecuter_Hooks();
