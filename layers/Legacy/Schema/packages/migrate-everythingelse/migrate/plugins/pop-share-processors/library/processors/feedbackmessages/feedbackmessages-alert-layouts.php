<?php

class PoP_Share_Module_Processor_FeedbackMessageAlertLayouts extends PoP_Module_Processor_FeedbackMessageAlertLayoutsBase
{
    public final const COMPONENT_LAYOUT_FEEDBACKMESSAGEALERT_SHAREBYEMAIL = 'layout-feedbackmessagealert-sharebyemail';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_LAYOUT_FEEDBACKMESSAGEALERT_SHAREBYEMAIL,
        );
    }

    public function getLayoutSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        $layouts = array(
            self::COMPONENT_LAYOUT_FEEDBACKMESSAGEALERT_SHAREBYEMAIL => [PoP_Share_Module_Processor_FeedbackMessageLayouts::class, PoP_Share_Module_Processor_FeedbackMessageLayouts::COMPONENT_LAYOUT_FEEDBACKMESSAGE_SHAREBYEMAIL],
        );

        if ($layout = $layouts[$component->name] ?? null) {
            return $layout;
        }

        return parent::getLayoutSubcomponent($component);
    }
}



