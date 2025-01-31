<?php
use PoP\ComponentModel\State\ApplicationState;

class GD_EM_Module_Processor_SidebarMultiples extends PoP_Module_Processor_SidebarMultiplesBase
{
    public final const COMPONENT_MULTIPLE_SECTION_EVENTS_CALENDAR_SIDEBAR = 'multiple-events-calendar-sidebar';
    public final const COMPONENT_MULTIPLE_SECTION_EVENTS_SIDEBAR = 'multiple-section-events-sidebar';
    public final const COMPONENT_MULTIPLE_SECTION_PASTEVENTS_SIDEBAR = 'multiple-section-pastevents-sidebar';
    public final const COMPONENT_MULTIPLE_TAG_EVENTS_CALENDAR_SIDEBAR = 'multiple-tag-events-calendar-sidebar';
    public final const COMPONENT_MULTIPLE_TAG_EVENTS_SIDEBAR = 'multiple-tag-events-sidebar';
    public final const COMPONENT_MULTIPLE_TAG_PASTEVENTS_SIDEBAR = 'multiple-tag-pastevents-sidebar';
    public final const COMPONENT_MULTIPLE_SINGLE_EVENT_SIDEBAR = 'multiple-single-event-sidebar';
    public final const COMPONENT_MULTIPLE_SINGLE_PASTEVENT_SIDEBAR = 'multiple-single-pastevent-sidebar';
    public final const COMPONENT_MULTIPLE_AUTHOREVENTS_SIDEBAR = 'multiple-authorevents-sidebar';
    public final const COMPONENT_MULTIPLE_AUTHORPASTEVENTS_SIDEBAR = 'multiple-authorpastevents-sidebar';
    public final const COMPONENT_MULTIPLE_AUTHOREVENTSCALENDAR_SIDEBAR = 'multiple-authoreventscalendar-sidebar';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_MULTIPLE_SECTION_EVENTS_CALENDAR_SIDEBAR,
            self::COMPONENT_MULTIPLE_SECTION_EVENTS_SIDEBAR,
            self::COMPONENT_MULTIPLE_SECTION_PASTEVENTS_SIDEBAR,
            self::COMPONENT_MULTIPLE_TAG_EVENTS_CALENDAR_SIDEBAR,
            self::COMPONENT_MULTIPLE_TAG_EVENTS_SIDEBAR,
            self::COMPONENT_MULTIPLE_TAG_PASTEVENTS_SIDEBAR,
            self::COMPONENT_MULTIPLE_SINGLE_EVENT_SIDEBAR,
            self::COMPONENT_MULTIPLE_SINGLE_PASTEVENT_SIDEBAR,
            self::COMPONENT_MULTIPLE_AUTHOREVENTS_SIDEBAR,
            self::COMPONENT_MULTIPLE_AUTHORPASTEVENTS_SIDEBAR,
            self::COMPONENT_MULTIPLE_AUTHOREVENTSCALENDAR_SIDEBAR,
        );
    }

    public function getInnerSubcomponents(\PoP\ComponentModel\Component\Component $component): array
    {
        $ret = parent::getInnerSubcomponents($component);

        $blocks = array(
            self::COMPONENT_MULTIPLE_SECTION_EVENTS_CALENDAR_SIDEBAR => [GD_EM_Module_Processor_CustomSectionSidebarInners::class, GD_EM_Module_Processor_CustomSectionSidebarInners::COMPONENT_MULTIPLE_SIDEBARINNER_SECTION_EVENTS_CALENDAR],
            self::COMPONENT_MULTIPLE_SECTION_EVENTS_SIDEBAR => [GD_EM_Module_Processor_CustomSectionSidebarInners::class, GD_EM_Module_Processor_CustomSectionSidebarInners::COMPONENT_MULTIPLE_SIDEBARINNER_SECTION_EVENTS],
            self::COMPONENT_MULTIPLE_SECTION_PASTEVENTS_SIDEBAR => [GD_EM_Module_Processor_CustomSectionSidebarInners::class, GD_EM_Module_Processor_CustomSectionSidebarInners::COMPONENT_MULTIPLE_SIDEBARINNER_SECTION_PASTEVENTS],
            self::COMPONENT_MULTIPLE_TAG_EVENTS_CALENDAR_SIDEBAR => [GD_EM_Module_Processor_CustomSectionSidebarInners::class, GD_EM_Module_Processor_CustomSectionSidebarInners::COMPONENT_MULTIPLE_SIDEBARINNER_TAG_EVENTS_CALENDAR],
            self::COMPONENT_MULTIPLE_TAG_EVENTS_SIDEBAR => [GD_EM_Module_Processor_CustomSectionSidebarInners::class, GD_EM_Module_Processor_CustomSectionSidebarInners::COMPONENT_MULTIPLE_SIDEBARINNER_TAG_EVENTS],
            self::COMPONENT_MULTIPLE_TAG_PASTEVENTS_SIDEBAR => [GD_EM_Module_Processor_CustomSectionSidebarInners::class, GD_EM_Module_Processor_CustomSectionSidebarInners::COMPONENT_MULTIPLE_SIDEBARINNER_TAG_PASTEVENTS],
            self::COMPONENT_MULTIPLE_SINGLE_EVENT_SIDEBAR => [PoP_Events_Module_Processor_CustomSidebarDataloads::class, PoP_Events_Module_Processor_CustomSidebarDataloads::COMPONENT_DATALOAD_SINGLE_EVENT_SIDEBAR],
            self::COMPONENT_MULTIPLE_SINGLE_PASTEVENT_SIDEBAR => [PoP_Events_Module_Processor_CustomSidebarDataloads::class, PoP_Events_Module_Processor_CustomSidebarDataloads::COMPONENT_DATALOAD_SINGLE_PASTEVENT_SIDEBAR],
        );
        if ($block = $blocks[$component->name] ?? null) {
            $ret[] = $block;
        } else {
            switch ($component->name) {
                case self::COMPONENT_MULTIPLE_AUTHOREVENTS_SIDEBAR:
                case self::COMPONENT_MULTIPLE_AUTHORPASTEVENTS_SIDEBAR:
                case self::COMPONENT_MULTIPLE_AUTHOREVENTSCALENDAR_SIDEBAR:
                    $author = \PoP\Root\App::getState(['routing', 'queried-object-id']);
                    $filters = array(
                        self::COMPONENT_MULTIPLE_AUTHOREVENTS_SIDEBAR => [GD_EM_Module_Processor_CustomSectionSidebarInners::class, GD_EM_Module_Processor_CustomSectionSidebarInners::COMPONENT_MULTIPLE_SIDEBARINNER_SECTION_AUTHOREVENTS],
                        self::COMPONENT_MULTIPLE_AUTHORPASTEVENTS_SIDEBAR => [GD_EM_Module_Processor_CustomSectionSidebarInners::class, GD_EM_Module_Processor_CustomSectionSidebarInners::COMPONENT_MULTIPLE_SIDEBARINNER_SECTION_AUTHORPASTEVENTS],
                        self::COMPONENT_MULTIPLE_AUTHOREVENTSCALENDAR_SIDEBAR => [GD_EM_Module_Processor_CustomSectionSidebarInners::class, GD_EM_Module_Processor_CustomSectionSidebarInners::COMPONENT_MULTIPLE_SIDEBARINNER_SECTION_AUTHOREVENTSCALENDAR],
                    );
                    $ret[] = $filters[$component->name];

                    // Allow User Role Editor to add blocks specific to that user role
                    $ret = \PoP\Root\App::applyFilters(
                        'PoP_EM_Module_Processor_SidebarMultiples:inner-modules',
                        $ret,
                        $author
                    );
                    break;
            }
        }

        return $ret;
    }

    public function getScreen(\PoP\ComponentModel\Component\Component $component)
    {
        $screens = array(
            self::COMPONENT_MULTIPLE_SECTION_EVENTS_CALENDAR_SIDEBAR => POP_SCREEN_SECTIONCALENDAR,
            self::COMPONENT_MULTIPLE_SECTION_EVENTS_SIDEBAR => POP_SCREEN_SECTION,
            self::COMPONENT_MULTIPLE_SECTION_PASTEVENTS_SIDEBAR => POP_SCREEN_SECTION,
            self::COMPONENT_MULTIPLE_TAG_EVENTS_CALENDAR_SIDEBAR => POP_SCREEN_TAGSECTIONCALENDAR,
            self::COMPONENT_MULTIPLE_TAG_EVENTS_SIDEBAR => POP_SCREEN_TAGSECTION,
            self::COMPONENT_MULTIPLE_TAG_PASTEVENTS_SIDEBAR => POP_SCREEN_TAGSECTION,
            self::COMPONENT_MULTIPLE_SINGLE_EVENT_SIDEBAR => POP_SCREEN_SINGLE,
            self::COMPONENT_MULTIPLE_SINGLE_PASTEVENT_SIDEBAR => POP_SCREEN_SINGLE,
            self::COMPONENT_MULTIPLE_AUTHOREVENTS_SIDEBAR => POP_SCREEN_AUTHORSECTION,
            self::COMPONENT_MULTIPLE_AUTHORPASTEVENTS_SIDEBAR => POP_SCREEN_AUTHORSECTION,
            self::COMPONENT_MULTIPLE_AUTHOREVENTSCALENDAR_SIDEBAR => POP_SCREEN_AUTHORSECTIONCALENDAR,
        );
        if ($screen = $screens[$component->name] ?? null) {
            return $screen;
        }

        return parent::getScreen($component);
    }

    public function getScreengroup(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_MULTIPLE_SECTION_EVENTS_CALENDAR_SIDEBAR:
            case self::COMPONENT_MULTIPLE_SECTION_EVENTS_SIDEBAR:
            case self::COMPONENT_MULTIPLE_SECTION_PASTEVENTS_SIDEBAR:
            case self::COMPONENT_MULTIPLE_TAG_EVENTS_CALENDAR_SIDEBAR:
            case self::COMPONENT_MULTIPLE_TAG_EVENTS_SIDEBAR:
            case self::COMPONENT_MULTIPLE_TAG_PASTEVENTS_SIDEBAR:
            case self::COMPONENT_MULTIPLE_SINGLE_EVENT_SIDEBAR:
            case self::COMPONENT_MULTIPLE_SINGLE_PASTEVENT_SIDEBAR:
            case self::COMPONENT_MULTIPLE_AUTHOREVENTS_SIDEBAR:
            case self::COMPONENT_MULTIPLE_AUTHORPASTEVENTS_SIDEBAR:
            case self::COMPONENT_MULTIPLE_AUTHOREVENTSCALENDAR_SIDEBAR:
                return POP_SCREENGROUP_CONTENTREAD;
        }

        return parent::getScreengroup($component);
    }

    public function initWebPlatformModelProps(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_MULTIPLE_SINGLE_EVENT_SIDEBAR:
            case self::COMPONENT_MULTIPLE_SINGLE_PASTEVENT_SIDEBAR:
                $inners = array(
                    self::COMPONENT_MULTIPLE_SINGLE_EVENT_SIDEBAR => [PoP_Events_Module_Processor_CustomSidebarDataloads::class, PoP_Events_Module_Processor_CustomSidebarDataloads::COMPONENT_DATALOAD_SINGLE_EVENT_SIDEBAR],
                    self::COMPONENT_MULTIPLE_SINGLE_PASTEVENT_SIDEBAR => [PoP_Events_Module_Processor_CustomSidebarDataloads::class, PoP_Events_Module_Processor_CustomSidebarDataloads::COMPONENT_DATALOAD_SINGLE_PASTEVENT_SIDEBAR],
                );
                $subcomponent = $inners[$component->name];

                // Comment Leo 10/12/2016: in the past, we did .active, however that doesn't work anymore for when alt+click to open a link, instead must pick the last added .tab-pane with selector "last-child"
                $mainblock_taget = '#'.POP_COMPONENTID_PAGESECTIONCONTAINERID_BODY.' .pop-pagesection-page.toplevel:last-child > .blockgroup-singlepost > .blocksection-extensions > .pop-block > .blocksection-inners .content-single';

                // Make the block be collapsible, open it when the main feed is reached, with waypoints
                $this->appendProp([$subcomponent], $props, 'class', 'collapse');
                $this->mergeProp(
                    [$subcomponent],
                    $props,
                    'params',
                    array(
                        'data-collapse-target' => $mainblock_taget
                    )
                );
                $this->mergeJsmethodsProp([$subcomponent], $props, array('waypointsToggleCollapse'));
                break;
        }

        parent::initWebPlatformModelProps($component, $props);
    }
}


