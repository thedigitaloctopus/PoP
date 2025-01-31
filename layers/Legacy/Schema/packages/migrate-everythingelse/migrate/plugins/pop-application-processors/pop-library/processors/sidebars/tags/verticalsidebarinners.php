<?php

class Wassup_Module_Processor_CustomVerticalTagSidebarInners extends PoP_Module_Processor_SidebarInnersBase
{
    public final const COMPONENT_VERTICALSIDEBARINNER_TAG = 'vertical-sidebarinner-tag';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_VERTICALSIDEBARINNER_TAG,
        );
    }

    /**
     * @return \PoP\ComponentModel\Component\Component[]
     */
    public function getLayoutSubcomponents(\PoP\ComponentModel\Component\Component $component): array
    {
        $ret = parent::getLayoutSubcomponents($component);

        switch ($component->name) {
            case self::COMPONENT_VERTICALSIDEBARINNER_TAG:
                $ret = array_merge(
                    $ret,
                    FullTagSidebarSettings::getSidebarSubcomponents(GD_SIDEBARSECTION_TAG)
                );
                break;
        }

        return $ret;
    }
}



