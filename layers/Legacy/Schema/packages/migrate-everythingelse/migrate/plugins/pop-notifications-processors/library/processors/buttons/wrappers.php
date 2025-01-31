<?php

class GD_AAL_Module_Processor_ButtonWrappers extends PoP_Module_Processor_ConditionWrapperBase
{
    public final const COMPONENT_AAL_BUTTONWRAPPER_NOTIFICATION_MARKASREAD = 'notifications-buttonwrapper-notification-markasread';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_AAL_BUTTONWRAPPER_NOTIFICATION_MARKASREAD,
        );
    }

    // function getFailedLayouts(\PoP\ComponentModel\Component\Component $component) {

    //     $ret = parent::getFailedLayouts($component);

    //     switch ($component->name) {

    //         case self::COMPONENT_AAL_BUTTONWRAPPER_NOTIFICATION_MARKASREAD:

    //             $ret[] = [AAL_PoPProcessors_Module_Processor_Buttons::class, AAL_PoPProcessors_Module_Processor_Buttons::COMPONENT_AAL_BUTTON_NOTIFICATION_MARKASREAD];
    //             break;
    //     }

    //     return $ret;
    // }

    public function getConditionSucceededSubcomponents(\PoP\ComponentModel\Component\Component $component)
    {
        $ret = parent::getConditionSucceededSubcomponents($component);

        switch ($component->name) {
            case self::COMPONENT_AAL_BUTTONWRAPPER_NOTIFICATION_MARKASREAD:
                $ret[] = [AAL_PoPProcessors_Module_Processor_Buttons::class, AAL_PoPProcessors_Module_Processor_Buttons::COMPONENT_AAL_BUTTON_NOTIFICATION_MARKASREAD];
                // $ret[] = [AAL_PoPProcessors_Module_Processor_Buttons::class, AAL_PoPProcessors_Module_Processor_Buttons::COMPONENT_AAL_BUTTON_NOTIFICATION_MARKASUNREAD];
                break;
        }

        return $ret;
    }

    public function getConditionField(\PoP\ComponentModel\Component\Component $component): ?string
    {
        switch ($component->name) {
            case self::COMPONENT_AAL_BUTTONWRAPPER_NOTIFICATION_MARKASREAD:
                return 'isStatusNotRead';
        }

        return null;
    }
}



