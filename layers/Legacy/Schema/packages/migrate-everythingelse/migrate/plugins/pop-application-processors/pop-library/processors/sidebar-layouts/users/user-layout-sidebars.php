<?php

class PoP_Module_Processor_CustomUserLayoutSidebars extends PoP_Module_Processor_SidebarsBase
{
    public final const COMPONENT_LAYOUT_USERSIDEBAR_VERTICAL = 'layout-usersidebar-vertical';
    public final const COMPONENT_LAYOUT_USERSIDEBAR_HORIZONTAL = 'layout-usersidebar-horizontal';
    public final const COMPONENT_LAYOUT_USERSIDEBAR_COMPACTHORIZONTAL = 'layout-usersidebar-compacthorizontal';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_LAYOUT_USERSIDEBAR_VERTICAL,
            self::COMPONENT_LAYOUT_USERSIDEBAR_HORIZONTAL,
            self::COMPONENT_LAYOUT_USERSIDEBAR_COMPACTHORIZONTAL,
        );
    }

    public function getInnerSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        $sidebarinners = array(
            self::COMPONENT_LAYOUT_USERSIDEBAR_VERTICAL => [PoP_Module_Processor_CustomUserLayoutSidebarInners::class, PoP_Module_Processor_CustomUserLayoutSidebarInners::COMPONENT_LAYOUT_USERSIDEBARINNER_VERTICAL],
            self::COMPONENT_LAYOUT_USERSIDEBAR_HORIZONTAL => [PoP_Module_Processor_CustomUserLayoutSidebarInners::class, PoP_Module_Processor_CustomUserLayoutSidebarInners::COMPONENT_LAYOUT_USERSIDEBARINNER_HORIZONTAL],
            self::COMPONENT_LAYOUT_USERSIDEBAR_COMPACTHORIZONTAL => [PoP_Module_Processor_CustomUserLayoutSidebarInners::class, PoP_Module_Processor_CustomUserLayoutSidebarInners::COMPONENT_LAYOUT_USERSIDEBARINNER_COMPACTHORIZONTAL],
        );

        if ($inner = $sidebarinners[$component->name] ?? null) {
            return $inner;
        }

        return parent::getInnerSubcomponent($component);
    }

    public function initModelProps(\PoP\ComponentModel\Component\Component $component, array &$props): void
    {
        switch ($component->name) {
            case self::COMPONENT_LAYOUT_USERSIDEBAR_VERTICAL:
                $this->appendProp($component, $props, 'class', 'vertical');
                break;

            case self::COMPONENT_LAYOUT_USERSIDEBAR_HORIZONTAL:
            case self::COMPONENT_LAYOUT_USERSIDEBAR_COMPACTHORIZONTAL:
                $this->appendProp($component, $props, 'class', 'horizontal');
                break;
        }

        parent::initModelProps($component, $props);
    }
}



