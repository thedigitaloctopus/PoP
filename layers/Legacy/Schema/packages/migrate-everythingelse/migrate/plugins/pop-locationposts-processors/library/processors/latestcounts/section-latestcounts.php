<?php

class PoPThemeWassup_CommonPages_EM_Module_Processor_SectionLatestCounts extends PoP_Module_Processor_SectionLatestCountsBase
{
    public final const COMPONENT_LATESTCOUNT_LOCATIONPOSTS = 'latestcount-locationposts';
    public final const COMPONENT_LATESTCOUNT_AUTHOR_LOCATIONPOSTS = 'latestcount-author-locationposts';
    public final const COMPONENT_LATESTCOUNT_TAG_LOCATIONPOSTS = 'latestcount-tag-locationposts';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_LATESTCOUNT_LOCATIONPOSTS,
            self::COMPONENT_LATESTCOUNT_AUTHOR_LOCATIONPOSTS,
            self::COMPONENT_LATESTCOUNT_TAG_LOCATIONPOSTS,
        );
    }

    public function getObjectName(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_LATESTCOUNT_LOCATIONPOSTS:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_LOCATIONPOSTS:
            case self::COMPONENT_LATESTCOUNT_TAG_LOCATIONPOSTS:
                return PoP_LocationPosts_PostNameUtils::getNameLc();
        }
    
        return parent::getObjectNames($component, $props);
    }

    public function getObjectNames(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_LATESTCOUNT_LOCATIONPOSTS:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_LOCATIONPOSTS:
            case self::COMPONENT_LATESTCOUNT_TAG_LOCATIONPOSTS:
                return PoP_LocationPosts_PostNameUtils::getNamesLc();
        }
    
        return parent::getObjectNames($component, $props);
    }

    public function getSectionClasses(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        $ret = parent::getSectionClasses($component, $props);

        switch ($component->name) {
            case self::COMPONENT_LATESTCOUNT_LOCATIONPOSTS:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_LOCATIONPOSTS:
            case self::COMPONENT_LATESTCOUNT_TAG_LOCATIONPOSTS:
                $ret[] = POP_LOCATIONPOSTS_POSTTYPE_LOCATIONPOST.'-'.POP_LOCATIONPOSTS_CAT_ALL;
                break;
        }

        // Allow to hook in POP_CONTENTPOSTLINKS_CAT_CONTENTPOSTLINKS
        $ret = \PoP\Root\App::applyFilters(
            'latestcounts:locationposts:classes',
            $ret,
            $component,
            $props
        );
    
        return $ret;
    }

    public function isAuthor(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_LATESTCOUNT_AUTHOR_LOCATIONPOSTS:
                return true;
        }
    
        return parent::isAuthor($component, $props);
    }

    public function isTag(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_LATESTCOUNT_TAG_LOCATIONPOSTS:
                return true;
        }
    
        return parent::isTag($component, $props);
    }
}


