<?php
use PoP\Root\Facades\Translation\TranslationAPIFacade;

class PoP_Module_Processor_FeedButtons extends PoP_Module_Processor_ButtonsBase
{
    public final const COMPONENT_BUTTON_TOGGLEUSERPOSTACTIVITY = 'button-toggleuserpostactivity';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_BUTTON_TOGGLEUSERPOSTACTIVITY,
        );
    }

    public function getButtoninnerSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        $buttoninners = array(
            self::COMPONENT_BUTTON_TOGGLEUSERPOSTACTIVITY => [PoP_Module_Processor_FeedButtonInners::class, PoP_Module_Processor_FeedButtonInners::COMPONENT_BUTTONINNER_TOGGLEUSERPOSTACTIVITY],
        );
        if ($buttoninner = $buttoninners[$component->name] ?? null) {
            return $buttoninner;
        }

        return parent::getButtoninnerSubcomponent($component);
    }

    public function getTitle(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_BUTTON_TOGGLEUSERPOSTACTIVITY:
                return TranslationAPIFacade::getInstance()->__('Comments, responses and highlights', 'poptheme-wassup');
        }

        return parent::getTitle($component, $props);
    }

    public function getBtnClass(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        $ret = parent::getBtnClass($component, $props);

        switch ($component->name) {
            case self::COMPONENT_BUTTON_TOGGLEUSERPOSTACTIVITY:
                $ret .= ' btn btn-default';
                break;
        }

        return $ret;
    }

    public function getUrlField(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_BUTTON_TOGGLEUSERPOSTACTIVITY:
                // We use the "previouscomponents-ids" to obtain the url to point to
                return null;
        }

        return parent::getUrlField($component);
    }

    public function initModelProps(\PoP\ComponentModel\Component\Component $component, array &$props): void
    {
        switch ($component->name) {
            case self::COMPONENT_BUTTON_TOGGLEUSERPOSTACTIVITY:
                $this->appendProp($component, $props, 'class', 'pop-collapse-btn');

                if ($collapse_component = $this->getProp($component, $props, 'target-component')) {
                    $this->mergeProp(
                        $component,
                        $props,
                        'previouscomponents-ids',
                        array(
                            'href' => $collapse_component,
                        )
                    );
                    $this->mergeProp(
                        $component,
                        $props,
                        'params',
                        array(
                            'data-toggle' => 'collapse',
                        )
                    );
                }
                break;
        }

        parent::initModelProps($component, $props);
    }
}


