<?php

class PoP_Module_Processor_DropdownMenuLayouts extends PoP_Module_Processor_DropdownMenuLayoutsBase
{
    public final const COMPONENT_LAYOUT_MENU_DROPDOWN = 'layout-menu-dropdown';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_LAYOUT_MENU_DROPDOWN,
        );
    }
}



