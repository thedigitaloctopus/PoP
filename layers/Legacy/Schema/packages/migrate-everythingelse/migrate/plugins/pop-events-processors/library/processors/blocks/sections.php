<?php

class PoP_Events_Module_Processor_CustomSectionBlocks extends PoP_Module_Processor_SectionBlocksBase
{
    public final const COMPONENT_BLOCK_PASTEVENTS_SCROLL_NAVIGATOR = 'block-pastevents-scroll-navigator';
    public final const COMPONENT_BLOCK_EVENTS_SCROLL_NAVIGATOR = 'block-events-scroll-navigator';
    public final const COMPONENT_BLOCK_EVENTSCALENDAR_CALENDAR_NAVIGATOR = 'block-eventscalendar-calendar-navigator';
    public final const COMPONENT_BLOCK_PASTEVENTS_SCROLL_ADDONS = 'block-pastevents-scroll-addons';
    public final const COMPONENT_BLOCK_EVENTS_SCROLL_ADDONS = 'block-events-scroll-addons';
    public final const COMPONENT_BLOCK_EVENTSCALENDAR_CALENDAR_ADDONS = 'block-eventscalendar-calendar-addons';
    public final const COMPONENT_BLOCK_EVENTS_SCROLL_DETAILS = 'block-events-scroll-details';
    public final const COMPONENT_BLOCK_PASTEVENTS_SCROLL_DETAILS = 'block-pastevents-scroll-details';
    public final const COMPONENT_BLOCK_AUTHOREVENTS_SCROLL_DETAILS = 'block-authorevents-scroll-details';
    public final const COMPONENT_BLOCK_AUTHORPASTEVENTS_SCROLL_DETAILS = 'block-authorpastevents-scroll-details';
    public final const COMPONENT_BLOCK_TAGEVENTS_SCROLL_DETAILS = 'block-tagevents-scroll-details';
    public final const COMPONENT_BLOCK_TAGPASTEVENTS_SCROLL_DETAILS = 'block-tagpastevents-scroll-details';
    public final const COMPONENT_BLOCK_EVENTS_SCROLL_SIMPLEVIEW = 'block-events-scroll-simpleview';
    public final const COMPONENT_BLOCK_PASTEVENTS_SCROLL_SIMPLEVIEW = 'block-pastevents-scroll-simpleview';
    public final const COMPONENT_BLOCK_EVENTS_SCROLL_FULLVIEW = 'block-events-scroll-fullview';
    public final const COMPONENT_BLOCK_PASTEVENTS_SCROLL_FULLVIEW = 'block-pastevents-scroll-fullview';
    public final const COMPONENT_BLOCK_AUTHOREVENTS_SCROLL_SIMPLEVIEW = 'block-authorevents-scroll-simpleview';
    public final const COMPONENT_BLOCK_AUTHORPASTEVENTS_SCROLL_SIMPLEVIEW = 'block-authorpastevents-scroll-simpleview';
    public final const COMPONENT_BLOCK_AUTHOREVENTS_SCROLL_FULLVIEW = 'block-authorevents-scroll-fullview';
    public final const COMPONENT_BLOCK_AUTHORPASTEVENTS_SCROLL_FULLVIEW = 'block-authorpastevents-scroll-fullview';
    public final const COMPONENT_BLOCK_TAGEVENTS_SCROLL_SIMPLEVIEW = 'block-tagevents-scroll-simpleview';
    public final const COMPONENT_BLOCK_TAGPASTEVENTS_SCROLL_SIMPLEVIEW = 'block-tagpastevents-scroll-simpleview';
    public final const COMPONENT_BLOCK_TAGEVENTS_SCROLL_FULLVIEW = 'block-tagevents-scroll-fullview';
    public final const COMPONENT_BLOCK_TAGPASTEVENTS_SCROLL_FULLVIEW = 'block-tagpastevents-scroll-fullview';
    public final const COMPONENT_BLOCK_EVENTS_SCROLL_THUMBNAIL = 'block-events-scroll-thumbnail';
    public final const COMPONENT_BLOCK_PASTEVENTS_SCROLL_THUMBNAIL = 'block-pastevents-scroll-thumbnail';
    public final const COMPONENT_BLOCK_AUTHOREVENTS_SCROLL_THUMBNAIL = 'block-authorevents-scroll-thumbnail';
    public final const COMPONENT_BLOCK_AUTHORPASTEVENTS_SCROLL_THUMBNAIL = 'block-authorpastevents-scroll-thumbnail';
    public final const COMPONENT_BLOCK_TAGEVENTS_SCROLL_THUMBNAIL = 'block-tagevents-scroll-thumbnail';
    public final const COMPONENT_BLOCK_TAGPASTEVENTS_SCROLL_THUMBNAIL = 'block-tagpastevents-scroll-thumbnail';
    public final const COMPONENT_BLOCK_EVENTS_SCROLL_LIST = 'block-events-scroll-list';
    public final const COMPONENT_BLOCK_PASTEVENTS_SCROLL_LIST = 'block-pastevents-scroll-list';
    public final const COMPONENT_BLOCK_AUTHOREVENTS_SCROLL_LIST = 'block-authorevents-scroll-list';
    public final const COMPONENT_BLOCK_AUTHORPASTEVENTS_SCROLL_LIST = 'block-authorpastevents-scroll-list';
    public final const COMPONENT_BLOCK_TAGEVENTS_SCROLL_LIST = 'block-tagevents-scroll-list';
    public final const COMPONENT_BLOCK_TAGPASTEVENTS_SCROLL_LIST = 'block-tagpastevents-scroll-list';
    public final const COMPONENT_BLOCK_EVENTSCALENDAR_CALENDARMAP = 'block-eventscalendar-calendarmap';
    public final const COMPONENT_BLOCK_AUTHOREVENTSCALENDAR_CALENDARMAP = 'block-authoreventscalendar-calendarmap';
    public final const COMPONENT_BLOCK_TAGEVENTSCALENDAR_CALENDARMAP = 'block-tageventscalendar-calendarmap';
    public final const COMPONENT_BLOCK_EVENTSCALENDAR_CALENDAR = 'block-eventscalendar-calendar';
    public final const COMPONENT_BLOCK_AUTHOREVENTSCALENDAR_CALENDAR = 'block-authoreventscalendar-calendar';
    public final const COMPONENT_BLOCK_TAGEVENTSCALENDAR_CALENDAR = 'block-tageventscalendar-calendar';
    public final const COMPONENT_BLOCK_EVENTS_CAROUSEL = 'block-events-carousel';
    public final const COMPONENT_BLOCK_AUTHOREVENTS_CAROUSEL = 'block-authorevents-carousel';
    public final const COMPONENT_BLOCK_TAGEVENTS_CAROUSEL = 'block-tagevents-carousel';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_BLOCK_PASTEVENTS_SCROLL_NAVIGATOR,
            self::COMPONENT_BLOCK_EVENTS_SCROLL_NAVIGATOR,
            self::COMPONENT_BLOCK_EVENTSCALENDAR_CALENDAR_NAVIGATOR,
            self::COMPONENT_BLOCK_PASTEVENTS_SCROLL_ADDONS,
            self::COMPONENT_BLOCK_EVENTS_SCROLL_ADDONS,
            self::COMPONENT_BLOCK_EVENTSCALENDAR_CALENDAR_ADDONS,
            self::COMPONENT_BLOCK_EVENTS_SCROLL_DETAILS,
            self::COMPONENT_BLOCK_PASTEVENTS_SCROLL_DETAILS,
            self::COMPONENT_BLOCK_EVENTS_SCROLL_SIMPLEVIEW,
            self::COMPONENT_BLOCK_PASTEVENTS_SCROLL_SIMPLEVIEW,
            self::COMPONENT_BLOCK_EVENTS_SCROLL_FULLVIEW,
            self::COMPONENT_BLOCK_PASTEVENTS_SCROLL_FULLVIEW,
            self::COMPONENT_BLOCK_EVENTS_SCROLL_THUMBNAIL,
            self::COMPONENT_BLOCK_PASTEVENTS_SCROLL_THUMBNAIL,
            self::COMPONENT_BLOCK_EVENTS_SCROLL_LIST,
            self::COMPONENT_BLOCK_PASTEVENTS_SCROLL_LIST,
            self::COMPONENT_BLOCK_EVENTSCALENDAR_CALENDARMAP,
            self::COMPONENT_BLOCK_EVENTSCALENDAR_CALENDAR,

