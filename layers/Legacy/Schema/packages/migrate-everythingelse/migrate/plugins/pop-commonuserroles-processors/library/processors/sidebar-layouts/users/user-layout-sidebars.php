<?php

class GD_URE_Module_Processor_CustomUserLayoutSidebars extends PoP_Module_Processor_SidebarsBase
{
    public final const COMPONENT_LAYOUT_USERSIDEBAR_VERTICAL_ORGANIZATION = 'layout-usersidebar-vertical-organization';
    public final const COMPONENT_LAYOUT_USERSIDEBAR_VERTICAL_INDIVIDUAL = 'layout-usersidebar-vertical-individual';
    public final const COMPONENT_LAYOUT_USERSIDEBAR_HORIZONTAL_ORGANIZATION = 'layout-usersidebar-horizontal-organization';
    public final const COMPONENT_LAYOUT_USERSIDEBAR_HORIZONTAL_INDIVIDUAL = 'layout-usersidebar-horizontal-individual';
    public final const COMPONENT_LAYOUT_USERSIDEBAR_COMPACTHORIZONTAL_ORGANIZATION = 'layout-usersidebar-compacthorizontal-organization';
    public final const COMPONENT_LAYOUT_USERSIDEBAR_COMPACTHORIZONTAL_INDIVIDUAL = 'layout-usersidebar-compacthorizontal-individual';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_LAYOUT_USERSIDEBAR_VERTICAL_ORGANIZATION,
            self::COMPONENT_LAYOUT_USERSIDEBAR_VERTICAL_INDIVIDUAL,
            self::COMPONENT_LAYOUT_USERSIDEBAR_HORIZONTAL_ORGANIZATION,
            self::COMPONENT_LAYOUT_USERSIDEBAR_HORIZONTAL_INDIVIDUAL,
            self::COMPONENT_LAYOUT_USERSIDEBAR_COMPACTHORIZONTAL_ORGANIZATION,
            self::COMPONENT_LAYOUT_USERSIDEBAR_COMPACTHORIZONTAL_INDIVIDUAL,
        );
    }

    public function getInnerSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        $sidebarinners = array(
            self::COMPONENT_LAYOUT_USERSIDEBAR_VERTICAL_ORGANIZATION => [GD_URE_Module_Processor_CustomUserLayoutSidebarInners::class, GD_URE_Module_Processor_CustomUserLayoutSidebarInners::COMPONENT_LAYOUT_USERSIDEBARINNER_VERTICAL_ORGANIZATION],
            self::COMPONENT_LAYOUT_USERSIDEBAR_VERTICAL_INDIVIDUAL => [GD_URE_Module_Processor_CustomUserLayoutSidebarInners::class, GD_URE_Module_Processor_CustomUserLayoutSidebarInners::COMPONENT_LAYOUT_USERSIDEBARINNER_VERTICAL_INDIVIDUAL],
            self::COMPONENT_LAYOUT_USERSIDEBAR_HORIZONTAL_ORGANIZATION => [GD_URE_Module_Processor_CustomUserLayoutSidebarInners::class, GD_URE_Module_Processor_CustomUserLayoutSidebarInners::COMPONENT_LAYOUT_USERSIDEBARINNER_HORIZONTAL_ORGANIZATION],
            self::COMPONENT_LAYOUT_USERSIDEBAR_HORIZONTAL_INDIVIDUAL => [GD_URE_Module_Processor_CustomUserLayoutSidebarInners::class, GD_URE_Module_Processor_CustomUserLayoutSidebarInners::COMPONENT_LAYOUT_USERSIDEBARINNER_HORIZONTAL_INDIVIDUAL],
            self::COMPONENT_LAYOUT_USERSIDEBAR_COMPACTHORIZONTAL_ORGANIZATION => [GD_URE_Module_Processor_CustomUserLayoutSidebarInners::class, GD_URE_Module_Processor_CustomUserLayoutSidebarInners::COMPONENT_LAYOUT_USERSIDEBARINNER_COMPACTHORIZONTAL_ORGANIZATION],
            self::COMPONENT_LAYOUT_USERSIDEBAR_COMPACTHORIZONTAL_INDIVIDUAL => [GD_URE_Module_Processor_CustomUserLayoutSidebarInners::class, GD_URE_Module_Processor_CustomUserLayoutSidebarInners::COMPONENT_LAYOUT_USERSIDEBARINNER_COMPACTHORIZONTAL_INDIVIDUAL],
        );

        if ($inner = $sidebarinners[$component->name] ?? null) {
            return $inner;
        }

        return parent::getInnerSubcomponent($component);
    }

    public function initModelProps(\PoP\ComponentModel\Component\Component $component, array &$props): void
    {
        switch ($component->name) {
            case self::COMPONENT_LAYOUT_USERSIDEBAR_VERTICAL_ORGANIZATION:
            case self::COMPONENT_LAYOUT_USERSIDEBAR_VERTICAL_INDIVIDUAL:
                $this->appendProp($component, $props, 'class', 'vertical');
                break;

            case self::COMPONENT_LAYOUT_USERSIDEBAR_HORIZONTAL_ORGANIZATION:
            case self::COMPONENT_LAYOUT_USERSIDEBAR_HORIZONTAL_INDIVIDUAL:
            case self::COMPONENT_LAYOUT_USERSIDEBAR_COMPACTHORIZONTAL_ORGANIZATION:
            case self::COMPONENT_LAYOUT_USERSIDEBAR_COMPACTHORIZONTAL_INDIVIDUAL:
                $this->appendProp($component, $props, 'class', 'horizontal');
                break;
        }

        parent::initModelProps($component, $props);
    }
}



