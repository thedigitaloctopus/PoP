<?php

class PoP_ContentCreation_Module_Processor_FeedbackMessages extends PoP_Module_Processor_FeedbackMessagesBase
{
    public final const COMPONENT_FEEDBACKMESSAGE_FLAG = 'feedbackmessage-flag';
    public final const COMPONENT_FEEDBACKMESSAGE_CREATECONTENT = 'feedbackmessage-createcontent';
    public final const COMPONENT_FEEDBACKMESSAGE_UPDATECONTENT = 'feedbackmessage-updatecontent';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_FEEDBACKMESSAGE_FLAG,
            self::COMPONENT_FEEDBACKMESSAGE_CREATECONTENT,
            self::COMPONENT_FEEDBACKMESSAGE_UPDATECONTENT,
        );
    }

    public function getInnerSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        $inners = array(
            self::COMPONENT_FEEDBACKMESSAGE_FLAG => [PoP_ContentCreation_Module_Processor_FeedbackMessageInners::class, PoP_ContentCreation_Module_Processor_FeedbackMessageInners::COMPONENT_FEEDBACKMESSAGEINNER_FLAG],
            self::COMPONENT_FEEDBACKMESSAGE_CREATECONTENT => [PoP_ContentCreation_Module_Processor_FeedbackMessageInners::class, PoP_ContentCreation_Module_Processor_FeedbackMessageInners::COMPONENT_FEEDBACKMESSAGEINNER_CREATECONTENT],
            self::COMPONENT_FEEDBACKMESSAGE_UPDATECONTENT => [PoP_ContentCreation_Module_Processor_FeedbackMessageInners::class, PoP_ContentCreation_Module_Processor_FeedbackMessageInners::COMPONENT_FEEDBACKMESSAGEINNER_UPDATECONTENT],
        );

        if ($inner = $inners[$component->name] ?? null) {
            return $inner;
        }

        return parent::getInnerSubcomponent($component);
    }
}



