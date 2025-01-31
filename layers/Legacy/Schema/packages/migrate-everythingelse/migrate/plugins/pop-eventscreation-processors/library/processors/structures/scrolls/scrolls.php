<?php

class PoP_EventsCreation_Module_Processor_CustomScrolls extends PoP_Module_Processor_ScrollsBase
{
    public final const COMPONENT_SCROLL_MYEVENTS_SIMPLEVIEWPREVIEW = 'scroll-myevents-simpleviewpreview';
    public final const COMPONENT_SCROLL_MYPASTEVENTS_SIMPLEVIEWPREVIEW = 'scroll-mypastevents-simpleviewpreview';
    public final const COMPONENT_SCROLL_MYEVENTS_FULLVIEWPREVIEW = 'scroll-myevents-fullviewpreview';
    public final const COMPONENT_SCROLL_MYPASTEVENTS_FULLVIEWPREVIEW = 'scroll-mypastevents-fullviewpreview';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_SCROLL_MYEVENTS_SIMPLEVIEWPREVIEW,
            self::COMPONENT_SCROLL_MYPASTEVENTS_SIMPLEVIEWPREVIEW,
            self::COMPONENT_SCROLL_MYEVENTS_FULLVIEWPREVIEW,
            self::COMPONENT_SCROLL_MYPASTEVENTS_FULLVIEWPREVIEW,
        );
    }


    public function getInnerSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        $inners = array(
            self::COMPONENT_SCROLL_MYEVENTS_SIMPLEVIEWPREVIEW => [PoP_EventsCreation_Module_Processor_CustomScrollInners::class, PoP_EventsCreation_Module_Processor_CustomScrollInners::COMPONENT_SCROLLINNER_MYEVENTS_SIMPLEVIEWPREVIEW],
            self::COMPONENT_SCROLL_MYPASTEVENTS_SIMPLEVIEWPREVIEW => [PoP_EventsCreation_Module_Processor_CustomScrollInners::class, PoP_EventsCreation_Module_Processor_CustomScrollInners::COMPONENT_SCROLLINNER_MYPASTEVENTS_SIMPLEVIEWPREVIEW],
            self::COMPONENT_SCROLL_MYEVENTS_FULLVIEWPREVIEW => [PoP_EventsCreation_Module_Processor_CustomScrollInners::class, PoP_EventsCreation_Module_Processor_CustomScrollInners::COMPONENT_SCROLLINNER_MYEVENTS_FULLVIEWPREVIEW],
            self::COMPONENT_SCROLL_MYPASTEVENTS_FULLVIEWPREVIEW => [PoP_EventsCreation_Module_Processor_CustomScrollInners::class, PoP_EventsCreation_Module_Processor_CustomScrollInners::COMPONENT_SCROLLINNER_MYPASTEVENTS_FULLVIEWPREVIEW],
        );
        if ($inner = $inners[$component->name] ?? null) {
            return $inner;
        }

        return parent::getInnerSubcomponent($component);
    }

    public function initModelProps(\PoP\ComponentModel\Component\Component $component, array &$props): void
    {

        // Extra classes
        $simpleviews = array(
            self::COMPONENT_SCROLL_MYEVENTS_SIMPLEVIEWPREVIEW,
            self::COMPONENT_SCROLL_MYPASTEVENTS_SIMPLEVIEWPREVIEW,
        );
        $fullviews = array(
            self::COMPONENT_SCROLL_MYEVENTS_FULLVIEWPREVIEW,
            self::COMPONENT_SCROLL_MYPASTEVENTS_FULLVIEWPREVIEW,
        );

        $extra_class = '';
        if (in_array($component, $simpleviews)) {
            $extra_class = 'simpleview';
        } elseif (in_array($component, $fullviews)) {
            $extra_class = 'fullview';
        }
        $this->appendProp($component, $props, 'class', $extra_class);

        parent::initModelProps($component, $props);
    }
}


