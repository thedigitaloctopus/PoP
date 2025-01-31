<?php
use PoP\Root\Facades\Translation\TranslationAPIFacade;

class PoP_Locations_Module_Processor_CustomAnchorControls extends PoP_Module_Processor_AnchorControlsBase
{
    public final const COMPONENT_ANCHORCONTROL_TOGGLEMAP = 'anchorcontrol-togglemap';
    public final const COMPONENT_ANCHORCONTROL_TOGGLEAUTHORMAP = 'anchorcontrol-toggleauthormap';
    public final const COMPONENT_ANCHORCONTROL_TOGGLETAGMAP = 'anchorcontrol-toggletagmap';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_ANCHORCONTROL_TOGGLEMAP,
            self::COMPONENT_ANCHORCONTROL_TOGGLEAUTHORMAP,
            self::COMPONENT_ANCHORCONTROL_TOGGLETAGMAP,
        );
    }

    public function getLabel(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_ANCHORCONTROL_TOGGLEMAP:
            case self::COMPONENT_ANCHORCONTROL_TOGGLEAUTHORMAP:
            case self::COMPONENT_ANCHORCONTROL_TOGGLETAGMAP:
                return TranslationAPIFacade::getInstance()->__('Toggle Map', 'poptheme-wassup');
        }

        return parent::getLabel($component, $props);
    }
    public function getFontawesome(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_ANCHORCONTROL_TOGGLEMAP:
            case self::COMPONENT_ANCHORCONTROL_TOGGLEAUTHORMAP:
            case self::COMPONENT_ANCHORCONTROL_TOGGLETAGMAP:
                return 'fa-map-marker';
        }

        return parent::getFontawesome($component, $props);
    }
    public function getHref(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_ANCHORCONTROL_TOGGLEMAP:
            case self::COMPONENT_ANCHORCONTROL_TOGGLEAUTHORMAP:
            case self::COMPONENT_ANCHORCONTROL_TOGGLETAGMAP:
                // Assume there is only one .collapse.map in this block
                // return '#'.$props['block-id'].' > .blocksection-inners .collapse.map';
                return $this->getProp($component, $props, 'target');
        }

        return parent::getHref($component, $props);
    }

    public function getJsmethods(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        $ret = parent::getJsmethods($component, $props);

        switch ($component->name) {
            case self::COMPONENT_ANCHORCONTROL_TOGGLEMAP:
            case self::COMPONENT_ANCHORCONTROL_TOGGLEAUTHORMAP:
            case self::COMPONENT_ANCHORCONTROL_TOGGLETAGMAP:
                // It will add class "in" through .js if there is no cookie
                $this->addJsmethod($ret, 'cookieToggleClass');
                break;
        }

        return $ret;
    }

    public function initModelProps(\PoP\ComponentModel\Component\Component $component, array &$props): void
    {
        switch ($component->name) {
            case self::COMPONENT_ANCHORCONTROL_TOGGLEMAP:
            case self::COMPONENT_ANCHORCONTROL_TOGGLEAUTHORMAP:
            case self::COMPONENT_ANCHORCONTROL_TOGGLETAGMAP:
                $this->appendProp($component, $props, 'class', 'pop-togglemap-btn');
                $this->appendProp($component, $props, 'class', 'btn btn-default btn-sm');
                $this->mergeProp(
                    $component,
                    $props,
                    'params',
                    array(
                        'data-toggle' => 'collapse',
                    )
                );
                // Set the params for the cookie
                $this->mergeProp(
                    $component,
                    $props,
                    'params',
                    array(
                        'data-cookieid' => \PoP\ComponentModel\Facades\ComponentHelpers\ComponentHelpersFacade::getInstance()->getComponentFullName($component).'-togglemap',
                        'data-cookietarget' => $this->getProp($component, $props, 'target')/*'#'.$props['block-id'].' > .blocksection-inners .collapse.map'*/,
                        'data-cookiecollapse' => 'show',
                        'data-togglecookiebtn' => 'self',
                    )
                );
                break;
        }

        switch ($component->name) {
         // The map is initially toggled non-visible
            case self::COMPONENT_ANCHORCONTROL_TOGGLEAUTHORMAP:
            case self::COMPONENT_ANCHORCONTROL_TOGGLETAGMAP:
                $this->mergeProp(
                    $component,
                    $props,
                    'params',
                    array(
                        'data-initial' => 'set',
                    )
                );
                break;
        }

        parent::initModelProps($component, $props);
    }
}


