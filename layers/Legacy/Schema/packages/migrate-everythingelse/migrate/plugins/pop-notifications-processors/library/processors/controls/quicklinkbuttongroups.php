<?php

class GD_AAL_Module_Processor_QuicklinkButtonGroups extends PoP_Module_Processor_ControlButtonGroupsBase
{
    public final const COMPONENT_AAL_QUICKLINKBUTTONGROUP_VIEWUSER = 'notifications-quicklinkbuttongroup-viewuser';
    public final const COMPONENT_AAL_QUICKLINKBUTTONGROUP_NOTIFICATION_MARKASREADUNREAD = 'notifications-quicklinkbuttongroup-notification-markasreadunread';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_AAL_QUICKLINKBUTTONGROUP_VIEWUSER,
            self::COMPONENT_AAL_QUICKLINKBUTTONGROUP_NOTIFICATION_MARKASREADUNREAD,
        );
    }

    /**
     * @return \PoP\ComponentModel\Component\Component[]
     */
    public function getSubcomponents(\PoP\ComponentModel\Component\Component $component): array
    {
        $ret = parent::getSubcomponents($component);
    
        switch ($component->name) {
            case self::COMPONENT_AAL_QUICKLINKBUTTONGROUP_VIEWUSER:
                $ret[] = [AAL_PoPProcessors_Module_Processor_Buttons::class, AAL_PoPProcessors_Module_Processor_Buttons::COMPONENT_AAL_BUTTON_USERVIEW];
                break;

            case self::COMPONENT_AAL_QUICKLINKBUTTONGROUP_NOTIFICATION_MARKASREADUNREAD:
                $ret[] = [AAL_PoPProcessors_Module_Processor_Buttons::class, AAL_PoPProcessors_Module_Processor_Buttons::COMPONENT_AAL_BUTTON_NOTIFICATION_MARKASREAD];
                $ret[] = [AAL_PoPProcessors_Module_Processor_Buttons::class, AAL_PoPProcessors_Module_Processor_Buttons::COMPONENT_AAL_BUTTON_NOTIFICATION_MARKASUNREAD];
                break;
        }
        
        return $ret;
    }
}


