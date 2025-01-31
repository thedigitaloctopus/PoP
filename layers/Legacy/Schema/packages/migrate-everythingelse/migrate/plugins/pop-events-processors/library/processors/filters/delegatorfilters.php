<?php

class PoP_Events_Module_Processor_CustomDelegatorFilters extends PoP_Module_Processor_CustomDelegatorFiltersBase
{
    public final const COMPONENT_DELEGATORFILTER_AUTHOREVENTS = 'delegatorfilter-authorevents';
    public final const COMPONENT_DELEGATORFILTER_TAGEVENTS = 'delegatorfilter-tagevents';
    public final const COMPONENT_DELEGATORFILTER_AUTHOREVENTSCALENDAR = 'delegatorfilter-authoreventscalendar';
    public final const COMPONENT_DELEGATORFILTER_TAGEVENTSCALENDAR = 'delegatorfilter-tageventscalendar';
    public final const COMPONENT_DELEGATORFILTER_EVENTS = 'delegatorfilter-events';
    public final const COMPONENT_DELEGATORFILTER_EVENTSCALENDAR = 'delegatorfilter-eventscalendar';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_DELEGATORFILTER_EVENTS,
            self::COMPONENT_DELEGATORFILTER_AUTHOREVENTS,
            self::COMPONENT_DELEGATORFILTER_TAGEVENTS,
            self::COMPONENT_DELEGATORFILTER_EVENTSCALENDAR,
            self::COMPONENT_DELEGATORFILTER_AUTHOREVENTSCALENDAR,
            self::COMPONENT_DELEGATORFILTER_TAGEVENTSCALENDAR,
        );
    }

    public function getInnerSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        $inners = array(
            self::COMPONENT_DELEGATORFILTER_EVENTS => [PoP_Events_Module_Processor_CustomSimpleFilterInners::class, PoP_Events_Module_Processor_CustomSimpleFilterInners::COMPONENT_SIMPLEFILTERINPUTCONTAINER_EVENTS],
            self::COMPONENT_DELEGATORFILTER_AUTHOREVENTS => [PoP_Events_Module_Processor_CustomSimpleFilterInners::class, PoP_Events_Module_Processor_CustomSimpleFilterInners::COMPONENT_SIMPLEFILTERINPUTCONTAINER_AUTHOREVENTS],
            self::COMPONENT_DELEGATORFILTER_TAGEVENTS => [PoP_Events_Module_Processor_CustomSimpleFilterInners::class, PoP_Events_Module_Processor_CustomSimpleFilterInners::COMPONENT_SIMPLEFILTERINPUTCONTAINER_TAGEVENTS],
            self::COMPONENT_DELEGATORFILTER_EVENTSCALENDAR => [PoP_Events_Module_Processor_CustomSimpleFilterInners::class, PoP_Events_Module_Processor_CustomSimpleFilterInners::COMPONENT_SIMPLEFILTERINPUTCONTAINER_EVENTSCALENDAR],
            self::COMPONENT_DELEGATORFILTER_AUTHOREVENTSCALENDAR => [PoP_Events_Module_Processor_CustomSimpleFilterInners::class, PoP_Events_Module_Processor_CustomSimpleFilterInners::COMPONENT_SIMPLEFILTERINPUTCONTAINER_AUTHOREVENTSCALENDAR],
            self::COMPONENT_DELEGATORFILTER_TAGEVENTSCALENDAR => [PoP_Events_Module_Processor_CustomSimpleFilterInners::class, PoP_Events_Module_Processor_CustomSimpleFilterInners::COMPONENT_SIMPLEFILTERINPUTCONTAINER_TAGEVENTSCALENDAR],
        );

        if ($inner = $inners[$component->name] ?? null) {
            return $inner;
        }

        return parent::getInnerSubcomponent($component);
    }
}



