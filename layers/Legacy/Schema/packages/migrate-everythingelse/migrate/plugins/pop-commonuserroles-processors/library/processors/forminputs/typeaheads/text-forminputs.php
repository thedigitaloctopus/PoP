<?php
use PoP\Root\Facades\Translation\TranslationAPIFacade;

class GD_URE_Module_Processor_TypeaheadTextFormInputs extends PoP_Module_Processor_TextFormInputsBase
{
    public final const COMPONENT_FORMINPUT_TEXT_TYPEAHEADORGANIZATIONS = 'forminput-text-typeaheadorganizations';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_FORMINPUT_TEXT_TYPEAHEADORGANIZATIONS,
        );
    }

    public function getLabelText(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_FORMINPUT_TEXT_TYPEAHEADORGANIZATIONS:
                return TranslationAPIFacade::getInstance()->__('Organization', 'ure-popprocessors');
        }
        
        return parent::getLabelText($component, $props);
    }
}



