<?php
use PoP\Root\Facades\Translation\TranslationAPIFacade;

class PoP_Module_Processor_CreateUpdatePostMultiSelectFormInputs extends PoP_Module_Processor_MultiSelectFormInputsBase
{
    public final const COMPONENT_FORMINPUT_APPLIESTO = 'forminput-appliesto';
    public final const COMPONENT_FORMINPUT_CATEGORIES = 'forminput-categories';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_FORMINPUT_APPLIESTO,
            self::COMPONENT_FORMINPUT_CATEGORIES,
        );
    }

    public function getLabelText(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_FORMINPUT_CATEGORIES:
                return TranslationAPIFacade::getInstance()->__('Categories', 'poptheme-wassup');

            case self::COMPONENT_FORMINPUT_APPLIESTO:
                return TranslationAPIFacade::getInstance()->__('Applies to', 'poptheme-wassup');
        }
        
        return parent::getLabelText($component, $props);
    }

    public function getInputClass(\PoP\ComponentModel\Component\Component $component): string
    {
        switch ($component->name) {
            case self::COMPONENT_FORMINPUT_CATEGORIES:
                return GD_FormInput_Categories::class;

            case self::COMPONENT_FORMINPUT_APPLIESTO:
                return GD_FormInput_AppliesTo::class;
        }
        
        return parent::getInputClass($component);
    }

    public function getDbobjectField(\PoP\ComponentModel\Component\Component $component): ?string
    {
        switch ($component->name) {
            case self::COMPONENT_FORMINPUT_CATEGORIES:
                return 'topics';

            case self::COMPONENT_FORMINPUT_APPLIESTO:
                return 'appliesto';
        }
        
        return parent::getDbobjectField($component);
    }
}