            self::COMPONENT_BLOCK_AUTHOREVENTS_SCROLL_DETAILS,
            self::COMPONENT_BLOCK_AUTHORPASTEVENTS_SCROLL_DETAILS,
            self::COMPONENT_BLOCK_AUTHOREVENTS_SCROLL_SIMPLEVIEW,
            self::COMPONENT_BLOCK_AUTHORPASTEVENTS_SCROLL_SIMPLEVIEW,
            self::COMPONENT_BLOCK_AUTHOREVENTS_SCROLL_FULLVIEW,
            self::COMPONENT_BLOCK_AUTHORPASTEVENTS_SCROLL_FULLVIEW,
            self::COMPONENT_BLOCK_AUTHOREVENTS_SCROLL_THUMBNAIL,
            self::COMPONENT_BLOCK_AUTHORPASTEVENTS_SCROLL_THUMBNAIL,
            self::COMPONENT_BLOCK_AUTHOREVENTS_SCROLL_LIST,
            self::COMPONENT_BLOCK_AUTHORPASTEVENTS_SCROLL_LIST,
            self::COMPONENT_BLOCK_AUTHOREVENTSCALENDAR_CALENDARMAP,
            self::COMPONENT_BLOCK_AUTHOREVENTSCALENDAR_CALENDAR,

