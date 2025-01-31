<?php
use PoP\Root\Facades\Translation\TranslationAPIFacade;

class GD_URE_Custom_Module_Processor_WidgetMessages extends PoP_Module_Processor_WidgetMessagesBase
{
    public final const COMPONENT_URE_MESSAGE_NODETAILS = 'ure-message-nodetails';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_URE_MESSAGE_NODETAILS,
        );
    }

    public function getMessage(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_URE_MESSAGE_NODETAILS:
                return TranslationAPIFacade::getInstance()->__('No details', 'poptheme-wassup');
        }

        return parent::getMessage($component);
    }
}



