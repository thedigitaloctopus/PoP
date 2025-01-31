<?php

use PoP\ComponentRouting\Facades\ComponentRoutingProcessorManagerFacade;

class PoP_Module_Processor_Entries extends PoP_Module_Processor_MultiplesBase
{
    public final const COMPONENT_ENTRY_DEFAULT = 'entry-default';
    public final const COMPONENT_ENTRY_PRINT = 'entry-print';
    public final const COMPONENT_ENTRY_EMBED = 'entry-embed';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_ENTRY_DEFAULT,
            self::COMPONENT_ENTRY_PRINT,
            self::COMPONENT_ENTRY_EMBED,
        );
    }

    /**
     * @return \PoP\ComponentModel\Component\Component[]
     */
    public function getSubcomponents(\PoP\ComponentModel\Component\Component $component): array
    {
        switch ($component->name) {
            case self::COMPONENT_ENTRY_DEFAULT:
                return array(
                    [PoP_Module_Processor_Offcanvas::class, PoP_Module_Processor_Offcanvas::COMPONENT_OFFCANVAS_TOP],
                    [PoP_Module_Processor_Offcanvas::class, PoP_Module_Processor_Offcanvas::COMPONENT_OFFCANVAS_SIDE],
                    [PoP_Module_Processor_Offcanvas::class, PoP_Module_Processor_Offcanvas::COMPONENT_OFFCANVAS_BACKGROUND],
                    [PoP_Module_Processor_Offcanvas::class, PoP_Module_Processor_Offcanvas::COMPONENT_OFFCANVAS_HOVER],
                    [PoP_Module_Processor_Offcanvas::class, PoP_Module_Processor_Offcanvas::COMPONENT_OFFCANVAS_NAVIGATOR],
                    [PoP_Module_Processor_PageSectionContainers::class, PoP_Module_Processor_PageSectionContainers::COMPONENT_PAGESECTIONCONTAINER_HOLE],
                    [PoP_Module_Processor_PageSections::class, PoP_Module_Processor_PageSections::COMPONENT_PAGESECTION_FRAMECOMPONENTS],
                    [PoP_Module_Processor_Offcanvas::class, PoP_Module_Processor_Offcanvas::COMPONENT_OFFCANVAS_BODY],
                    [PoP_Module_Processor_Offcanvas::class, PoP_Module_Processor_Offcanvas::COMPONENT_OFFCANVAS_BODYTABS],
                    [PoP_Module_Processor_Offcanvas::class, PoP_Module_Processor_Offcanvas::COMPONENT_OFFCANVAS_BODYSIDEINFO],
                    [PoP_Module_Processor_Windows::class, PoP_Module_Processor_Windows::COMPONENT_WINDOW_ADDONS],
                    [PoP_Module_Processor_PageSectionContainers::class, PoP_Module_Processor_PageSectionContainers::COMPONENT_PAGESECTIONCONTAINER_MODALS],
                    [PoP_Module_Processor_Modals::class, PoP_Module_Processor_Modals::COMPONENT_MODAL_QUICKVIEW],
                );

            case self::COMPONENT_ENTRY_PRINT:
                // Load all 3 pageSections (even if only 1 will show content) to guarantee that all pages are printable,
                // since all pages by default will open on 1 of these 3 (eg: https://getpop.org/en/log-in/?thememode=print opens in HOVER)
                // Adding target="addons" will not work any longer, however there is no link to print/embed anything with a target
                return array(
                    [PoP_Module_Processor_Offcanvas::class, PoP_Module_Processor_Offcanvas::COMPONENT_OFFCANVAS_HOVER],
                    [PoP_Module_Processor_PageSectionContainers::class, PoP_Module_Processor_PageSectionContainers::COMPONENT_PAGESECTIONCONTAINER_HOLE],
                    [PoP_Module_Processor_Offcanvas::class, PoP_Module_Processor_Offcanvas::COMPONENT_OFFCANVAS_BODY],
                );

            case self::COMPONENT_ENTRY_EMBED:
                return array(
                    [PoP_Module_Processor_Offcanvas::class, PoP_Module_Processor_Offcanvas::COMPONENT_OFFCANVAS_TOP],
                    [PoP_Module_Processor_Offcanvas::class, PoP_Module_Processor_Offcanvas::COMPONENT_OFFCANVAS_HOVER],
                    [PoP_Module_Processor_PageSectionContainers::class, PoP_Module_Processor_PageSectionContainers::COMPONENT_PAGESECTIONCONTAINER_HOLE],
                    [PoP_Module_Processor_Offcanvas::class, PoP_Module_Processor_Offcanvas::COMPONENT_OFFCANVAS_BODY],
                );
        }

        return parent::getSubcomponents($component);
    }

    public function initModelProps(\PoP\ComponentModel\Component\Component $component, array &$props): void
    {
        switch ($component->name) {
            case self::COMPONENT_ENTRY_DEFAULT:
            case self::COMPONENT_ENTRY_PRINT:
            case self::COMPONENT_ENTRY_EMBED:
                $this->appendProp($component, $props, 'class', 'pop-pagesection-group pagesection-group');

                $active_pagesections = array(
                    self::COMPONENT_ENTRY_DEFAULT => array('active-top', 'active-side'),
                    self::COMPONENT_ENTRY_EMBED => array('active-top'),
                );
                if ($active_pagesections[$component->name] ?? null) {
                    $this->appendProp($component, $props, 'class', implode(' ', PoPThemeWassup_Utils::getPagesectiongroupActivePagesectionClasses($active_pagesections[$component->name] ?? null)));
                }

                // When loading the whole site, only the main pageSection can have components retrieve params from the $_GET
                // This way, passing &limit=4 doesn't affect the results on the widgets
                $pop_component_componentroutingprocessor_manager = ComponentRoutingProcessorManagerFacade::getInstance();
                $subcomponents = array_diff(
                    $this->getSubcomponents($component),
                    [
                        $pop_component_componentroutingprocessor_manager->getRoutingComponentByMostAllMatchingStateProperties(POP_PAGECOMPONENTGROUP_TOPLEVEL_CONTENTPAGESECTION)
                    ]
                );
                foreach ($subcomponents as $subcomponent) {
                    $this->setProp($subcomponent, $props, 'ignore-request-params', true);
                }
                break;
        }

        parent::initModelProps($component, $props);
    }
}


