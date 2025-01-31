<?php

class PoPTheme_Wassup_EM_AE_Module_Processor_FullViewLayouts extends PoP_Module_Processor_CustomFullViewLayoutsBase
{
    public final const COMPONENT_LAYOUT_AUTOMATEDEMAILS_FULLVIEW_EVENT = 'layout-automatedemails-fullview-event';
    
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_LAYOUT_AUTOMATEDEMAILS_FULLVIEW_EVENT,
        );
    }

    public function getSidebarSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_LAYOUT_AUTOMATEDEMAILS_FULLVIEW_EVENT:
                $sidebars = array(
                    self::COMPONENT_LAYOUT_AUTOMATEDEMAILS_FULLVIEW_EVENT => [PoPTheme_Wassup_EM_AE_Module_Processor_CustomPostLayoutSidebars::class, PoPTheme_Wassup_EM_AE_Module_Processor_CustomPostLayoutSidebars::COMPONENT_LAYOUT_AUTOMATEDEMAILS_POSTSIDEBARCOMPACT_HORIZONTAL_EVENT],
                );

                return $sidebars[$component->name];
        }

        return parent::getSidebarSubcomponent($component);
    }
}



