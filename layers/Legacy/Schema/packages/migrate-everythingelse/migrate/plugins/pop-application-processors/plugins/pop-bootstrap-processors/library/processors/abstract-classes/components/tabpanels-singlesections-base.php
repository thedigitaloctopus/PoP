<?php

abstract class PoP_Module_Processor_SingleSectionTabPanelComponentsBase extends PoP_Module_Processor_GenericSectionTabPanelComponentsBase
{
    protected function getDefaultActivepanelFormat(\PoP\ComponentModel\Component\Component $component)
    {
        return PoP_Application_Utils::getDefaultformatByScreen(POP_SCREEN_SINGLESECTION);
    }
}