            self::COMPONENT_BLOCK_TAGEVENTS_SCROLL_DETAILS,
            self::COMPONENT_BLOCK_TAGPASTEVENTS_SCROLL_DETAILS,
            self::COMPONENT_BLOCK_TAGEVENTS_SCROLL_SIMPLEVIEW,
            self::COMPONENT_BLOCK_TAGPASTEVENTS_SCROLL_SIMPLEVIEW,
            self::COMPONENT_BLOCK_TAGEVENTS_SCROLL_FULLVIEW,
            self::COMPONENT_BLOCK_TAGPASTEVENTS_SCROLL_FULLVIEW,
            self::COMPONENT_BLOCK_TAGEVENTS_SCROLL_THUMBNAIL,
            self::COMPONENT_BLOCK_TAGPASTEVENTS_SCROLL_THUMBNAIL,
            self::COMPONENT_BLOCK_TAGEVENTS_SCROLL_LIST,
            self::COMPONENT_BLOCK_TAGPASTEVENTS_SCROLL_LIST,
            self::COMPONENT_BLOCK_TAGEVENTSCALENDAR_CALENDARMAP,
            self::COMPONENT_BLOCK_TAGEVENTSCALENDAR_CALENDAR,

            self::COMPONENT_BLOCK_EVENTS_CAROUSEL,
            self::COMPONENT_BLOCK_AUTHOREVENTS_CAROUSEL,
            self::COMPONENT_BLOCK_TAGEVENTS_CAROUSEL,
        );
    }

    public function getRelevantRoute(\PoP\ComponentModel\Component\Component $component, array &$props): ?string
    {
        return match($component->name) {
            self::COMPONENT_BLOCK_AUTHOREVENTS_CAROUSEL => POP_EVENTS_ROUTE_EVENTS,
            self::COMPONENT_BLOCK_AUTHOREVENTS_SCROLL_DETAILS => POP_EVENTS_ROUTE_EVENTS,
            self::COMPONENT_BLOCK_AUTHOREVENTS_SCROLL_FULLVIEW => POP_EVENTS_ROUTE_EVENTS,
            self::COMPONENT_BLOCK_AUTHOREVENTS_SCROLL_LIST => POP_EVENTS_ROUTE_EVENTS,
            self::COMPONENT_BLOCK_AUTHOREVENTS_SCROLL_SIMPLEVIEW => POP_EVENTS_ROUTE_EVENTS,
            self::COMPONENT_BLOCK_AUTHOREVENTS_SCROLL_THUMBNAIL => POP_EVENTS_ROUTE_EVENTS,
            self::COMPONENT_BLOCK_AUTHOREVENTSCALENDAR_CALENDAR => POP_EVENTS_ROUTE_EVENTSCALENDAR,
            self::COMPONENT_BLOCK_AUTHOREVENTSCALENDAR_CALENDARMAP => POP_EVENTS_ROUTE_EVENTSCALENDAR,
            self::COMPONENT_BLOCK_AUTHORPASTEVENTS_SCROLL_DETAILS => POP_EVENTS_ROUTE_PASTEVENTS,
            self::COMPONENT_BLOCK_AUTHORPASTEVENTS_SCROLL_FULLVIEW => POP_EVENTS_ROUTE_PASTEVENTS,
            self::COMPONENT_BLOCK_AUTHORPASTEVENTS_SCROLL_LIST => POP_EVENTS_ROUTE_PASTEVENTS,
            self::COMPONENT_BLOCK_AUTHORPASTEVENTS_SCROLL_SIMPLEVIEW => POP_EVENTS_ROUTE_PASTEVENTS,
            self::COMPONENT_BLOCK_AUTHORPASTEVENTS_SCROLL_THUMBNAIL => POP_EVENTS_ROUTE_PASTEVENTS,
            self::COMPONENT_BLOCK_EVENTS_CAROUSEL => POP_EVENTS_ROUTE_EVENTS,
            self::COMPONENT_BLOCK_EVENTS_SCROLL_ADDONS => POP_EVENTS_ROUTE_EVENTS,
            self::COMPONENT_BLOCK_EVENTS_SCROLL_DETAILS => POP_EVENTS_ROUTE_EVENTS,
            self::COMPONENT_BLOCK_EVENTS_SCROLL_FULLVIEW => POP_EVENTS_ROUTE_EVENTS,
            self::COMPONENT_BLOCK_EVENTS_SCROLL_LIST => POP_EVENTS_ROUTE_EVENTS,
            self::COMPONENT_BLOCK_EVENTS_SCROLL_NAVIGATOR => POP_EVENTS_ROUTE_EVENTS,
            self::COMPONENT_BLOCK_EVENTS_SCROLL_SIMPLEVIEW => POP_EVENTS_ROUTE_EVENTS,
            self::COMPONENT_BLOCK_EVENTS_SCROLL_THUMBNAIL => POP_EVENTS_ROUTE_EVENTS,
            self::COMPONENT_BLOCK_EVENTSCALENDAR_CALENDAR => POP_EVENTS_ROUTE_EVENTSCALENDAR,
            self::COMPONENT_BLOCK_EVENTSCALENDAR_CALENDAR_ADDONS => POP_EVENTS_ROUTE_EVENTSCALENDAR,
            self::COMPONENT_BLOCK_EVENTSCALENDAR_CALENDAR_NAVIGATOR => POP_EVENTS_ROUTE_EVENTSCALENDAR,
            self::COMPONENT_BLOCK_EVENTSCALENDAR_CALENDARMAP => POP_EVENTS_ROUTE_EVENTSCALENDAR,
            self::COMPONENT_BLOCK_PASTEVENTS_SCROLL_ADDONS => POP_EVENTS_ROUTE_PASTEVENTS,
            self::COMPONENT_BLOCK_PASTEVENTS_SCROLL_DETAILS => POP_EVENTS_ROUTE_PASTEVENTS,
            self::COMPONENT_BLOCK_PASTEVENTS_SCROLL_FULLVIEW => POP_EVENTS_ROUTE_PASTEVENTS,
            self::COMPONENT_BLOCK_PASTEVENTS_SCROLL_LIST => POP_EVENTS_ROUTE_PASTEVENTS,
            self::COMPONENT_BLOCK_PASTEVENTS_SCROLL_NAVIGATOR => POP_EVENTS_ROUTE_PASTEVENTS,
            self::COMPONENT_BLOCK_PASTEVENTS_SCROLL_SIMPLEVIEW => POP_EVENTS_ROUTE_PASTEVENTS,
            self::COMPONENT_BLOCK_PASTEVENTS_SCROLL_THUMBNAIL => POP_EVENTS_ROUTE_PASTEVENTS,
            self::COMPONENT_BLOCK_TAGEVENTS_CAROUSEL => POP_EVENTS_ROUTE_EVENTS,
            self::COMPONENT_BLOCK_TAGEVENTS_SCROLL_DETAILS => POP_EVENTS_ROUTE_EVENTS,
            self::COMPONENT_BLOCK_TAGEVENTS_SCROLL_FULLVIEW => POP_EVENTS_ROUTE_EVENTS,
            self::COMPONENT_BLOCK_TAGEVENTS_SCROLL_LIST => POP_EVENTS_ROUTE_EVENTS,
            self::COMPONENT_BLOCK_TAGEVENTS_SCROLL_SIMPLEVIEW => POP_EVENTS_ROUTE_EVENTS,
            self::COMPONENT_BLOCK_TAGEVENTS_SCROLL_THUMBNAIL => POP_EVENTS_ROUTE_EVENTS,
            self::COMPONENT_BLOCK_TAGEVENTSCALENDAR_CALENDAR => POP_EVENTS_ROUTE_EVENTSCALENDAR,
            self::COMPONENT_BLOCK_TAGEVENTSCALENDAR_CALENDARMAP => POP_EVENTS_ROUTE_EVENTSCALENDAR,
            self::COMPONENT_BLOCK_TAGPASTEVENTS_SCROLL_DETAILS => POP_EVENTS_ROUTE_PASTEVENTS,
            self::COMPONENT_BLOCK_TAGPASTEVENTS_SCROLL_FULLVIEW => POP_EVENTS_ROUTE_PASTEVENTS,
            self::COMPONENT_BLOCK_TAGPASTEVENTS_SCROLL_LIST => POP_EVENTS_ROUTE_PASTEVENTS,
            self::COMPONENT_BLOCK_TAGPASTEVENTS_SCROLL_SIMPLEVIEW => POP_EVENTS_ROUTE_PASTEVENTS,
            self::COMPONENT_BLOCK_TAGPASTEVENTS_SCROLL_THUMBNAIL => POP_EVENTS_ROUTE_PASTEVENTS,
            default => parent::getRelevantRoute($component, $props),
        };
    }

    protected function getInnerSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        $inner_components = array(
            self::COMPONENT_BLOCK_EVENTSCALENDAR_CALENDARMAP => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_EVENTSCALENDAR_CALENDARMAP],
            self::COMPONENT_BLOCK_AUTHOREVENTSCALENDAR_CALENDARMAP => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_AUTHOREVENTSCALENDAR_CALENDARMAP],
            self::COMPONENT_BLOCK_TAGEVENTSCALENDAR_CALENDARMAP => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_TAGEVENTSCALENDAR_CALENDARMAP],
            self::COMPONENT_BLOCK_PASTEVENTS_SCROLL_NAVIGATOR => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_PASTEVENTS_SCROLL_NAVIGATOR],
            self::COMPONENT_BLOCK_EVENTS_SCROLL_NAVIGATOR => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_EVENTS_SCROLL_NAVIGATOR],
            self::COMPONENT_BLOCK_EVENTSCALENDAR_CALENDAR_NAVIGATOR => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_EVENTSCALENDAR_CALENDAR_NAVIGATOR],
            self::COMPONENT_BLOCK_PASTEVENTS_SCROLL_ADDONS => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_PASTEVENTS_SCROLL_ADDONS],
            self::COMPONENT_BLOCK_EVENTS_SCROLL_ADDONS => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_EVENTS_SCROLL_ADDONS],
            self::COMPONENT_BLOCK_EVENTSCALENDAR_CALENDAR_ADDONS => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_EVENTSCALENDAR_CALENDAR_ADDONS],
            self::COMPONENT_BLOCK_EVENTS_SCROLL_DETAILS => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_EVENTS_SCROLL_DETAILS],
            self::COMPONENT_BLOCK_PASTEVENTS_SCROLL_DETAILS => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_PASTEVENTS_SCROLL_DETAILS],
            self::COMPONENT_BLOCK_EVENTS_SCROLL_SIMPLEVIEW => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_EVENTS_SCROLL_SIMPLEVIEW],
            self::COMPONENT_BLOCK_PASTEVENTS_SCROLL_SIMPLEVIEW => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_PASTEVENTS_SCROLL_SIMPLEVIEW],
            self::COMPONENT_BLOCK_EVENTS_SCROLL_FULLVIEW => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_EVENTS_SCROLL_FULLVIEW],
            self::COMPONENT_BLOCK_PASTEVENTS_SCROLL_FULLVIEW => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_PASTEVENTS_SCROLL_FULLVIEW],
            self::COMPONENT_BLOCK_EVENTS_SCROLL_THUMBNAIL => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_EVENTS_SCROLL_THUMBNAIL],
            self::COMPONENT_BLOCK_PASTEVENTS_SCROLL_THUMBNAIL => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_PASTEVENTS_SCROLL_THUMBNAIL],
            self::COMPONENT_BLOCK_EVENTS_SCROLL_LIST => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_EVENTS_SCROLL_LIST],
            self::COMPONENT_BLOCK_PASTEVENTS_SCROLL_LIST => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_PASTEVENTS_SCROLL_LIST],
            self::COMPONENT_BLOCK_EVENTSCALENDAR_CALENDAR => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_EVENTSCALENDAR_CALENDAR],
            self::COMPONENT_BLOCK_AUTHOREVENTS_SCROLL_DETAILS => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_AUTHOREVENTS_SCROLL_DETAILS],
            self::COMPONENT_BLOCK_AUTHORPASTEVENTS_SCROLL_DETAILS => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_AUTHORPASTEVENTS_SCROLL_DETAILS],
            self::COMPONENT_BLOCK_AUTHOREVENTS_SCROLL_SIMPLEVIEW => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_AUTHOREVENTS_SCROLL_SIMPLEVIEW],//self::COMPONENT_SCROLL_AUTHOREVENTS_SIMPLEVIEW,
            self::COMPONENT_BLOCK_AUTHORPASTEVENTS_SCROLL_SIMPLEVIEW => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_AUTHORPASTEVENTS_SCROLL_SIMPLEVIEW],//self::COMPONENT_SCROLL_AUTHORPASTEVENTS_SIMPLEVIEW,
            self::COMPONENT_BLOCK_AUTHOREVENTS_SCROLL_FULLVIEW => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_AUTHOREVENTS_SCROLL_FULLVIEW],
            self::COMPONENT_BLOCK_AUTHORPASTEVENTS_SCROLL_FULLVIEW => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_AUTHORPASTEVENTS_SCROLL_FULLVIEW],
            self::COMPONENT_BLOCK_AUTHOREVENTS_SCROLL_THUMBNAIL => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_AUTHOREVENTS_SCROLL_THUMBNAIL],
            self::COMPONENT_BLOCK_AUTHORPASTEVENTS_SCROLL_THUMBNAIL => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_AUTHORPASTEVENTS_SCROLL_THUMBNAIL],
            self::COMPONENT_BLOCK_AUTHOREVENTS_SCROLL_LIST => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_AUTHOREVENTS_SCROLL_LIST],
            self::COMPONENT_BLOCK_AUTHORPASTEVENTS_SCROLL_LIST => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_AUTHORPASTEVENTS_SCROLL_LIST],
            self::COMPONENT_BLOCK_AUTHOREVENTSCALENDAR_CALENDAR => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_AUTHOREVENTSCALENDAR_CALENDAR],
            self::COMPONENT_BLOCK_TAGEVENTS_SCROLL_DETAILS => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_TAGEVENTS_SCROLL_DETAILS],
            self::COMPONENT_BLOCK_TAGPASTEVENTS_SCROLL_DETAILS => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_TAGPASTEVENTS_SCROLL_DETAILS],
            self::COMPONENT_BLOCK_TAGEVENTS_SCROLL_SIMPLEVIEW => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_TAGEVENTS_SCROLL_SIMPLEVIEW],//self::COMPONENT_SCROLL_AUTHOREVENTS_SIMPLEVIEW,
            self::COMPONENT_BLOCK_TAGPASTEVENTS_SCROLL_SIMPLEVIEW => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_TAGPASTEVENTS_SCROLL_SIMPLEVIEW],//self::COMPONENT_SCROLL_AUTHORPASTEVENTS_SIMPLEVIEW,
            self::COMPONENT_BLOCK_TAGEVENTS_SCROLL_FULLVIEW => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_TAGEVENTS_SCROLL_FULLVIEW],
            self::COMPONENT_BLOCK_TAGPASTEVENTS_SCROLL_FULLVIEW => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_TAGPASTEVENTS_SCROLL_FULLVIEW],
            self::COMPONENT_BLOCK_TAGEVENTS_SCROLL_THUMBNAIL => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_TAGEVENTS_SCROLL_THUMBNAIL],
            self::COMPONENT_BLOCK_TAGPASTEVENTS_SCROLL_THUMBNAIL => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_TAGPASTEVENTS_SCROLL_THUMBNAIL],
            self::COMPONENT_BLOCK_TAGEVENTS_SCROLL_LIST => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_TAGEVENTS_SCROLL_LIST],
            self::COMPONENT_BLOCK_TAGPASTEVENTS_SCROLL_LIST => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_TAGPASTEVENTS_SCROLL_LIST],
            self::COMPONENT_BLOCK_TAGEVENTSCALENDAR_CALENDAR => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_TAGEVENTSCALENDAR_CALENDAR],
            self::COMPONENT_BLOCK_EVENTS_CAROUSEL => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_EVENTS_CAROUSEL],
            self::COMPONENT_BLOCK_AUTHOREVENTS_CAROUSEL => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_AUTHOREVENTS_CAROUSEL],
            self::COMPONENT_BLOCK_TAGEVENTS_CAROUSEL => [PoP_Events_Module_Processor_CustomSectionDataloads::class, PoP_Events_Module_Processor_CustomSectionDataloads::COMPONENT_DATALOAD_TAGEVENTS_CAROUSEL],
        );

        return $inner_components[$component->name] ?? null;
    }

    protected function getControlgroupTopSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_BLOCK_PASTEVENTS_SCROLL_ADDONS:
            case self::COMPONENT_BLOCK_EVENTS_SCROLL_ADDONS:
            case self::COMPONENT_BLOCK_EVENTSCALENDAR_CALENDAR_ADDONS:
                return [PoP_Module_Processor_CustomControlGroups::class, PoP_Module_Processor_CustomControlGroups::COMPONENT_CONTROLGROUP_SUBMENUSHARE];

            case self::COMPONENT_BLOCK_EVENTS_SCROLL_DETAILS:
            case self::COMPONENT_BLOCK_EVENTS_SCROLL_SIMPLEVIEW:
            case self::COMPONENT_BLOCK_EVENTS_SCROLL_FULLVIEW:
            case self::COMPONENT_BLOCK_EVENTS_SCROLL_THUMBNAIL:
            case self::COMPONENT_BLOCK_EVENTS_SCROLL_LIST:
                return [PoP_Events_Module_Processor_CustomControlGroups::class, PoP_Events_Module_Processor_CustomControlGroups::COMPONENT_CONTROLGROUP_BLOCKEVENTLIST];

            case self::COMPONENT_BLOCK_AUTHOREVENTS_SCROLL_DETAILS:
            case self::COMPONENT_BLOCK_AUTHOREVENTS_SCROLL_SIMPLEVIEW:
            case self::COMPONENT_BLOCK_AUTHOREVENTS_SCROLL_FULLVIEW:
            case self::COMPONENT_BLOCK_AUTHOREVENTS_SCROLL_THUMBNAIL:
            case self::COMPONENT_BLOCK_AUTHOREVENTS_SCROLL_LIST:
                return [PoP_Events_Module_Processor_CustomControlGroups::class, PoP_Events_Module_Processor_CustomControlGroups::COMPONENT_CONTROLGROUP_BLOCKAUTHOREVENTLIST];

            case self::COMPONENT_BLOCK_TAGEVENTS_SCROLL_DETAILS:
            case self::COMPONENT_BLOCK_TAGEVENTS_SCROLL_SIMPLEVIEW:
            case self::COMPONENT_BLOCK_TAGEVENTS_SCROLL_FULLVIEW:
            case self::COMPONENT_BLOCK_TAGEVENTS_SCROLL_THUMBNAIL:
            case self::COMPONENT_BLOCK_TAGEVENTS_SCROLL_LIST:
                return [PoP_Events_Module_Processor_CustomControlGroups::class, PoP_Events_Module_Processor_CustomControlGroups::COMPONENT_CONTROLGROUP_BLOCKTAGEVENTLIST];

            case self::COMPONENT_BLOCK_AUTHORPASTEVENTS_SCROLL_DETAILS:
            case self::COMPONENT_BLOCK_AUTHORPASTEVENTS_SCROLL_SIMPLEVIEW:
            case self::COMPONENT_BLOCK_AUTHORPASTEVENTS_SCROLL_FULLVIEW:
            case self::COMPONENT_BLOCK_AUTHORPASTEVENTS_SCROLL_THUMBNAIL:
            case self::COMPONENT_BLOCK_AUTHORPASTEVENTS_SCROLL_LIST:
            case self::COMPONENT_BLOCK_AUTHORPASTEVENTS_SCROLL_SIMPLEVIEW:
            case self::COMPONENT_BLOCK_AUTHORPASTEVENTS_SCROLL_FULLVIEW:
            case self::COMPONENT_BLOCK_AUTHOREVENTSCALENDAR_CALENDAR:
                // Allow URE to add the ContentSource switch
                return [PoP_Module_Processor_CustomControlGroups::class, PoP_Module_Processor_CustomControlGroups::COMPONENT_CONTROLGROUP_BLOCKAUTHORPOSTLIST];

            case self::COMPONENT_BLOCK_PASTEVENTS_SCROLL_DETAILS:
            case self::COMPONENT_BLOCK_TAGPASTEVENTS_SCROLL_DETAILS:
            case self::COMPONENT_BLOCK_PASTEVENTS_SCROLL_SIMPLEVIEW:
            case self::COMPONENT_BLOCK_TAGPASTEVENTS_SCROLL_SIMPLEVIEW:
            case self::COMPONENT_BLOCK_PASTEVENTS_SCROLL_FULLVIEW:
            case self::COMPONENT_BLOCK_TAGPASTEVENTS_SCROLL_FULLVIEW:
            case self::COMPONENT_BLOCK_PASTEVENTS_SCROLL_THUMBNAIL:
            case self::COMPONENT_BLOCK_TAGPASTEVENTS_SCROLL_THUMBNAIL:
            case self::COMPONENT_BLOCK_PASTEVENTS_SCROLL_LIST:
            case self::COMPONENT_BLOCK_TAGPASTEVENTS_SCROLL_LIST:
            case self::COMPONENT_BLOCK_PASTEVENTS_SCROLL_SIMPLEVIEW:
            case self::COMPONENT_BLOCK_TAGPASTEVENTS_SCROLL_SIMPLEVIEW:
            case self::COMPONENT_BLOCK_PASTEVENTS_SCROLL_FULLVIEW:
            case self::COMPONENT_BLOCK_TAGPASTEVENTS_SCROLL_FULLVIEW:
            case self::COMPONENT_BLOCK_EVENTSCALENDAR_CALENDARMAP:
            case self::COMPONENT_BLOCK_EVENTSCALENDAR_CALENDAR:
            case self::COMPONENT_BLOCK_TAGEVENTSCALENDAR_CALENDAR:
                return [PoP_Module_Processor_CustomControlGroups::class, PoP_Module_Processor_CustomControlGroups::COMPONENT_CONTROLGROUP_BLOCKPOSTLIST];
        }

        return parent::getControlgroupTopSubcomponent($component);
    }

    public function getTitle(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_BLOCK_EVENTS_CAROUSEL:
            case self::COMPONENT_BLOCK_AUTHOREVENTS_CAROUSEL:
            case self::COMPONENT_BLOCK_TAGEVENTS_CAROUSEL:
                return '';
        }

        return parent::getTitle($component, $props);
    }

    public function initModelProps(\PoP\ComponentModel\Component\Component $component, array &$props): void
    {
        switch ($component->name) {
            case self::COMPONENT_BLOCK_EVENTS_CAROUSEL:
            case self::COMPONENT_BLOCK_AUTHOREVENTS_CAROUSEL:
            case self::COMPONENT_BLOCK_TAGEVENTS_CAROUSEL:
                // Artificial property added to identify the template when adding component-resources
                // $this->setProp($component, $props, 'resourceloader', 'block-carousel');
                $this->appendProp($component, $props, 'class', 'pop-block-carousel block-posts-carousel block-events-carousel');
                break;
        }

        parent::initModelProps($component, $props);
    }
}



