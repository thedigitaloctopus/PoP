<?php

class PoP_Module_Processor_CommentsWrappers extends PoP_Module_Processor_ConditionWrapperBase
{
    public final const COMPONENT_WIDGETWRAPPER_POSTCOMMENTS = 'widgetwrapper-postcomments';
    public final const COMPONENT_WIDGETWRAPPER_POSTCOMMENTS_APPENDTOSCRIPT = 'widgetwrapper-postcomments-appendtoscript';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_WIDGETWRAPPER_POSTCOMMENTS,
            self::COMPONENT_WIDGETWRAPPER_POSTCOMMENTS_APPENDTOSCRIPT,
        );
    }

    public function getConditionSucceededSubcomponents(\PoP\ComponentModel\Component\Component $component)
    {
        $ret = parent::getConditionSucceededSubcomponents($component);

        switch ($component->name) {
            case self::COMPONENT_WIDGETWRAPPER_POSTCOMMENTS:
                $ret[] = [PoP_Module_Processor_CommentsWidgets::class, PoP_Module_Processor_CommentsWidgets::COMPONENT_WIDGET_POSTCOMMENTS];
                break;

            case self::COMPONENT_WIDGETWRAPPER_POSTCOMMENTS_APPENDTOSCRIPT:
                $ret[] = [PoP_Module_Processor_CommentsWidgets::class, PoP_Module_Processor_CommentsWidgets::COMPONENT_WIDGET_POSTCOMMENTS_APPENDTOSCRIPT];
                break;
        }

        return $ret;
    }

    public function initModelProps(\PoP\ComponentModel\Component\Component $component, array &$props): void
    {
        switch ($component->name) {
            case self::COMPONENT_WIDGETWRAPPER_POSTCOMMENTS:
            case self::COMPONENT_WIDGETWRAPPER_POSTCOMMENTS_APPENDTOSCRIPT:
                $this->appendProp($component, $props, 'class', 'postcomments clearfix');
                break;
        }

        parent::initModelProps($component, $props);
    }

    public function getConditionField(\PoP\ComponentModel\Component\Component $component): ?string
    {
        switch ($component->name) {
            case self::COMPONENT_WIDGETWRAPPER_POSTCOMMENTS:
            case self::COMPONENT_WIDGETWRAPPER_POSTCOMMENTS_APPENDTOSCRIPT:
                return 'hasComments';
        }

        return null;
    }
}



