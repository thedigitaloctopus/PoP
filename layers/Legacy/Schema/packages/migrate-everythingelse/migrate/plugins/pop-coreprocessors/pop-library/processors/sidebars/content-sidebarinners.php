<?php

class PoP_Module_Processor_ContentSidebarInners extends PoP_Module_Processor_SidebarInnersBase
{
    public final const COMPONENT_SIDEBARINNER_CONTENT_HORIZONTAL = 'contentsidebarinner-horizontal';
    public final const COMPONENT_SIDEBARINNER_CONTENT_VERTICAL = 'contentsidebarinner-vertical';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_SIDEBARINNER_CONTENT_HORIZONTAL,
            self::COMPONENT_SIDEBARINNER_CONTENT_VERTICAL,
        );
    }

    public function getWrapperClass(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_SIDEBARINNER_CONTENT_HORIZONTAL:
                return 'row';
        }
    
        return parent::getWrapperClass($component);
    }

    public function getWidgetwrapperClass(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_SIDEBARINNER_CONTENT_HORIZONTAL:
                return 'col-xsm-4';
        }
    
        return parent::getWidgetwrapperClass($component);
    }
}



