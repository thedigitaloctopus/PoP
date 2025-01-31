<?php
use PoP\Root\Facades\Translation\TranslationAPIFacade;

class PoP_SocialNetwork_Module_Processor_ViewComponentButtonInners extends PoP_Module_Processor_ButtonInnersBase
{
    public final const COMPONENT_VIEWCOMPONENT_BUTTONINNER_SENDMESSAGE_PREVIEW = 'viewcomponent-buttoninner-sendmessage-preview';
    public final const COMPONENT_VIEWCOMPONENT_BUTTONINNER_SENDMESSAGE_FULL = 'viewcomponent-buttoninner-sidebar-sendmessage-full';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_VIEWCOMPONENT_BUTTONINNER_SENDMESSAGE_PREVIEW,
            self::COMPONENT_VIEWCOMPONENT_BUTTONINNER_SENDMESSAGE_FULL,
        );
    }
    
    public function getFontawesome(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_VIEWCOMPONENT_BUTTONINNER_SENDMESSAGE_PREVIEW:
            case self::COMPONENT_VIEWCOMPONENT_BUTTONINNER_SENDMESSAGE_FULL:
                return 'fa-fw fa-envelope-o';
        }
        
        return parent::getFontawesome($component, $props);
    }

    public function getBtnTitle(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_VIEWCOMPONENT_BUTTONINNER_SENDMESSAGE_PREVIEW:
            case self::COMPONENT_VIEWCOMPONENT_BUTTONINNER_SENDMESSAGE_FULL:
                return TranslationAPIFacade::getInstance()->__('Send message', 'pop-coreprocessors');
        }
        
        return parent::getBtnTitle($component);
    }
}


