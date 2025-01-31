<?php
use PoP\Engine\Constants\FormInputConstants;
use PoP\Engine\FormInputs\BooleanFormInputTrait;
use PoP\Root\Facades\Translation\TranslationAPIFacade;

trait GD_FormInput_YesNoTrait
{
    use BooleanFormInputTrait;

    /**
     * @return mixed[]
     */
    public function getAllValues(string $label = null): array
    {
        $values = parent::getAllValues($label);

        // Instead of using true/false values, use empty/non-empty string, because the booleans cannot be keys of an array (it converts them to positions/numbers and screws up everything)
        $values = array_merge(
            $values,
            array(
                FormInputConstants::BOOLSTRING_TRUE => TranslationAPIFacade::getInstance()->__('Yes', 'pop-coreprocessors'),
                FormInputConstants::BOOLSTRING_FALSE => TranslationAPIFacade::getInstance()->__('No', 'pop-coreprocessors'),
            )
        );

        return $values;
    }
}
