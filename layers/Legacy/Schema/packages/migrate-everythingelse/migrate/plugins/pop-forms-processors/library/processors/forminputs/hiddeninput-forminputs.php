<?php

class PoP_Module_Processor_HiddenInputFormInputs extends PoP_Module_Processor_HiddenInputFormInputsBase
{
    public final const COMPONENT_FORMINPUT_HIDDENINPUT_LAYOUTPOST = 'forminput-hiddeninput-post';
    public final const COMPONENT_FORMINPUT_HIDDENINPUT_LAYOUTCOMMENTPOST = 'forminput-hiddeninput-commentpost';
    public final const COMPONENT_FORMINPUT_HIDDENINPUT_LAYOUTUSER = 'forminput-hiddeninput-user';
    public final const COMPONENT_FORMINPUT_HIDDENINPUT_LAYOUTCOMMENT = 'forminput-hiddeninput-comment';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_FORMINPUT_HIDDENINPUT_LAYOUTPOST,
            self::COMPONENT_FORMINPUT_HIDDENINPUT_LAYOUTCOMMENTPOST,
            self::COMPONENT_FORMINPUT_HIDDENINPUT_LAYOUTUSER,
            self::COMPONENT_FORMINPUT_HIDDENINPUT_LAYOUTCOMMENT,
        );
    }

    public function getName(\PoP\ComponentModel\Component\Component $component): string
    {
        switch ($component->name) {
            case self::COMPONENT_FORMINPUT_HIDDENINPUT_LAYOUTPOST:
            case self::COMPONENT_FORMINPUT_HIDDENINPUT_LAYOUTCOMMENTPOST:
                return \PoPCMSSchema\Posts\Constants\InputNames::POST_ID;

            case self::COMPONENT_FORMINPUT_HIDDENINPUT_LAYOUTUSER:
                return \PoPCMSSchema\Users\Constants\InputNames::USER_ID;

            case self::COMPONENT_FORMINPUT_HIDDENINPUT_LAYOUTCOMMENT:
                return \PoPCMSSchema\Comments\Constants\InputNames::COMMENT_ID;
        }

        return parent::getName($component);
    }
}



