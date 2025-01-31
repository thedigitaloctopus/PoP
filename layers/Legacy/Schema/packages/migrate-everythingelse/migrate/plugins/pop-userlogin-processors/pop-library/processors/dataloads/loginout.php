<?php
use PoP\Root\Facades\Translation\TranslationAPIFacade;
use PoPSitesWassup\UserStateMutations\MutationResolverBridges\LoginMutationResolverBridge;
use PoPSitesWassup\UserStateMutations\MutationResolverBridges\LogoutMutationResolverBridge;
use PoPSitesWassup\UserStateMutations\MutationResolverBridges\LostPasswordMutationResolverBridge;
use PoPSitesWassup\UserStateMutations\MutationResolverBridges\ResetLostPasswordMutationResolverBridge;

class PoP_UserLogin_Module_Processor_Dataloads extends PoP_Module_Processor_DataloadsBase
{
    public final const COMPONENT_DATALOAD_LOGIN = 'dataload-login';
    public final const COMPONENT_DATALOAD_LOSTPWD = 'dataload-lostpwd';
    public final const COMPONENT_DATALOAD_LOSTPWDRESET = 'dataload-lostpwdreset';
    public final const COMPONENT_DATALOAD_LOGOUT = 'dataload-logout';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_DATALOAD_LOGIN,
            self::COMPONENT_DATALOAD_LOSTPWD,
            self::COMPONENT_DATALOAD_LOSTPWDRESET,
            self::COMPONENT_DATALOAD_LOGOUT,
        );
    }

    public function getRelevantRoute(\PoP\ComponentModel\Component\Component $component, array &$props): ?string
    {
        return match($component->name) {
            self::COMPONENT_DATALOAD_LOGOUT => POP_USERLOGIN_ROUTE_LOGOUT,
            self::COMPONENT_DATALOAD_LOSTPWD => POP_USERLOGIN_ROUTE_LOSTPWD,
            self::COMPONENT_DATALOAD_LOSTPWDRESET => POP_USERLOGIN_ROUTE_LOSTPWDRESET,
            self::COMPONENT_DATALOAD_LOGIN => POP_USERLOGIN_ROUTE_LOGIN,
            default => parent::getRelevantRoute($component, $props),
        };
    }

    public function getRelevantRouteCheckpointTarget(\PoP\ComponentModel\Component\Component $component, array &$props): string
    {
        switch ($component->name) {
            case self::COMPONENT_DATALOAD_LOGOUT:
            case self::COMPONENT_DATALOAD_LOSTPWD:
            case self::COMPONENT_DATALOAD_LOSTPWDRESET:
            case self::COMPONENT_DATALOAD_LOGIN:
                return \PoP\ComponentModel\Constants\DataLoading::ACTION_EXECUTION_CHECKPOINTS;
        }

        return parent::getRelevantRouteCheckpointTarget($component, $props);
    }

    protected function getInnerSubcomponents(\PoP\ComponentModel\Component\Component $component): array
    {
        $ret = parent::getInnerSubcomponents($component);

        $inner_components = array(
            self::COMPONENT_DATALOAD_LOGIN => [GD_UserLogin_Module_Processor_UserForms::class, GD_UserLogin_Module_Processor_UserForms::COMPONENT_FORM_LOGIN],
            self::COMPONENT_DATALOAD_LOSTPWD => [GD_UserLogin_Module_Processor_UserForms::class, GD_UserLogin_Module_Processor_UserForms::COMPONENT_FORM_LOSTPWD],
            self::COMPONENT_DATALOAD_LOSTPWDRESET => [GD_UserLogin_Module_Processor_UserForms::class, GD_UserLogin_Module_Processor_UserForms::COMPONENT_FORM_LOSTPWDRESET],
            self::COMPONENT_DATALOAD_LOGOUT => [GD_UserLogin_Module_Processor_UserForms::class, GD_UserLogin_Module_Processor_UserForms::COMPONENT_FORM_LOGOUT],
        );

        if ($inner = $inner_components[$component->name] ?? null) {
            $ret[] = $inner;
        }

        return $ret;
    }

    public function getComponentMutationResolverBridge(\PoP\ComponentModel\Component\Component $component): ?\PoP\ComponentModel\MutationResolverBridges\ComponentMutationResolverBridgeInterface
    {
        switch ($component->name) {
            case self::COMPONENT_DATALOAD_LOGIN:
                return $this->instanceManager->getInstance(LoginMutationResolverBridge::class);

            case self::COMPONENT_DATALOAD_LOSTPWD:
                return $this->instanceManager->getInstance(LostPasswordMutationResolverBridge::class);

            case self::COMPONENT_DATALOAD_LOSTPWDRESET:
                return $this->instanceManager->getInstance(ResetLostPasswordMutationResolverBridge::class);

            case self::COMPONENT_DATALOAD_LOGOUT:
                return $this->instanceManager->getInstance(LogoutMutationResolverBridge::class);
        }

        return parent::getComponentMutationResolverBridge($component);
    }

    protected function getFeedbackMessageComponent(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_DATALOAD_LOGIN:
                return [GD_UserLogin_Module_Processor_UserFeedbackMessages::class, GD_UserLogin_Module_Processor_UserFeedbackMessages::COMPONENT_FEEDBACKMESSAGE_LOGIN];

            case self::COMPONENT_DATALOAD_LOSTPWD:
                return [GD_UserLogin_Module_Processor_UserFeedbackMessages::class, GD_UserLogin_Module_Processor_UserFeedbackMessages::COMPONENT_FEEDBACKMESSAGE_LOSTPWD];

            case self::COMPONENT_DATALOAD_LOSTPWDRESET:
                return [GD_UserLogin_Module_Processor_UserFeedbackMessages::class, GD_UserLogin_Module_Processor_UserFeedbackMessages::COMPONENT_FEEDBACKMESSAGE_LOSTPWDRESET];

            case self::COMPONENT_DATALOAD_LOGOUT:
                return [GD_UserLogin_Module_Processor_UserFeedbackMessages::class, GD_UserLogin_Module_Processor_UserFeedbackMessages::COMPONENT_FEEDBACKMESSAGE_LOGOUT];
        }

        return parent::getFeedbackMessageComponent($component);
    }

    protected function getCheckpointMessageComponent(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_DATALOAD_LOSTPWD:
            case self::COMPONENT_DATALOAD_LOSTPWDRESET:
                return [GD_UserLogin_Module_Processor_UserCheckpointMessages::class, GD_UserLogin_Module_Processor_UserCheckpointMessages::COMPONENT_CHECKPOINTMESSAGE_NOTLOGGEDIN];
        }

        return parent::getCheckpointMessageComponent($component);
    }

    public function initModelProps(\PoP\ComponentModel\Component\Component $component, array &$props): void
    {
        switch ($component->name) {
            case self::COMPONENT_DATALOAD_LOGIN:
            case self::COMPONENT_DATALOAD_LOSTPWD:
            case self::COMPONENT_DATALOAD_LOSTPWDRESET:
            case self::COMPONENT_DATALOAD_LOGOUT:
                // Change the 'Loading' message in the Status
                $this->setProp([[PoP_Module_Processor_Status::class, PoP_Module_Processor_Status::COMPONENT_STATUS]], $props, 'loading-msg', TranslationAPIFacade::getInstance()->__('Sending...', 'pop-coreprocessors'));
                break;
        }

        parent::initModelProps($component, $props);
    }
}



