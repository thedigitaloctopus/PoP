<?php

class PoP_LocationPostsCreation_Module_Processor_SectionTabPanelComponents extends PoP_Module_Processor_SectionTabPanelComponentsBase
{
    public final const COMPONENT_TABPANEL_MYLOCATIONPOSTS = 'tabpanel-mylocationposts';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_TABPANEL_MYLOCATIONPOSTS,
        );
    }

    protected function getDefaultActivepanelFormat(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_TABPANEL_MYLOCATIONPOSTS:
                return PoP_Application_Utils::getDefaultformatByScreen(POP_SCREEN_MYCONTENT);
        }

        return parent::getDefaultActivepanelFormat($component);
    }

    public function getPanelSubcomponents(\PoP\ComponentModel\Component\Component $component)
    {
        $ret = parent::getPanelSubcomponents($component);

        switch ($component->name) {
            case self::COMPONENT_TABPANEL_MYLOCATIONPOSTS:
                $ret = array_merge(
                    $ret,
                    array(
                        [GD_Custom_EM_Module_Processor_MySectionDataloads::class, GD_Custom_EM_Module_Processor_MySectionDataloads::COMPONENT_DATALOAD_MYLOCATIONPOSTS_TABLE_EDIT],
                        [GD_Custom_EM_Module_Processor_MySectionDataloads::class, GD_Custom_EM_Module_Processor_MySectionDataloads::COMPONENT_DATALOAD_MYLOCATIONPOSTS_SCROLL_SIMPLEVIEWPREVIEW],
                        [GD_Custom_EM_Module_Processor_MySectionDataloads::class, GD_Custom_EM_Module_Processor_MySectionDataloads::COMPONENT_DATALOAD_MYLOCATIONPOSTS_SCROLL_FULLVIEWPREVIEW],
                    )
                );
                break;
        }

        return $ret;
    }
}


