<?php
use PoP\Root\Facades\Translation\TranslationAPIFacade;

class PoP_Share_Module_Processor_TextFormInputs extends PoP_Module_Processor_TextFormInputsBase
{
    public final const COMPONENT_FORMINPUT_DESTINATIONEMAIL = 'gf-field-destinationemail';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_FORMINPUT_DESTINATIONEMAIL,
        );
    }

    public function getLabelText(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_FORMINPUT_DESTINATIONEMAIL:
                return TranslationAPIFacade::getInstance()->__('To Email(s)', 'pop-genericforms');
        }
        
        return parent::getLabelText($component, $props);
    }

    public function isMandatory(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_FORMINPUT_DESTINATIONEMAIL:
                return true;
        }
        
        return parent::isMandatory($component, $props);
    }
}



