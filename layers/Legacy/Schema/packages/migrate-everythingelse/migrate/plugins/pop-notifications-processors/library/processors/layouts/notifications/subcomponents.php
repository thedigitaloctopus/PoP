<?php

class PoP_Module_Processor_NotificationSubcomponentLayouts extends PoP_Module_Processor_SubcomponentLayoutsBase
{
    public final const COMPONENT_SUBCOMPONENT_NOTIFICATIONCOMMENT = 'subcomponent-notificationcomment';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_SUBCOMPONENT_NOTIFICATIONCOMMENT,
        );
    }

    /**
     * @return \PoP\ComponentModel\Component\Component[]
     */
    public function getLayoutSubcomponents(\PoP\ComponentModel\Component\Component $component): array
    {
        $ret = parent::getLayoutSubcomponents($component);

        switch ($component->name) {
            case self::COMPONENT_SUBCOMPONENT_NOTIFICATIONCOMMENT:
                $ret[] = [PoP_Module_Processor_CommentScrolls::class, PoP_Module_Processor_CommentScrolls::COMPONENT_SCROLLLAYOUT_POSTCOMMENT];
                break;
        }

        return $ret;
    }

    public function getSubcomponentFieldNode(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_SUBCOMPONENT_NOTIFICATIONCOMMENT:
                return 'commentObjectID';
        }

        return parent::getSubcomponentFieldNode($component);
    }

    public function isIndividual(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_SUBCOMPONENT_NOTIFICATIONCOMMENT:
                return false;
        }

        return parent::isIndividual($component, $props);
    }

    public function initWebPlatformModelProps(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_SUBCOMPONENT_NOTIFICATIONCOMMENT:
                // Make the comment shine whenever added, similar to PoP_Module_Processor_CommentsLayouts::COMPONENT_LAYOUT_COMMENT_ADD
                // but without adding the scrollTop effect
                $this->appendProp([PoP_Module_Processor_CommentsLayouts::class, PoP_Module_Processor_CommentsLayouts::COMPONENT_LAYOUT_COMMENT_LIST], $props, 'class', 'pop-highlight');

                // Make it beep
                $this->mergeJsmethodsProp([PoP_Module_Processor_CommentsLayouts::class, PoP_Module_Processor_CommentsLayouts::COMPONENT_LAYOUT_COMMENT_LIST], $props, array('beep'));
                break;
        }

        parent::initWebPlatformModelProps($component, $props);
    }
}



