<?php

use PoP\Engine\FormInputs\BooleanFormInput;

trait PoP_Module_Processor_BooleanFormInputsTrait
{
    public function getValueFormat(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        // If the checkbox is of the on/off type, it will most likely receive a boolean (true/false) which needs to be converted to string to operate in the webplatform
        return POP_VALUEFORMAT_BOOLTOSTRING;
    }

    public function getInputClass(\PoP\ComponentModel\Component\Component $component): string
    {
        return BooleanFormInput::class;
    }
}
