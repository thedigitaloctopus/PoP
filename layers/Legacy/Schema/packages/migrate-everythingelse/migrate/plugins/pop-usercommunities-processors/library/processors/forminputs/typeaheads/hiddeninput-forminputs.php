<?php

class GD_URE_Processor_SelectableHiddenInputFormInputs extends PoP_Module_Processor_HiddenInputFormInputsBase
{
    public final const COMPONENT_FORMINPUT_HIDDENINPUT_SELECTABLELAYOUTUSERCOMMUNITIES = 'forminput-hiddeninput-selectablelayoutusercommunities';
    public final const COMPONENT_FILTERINPUT_HIDDENINPUT_SELECTABLELAYOUTCOMMUNITIES = 'filterinput-hiddeninput-selectablelayoutcommunities';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_FORMINPUT_HIDDENINPUT_SELECTABLELAYOUTUSERCOMMUNITIES,
            self::COMPONENT_FILTERINPUT_HIDDENINPUT_SELECTABLELAYOUTCOMMUNITIES,
        );
    }

    public function isMultiple(\PoP\ComponentModel\Component\Component $component): bool
    {
        switch ($component->name) {
            case self::COMPONENT_FORMINPUT_HIDDENINPUT_SELECTABLELAYOUTUSERCOMMUNITIES:
            case self::COMPONENT_FILTERINPUT_HIDDENINPUT_SELECTABLELAYOUTCOMMUNITIES:
                return true;
        }

        return parent::isMultiple($component);
    }

    public function getName(\PoP\ComponentModel\Component\Component $component): string
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_HIDDENINPUT_SELECTABLELAYOUTCOMMUNITIES:
                $names = array(
                    self::COMPONENT_FILTERINPUT_HIDDENINPUT_SELECTABLELAYOUTCOMMUNITIES => 'communities',
                );
                return $names[$component->name];
        }
        
        return parent::getName($component);
    }
}

