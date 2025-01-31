<?php

class PoP_Module_Processor_CommentsFeedbackMessages extends PoP_Module_Processor_FeedbackMessagesBase
{
    public final const COMPONENT_FEEDBACKMESSAGE_COMMENTS = 'feedbackmessage-comments';
    public final const COMPONENT_FEEDBACKMESSAGE_ADDCOMMENT = 'feedbackmessage-addcomment';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_FEEDBACKMESSAGE_COMMENTS,
            self::COMPONENT_FEEDBACKMESSAGE_ADDCOMMENT,
        );
    }

    public function getInnerSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        $inners = array(
            self::COMPONENT_FEEDBACKMESSAGE_COMMENTS => [PoP_Module_Processor_ListCommentsFeedbackMessageInners::class, PoP_Module_Processor_ListCommentsFeedbackMessageInners::COMPONENT_FEEDBACKMESSAGEINNER_COMMENTS],
            self::COMPONENT_FEEDBACKMESSAGE_ADDCOMMENT => [PoP_Module_Processor_CommentsFeedbackMessageInners::class, PoP_Module_Processor_CommentsFeedbackMessageInners::COMPONENT_FEEDBACKMESSAGEINNER_ADDCOMMENT],
        );

        if ($inner = $inners[$component->name] ?? null) {
            return $inner;
        }

        return parent::getInnerSubcomponent($component);
    }
}



