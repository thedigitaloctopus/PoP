<?php

class PoP_ContentPostLinksCreation_Module_Processor_CustomScrolls extends PoP_Module_Processor_ScrollsBase
{
    public final const COMPONENT_SCROLL_MYLINKS_SIMPLEVIEWPREVIEW = 'scroll-mylinks-simpleviewpreview';
    public final const COMPONENT_SCROLL_MYLINKS_FULLVIEWPREVIEW = 'scroll-mylinks-fullviewpreview';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_SCROLL_MYLINKS_SIMPLEVIEWPREVIEW,
            self::COMPONENT_SCROLL_MYLINKS_FULLVIEWPREVIEW,
        );
    }


    public function getInnerSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        $inners = array(
            self::COMPONENT_SCROLL_MYLINKS_SIMPLEVIEWPREVIEW => [PoP_ContentPostLinksCreation_Module_Processor_CustomScrollInners::class, PoP_ContentPostLinksCreation_Module_Processor_CustomScrollInners::COMPONENT_SCROLLINNER_MYLINKS_SIMPLEVIEWPREVIEW],
            self::COMPONENT_SCROLL_MYLINKS_FULLVIEWPREVIEW => [PoP_ContentPostLinksCreation_Module_Processor_CustomScrollInners::class, PoP_ContentPostLinksCreation_Module_Processor_CustomScrollInners::COMPONENT_SCROLLINNER_MYLINKS_FULLVIEWPREVIEW],
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
            self::COMPONENT_SCROLL_MYLINKS_SIMPLEVIEWPREVIEW,
        );
        $fullviews = array(
            self::COMPONENT_SCROLL_MYLINKS_FULLVIEWPREVIEW,
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


