<?php

class PoPThemeWassup_CategoryProcessors_Module_Processor_SectionLatestCounts extends PoP_Module_Processor_SectionLatestCountsBase
{
    public final const COMPONENT_LATESTCOUNT_CATEGORYPOSTS00 = 'latestcount-categoryposts00';
    public final const COMPONENT_LATESTCOUNT_CATEGORYPOSTS01 = 'latestcount-categoryposts01';
    public final const COMPONENT_LATESTCOUNT_CATEGORYPOSTS02 = 'latestcount-categoryposts02';
    public final const COMPONENT_LATESTCOUNT_CATEGORYPOSTS03 = 'latestcount-categoryposts03';
    public final const COMPONENT_LATESTCOUNT_CATEGORYPOSTS04 = 'latestcount-categoryposts04';
    public final const COMPONENT_LATESTCOUNT_CATEGORYPOSTS05 = 'latestcount-categoryposts05';
    public final const COMPONENT_LATESTCOUNT_CATEGORYPOSTS06 = 'latestcount-categoryposts06';
    public final const COMPONENT_LATESTCOUNT_CATEGORYPOSTS07 = 'latestcount-categoryposts07';
    public final const COMPONENT_LATESTCOUNT_CATEGORYPOSTS08 = 'latestcount-categoryposts08';
    public final const COMPONENT_LATESTCOUNT_CATEGORYPOSTS09 = 'latestcount-categoryposts09';
    public final const COMPONENT_LATESTCOUNT_CATEGORYPOSTS10 = 'latestcount-categoryposts10';
    public final const COMPONENT_LATESTCOUNT_CATEGORYPOSTS11 = 'latestcount-categoryposts11';
    public final const COMPONENT_LATESTCOUNT_CATEGORYPOSTS12 = 'latestcount-categoryposts12';
    public final const COMPONENT_LATESTCOUNT_CATEGORYPOSTS13 = 'latestcount-categoryposts13';
    public final const COMPONENT_LATESTCOUNT_CATEGORYPOSTS14 = 'latestcount-categoryposts14';
    public final const COMPONENT_LATESTCOUNT_CATEGORYPOSTS15 = 'latestcount-categoryposts15';
    public final const COMPONENT_LATESTCOUNT_CATEGORYPOSTS16 = 'latestcount-categoryposts16';
    public final const COMPONENT_LATESTCOUNT_CATEGORYPOSTS17 = 'latestcount-categoryposts17';
    public final const COMPONENT_LATESTCOUNT_CATEGORYPOSTS18 = 'latestcount-categoryposts18';
    public final const COMPONENT_LATESTCOUNT_CATEGORYPOSTS19 = 'latestcount-categoryposts19';
    public final const COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS00 = 'latestcount-author-categoryposts00';
    public final const COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS01 = 'latestcount-author-categoryposts01';
    public final const COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS02 = 'latestcount-author-categoryposts02';
    public final const COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS03 = 'latestcount-author-categoryposts03';
    public final const COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS04 = 'latestcount-author-categoryposts04';
    public final const COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS05 = 'latestcount-author-categoryposts05';
    public final const COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS06 = 'latestcount-author-categoryposts06';
    public final const COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS07 = 'latestcount-author-categoryposts07';
    public final const COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS08 = 'latestcount-author-categoryposts08';
    public final const COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS09 = 'latestcount-author-categoryposts09';
    public final const COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS10 = 'latestcount-author-categoryposts10';
    public final const COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS11 = 'latestcount-author-categoryposts11';
    public final const COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS12 = 'latestcount-author-categoryposts12';
    public final const COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS13 = 'latestcount-author-categoryposts13';
    public final const COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS14 = 'latestcount-author-categoryposts14';
    public final const COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS15 = 'latestcount-author-categoryposts15';
    public final const COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS16 = 'latestcount-author-categoryposts16';
    public final const COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS17 = 'latestcount-author-categoryposts17';
    public final const COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS18 = 'latestcount-author-categoryposts18';
    public final const COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS19 = 'latestcount-author-categoryposts19';
    public final const COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS00 = 'latestcount-tag-categoryposts00';
    public final const COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS01 = 'latestcount-tag-categoryposts01';
    public final const COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS02 = 'latestcount-tag-categoryposts02';
    public final const COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS03 = 'latestcount-tag-categoryposts03';
    public final const COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS04 = 'latestcount-tag-categoryposts04';
    public final const COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS05 = 'latestcount-tag-categoryposts05';
    public final const COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS06 = 'latestcount-tag-categoryposts06';
    public final const COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS07 = 'latestcount-tag-categoryposts07';
    public final const COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS08 = 'latestcount-tag-categoryposts08';
    public final const COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS09 = 'latestcount-tag-categoryposts09';
    public final const COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS10 = 'latestcount-tag-categoryposts10';
    public final const COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS11 = 'latestcount-tag-categoryposts11';
    public final const COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS12 = 'latestcount-tag-categoryposts12';
    public final const COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS13 = 'latestcount-tag-categoryposts13';
    public final const COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS14 = 'latestcount-tag-categoryposts14';
    public final const COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS15 = 'latestcount-tag-categoryposts15';
    public final const COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS16 = 'latestcount-tag-categoryposts16';
    public final const COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS17 = 'latestcount-tag-categoryposts17';
    public final const COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS18 = 'latestcount-tag-categoryposts18';
    public final const COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS19 = 'latestcount-tag-categoryposts19';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS00,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS01,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS02,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS03,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS04,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS05,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS06,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS07,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS08,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS09,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS10,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS11,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS12,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS13,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS14,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS15,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS16,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS17,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS18,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS19,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS00,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS01,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS02,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS03,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS04,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS05,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS06,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS07,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS08,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS09,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS10,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS11,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS12,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS13,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS14,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS15,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS16,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS17,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS18,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS19,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS00,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS01,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS02,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS03,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS04,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS05,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS06,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS07,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS08,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS09,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS10,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS11,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS12,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS13,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS14,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS15,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS16,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS17,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS18,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS19,
        );
    }

    public function getObjectName(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        $cats = array(
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS00 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS00,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS01 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS01,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS02 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS02,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS03 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS03,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS04 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS04,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS05 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS05,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS06 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS06,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS07 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS07,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS08 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS08,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS09 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS09,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS10 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS10,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS11 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS11,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS12 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS12,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS13 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS13,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS14 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS14,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS15 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS15,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS16 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS16,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS17 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS17,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS18 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS18,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS19 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS19,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS00 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS00,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS01 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS01,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS02 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS02,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS03 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS03,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS04 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS04,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS05 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS05,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS06 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS06,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS07 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS07,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS08 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS08,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS09 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS09,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS10 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS10,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS11 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS11,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS12 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS12,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS13 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS13,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS14 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS14,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS15 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS15,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS16 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS16,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS17 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS17,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS18 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS18,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS19 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS19,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS00 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS00,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS01 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS01,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS02 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS02,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS03 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS03,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS04 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS04,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS05 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS05,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS06 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS06,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS07 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS07,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS08 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS08,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS09 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS09,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS10 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS10,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS11 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS11,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS12 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS12,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS13 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS13,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS14 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS14,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS15 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS15,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS16 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS16,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS17 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS17,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS18 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS18,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS19 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS19,
        );
        if ($cat = $cats[$component->name] ?? null) {
            return gdGetCategoryname($cat, 'lc');
        }

        return parent::getObjectNames($component, $props);
    }

    public function getObjectNames(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        $cats = array(
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS00 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS00,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS01 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS01,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS02 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS02,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS03 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS03,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS04 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS04,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS05 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS05,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS06 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS06,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS07 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS07,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS08 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS08,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS09 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS09,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS10 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS10,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS11 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS11,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS12 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS12,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS13 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS13,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS14 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS14,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS15 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS15,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS16 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS16,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS17 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS17,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS18 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS18,
            self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS19 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS19,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS00 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS00,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS01 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS01,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS02 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS02,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS03 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS03,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS04 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS04,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS05 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS05,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS06 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS06,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS07 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS07,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS08 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS08,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS09 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS09,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS10 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS10,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS11 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS11,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS12 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS12,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS13 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS13,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS14 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS14,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS15 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS15,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS16 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS16,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS17 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS17,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS18 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS18,
            self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS19 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS19,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS00 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS00,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS01 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS01,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS02 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS02,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS03 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS03,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS04 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS04,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS05 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS05,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS06 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS06,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS07 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS07,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS08 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS08,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS09 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS09,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS10 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS10,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS11 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS11,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS12 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS12,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS13 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS13,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS14 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS14,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS15 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS15,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS16 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS16,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS17 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS17,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS18 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS18,
            self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS19 => POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS19,
        );
        if ($cat = $cats[$component->name] ?? null) {
            return gdGetCategoryname($cat, 'plural-lc');
        }

        return parent::getObjectNames($component, $props);
    }

    public function isAuthor(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS00:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS01:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS02:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS03:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS04:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS05:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS06:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS07:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS08:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS09:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS10:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS11:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS12:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS13:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS14:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS15:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS16:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS17:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS18:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS19:
                return true;
        }

        return parent::isAuthor($component, $props);
    }

    public function isTag(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS00:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS01:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS02:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS03:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS04:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS05:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS06:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS07:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS08:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS09:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS10:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS11:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS12:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS13:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS14:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS15:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS16:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS17:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS18:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS19:
                return true;
        }

        return parent::isTag($component, $props);
    }

    public function getSectionClasses(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        $ret = parent::getSectionClasses($component, $props);

        switch ($component->name) {
            case self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS00:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS00:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS00:
                $ret[] = 'post-'.POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS00;
                break;

            case self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS10:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS10:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS10:
                $ret[] = 'post-'.POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS10;
                break;

            case self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS01:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS01:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS01:
                $ret[] = 'post-'.POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS01;
                break;

            case self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS11:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS11:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS11:
                $ret[] = 'post-'.POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS11;
                break;

            case self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS02:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS02:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS02:
                $ret[] = 'post-'.POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS02;
                break;

            case self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS12:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS12:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS12:
                $ret[] = 'post-'.POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS12;
                break;

            case self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS03:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS03:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS03:
                $ret[] = 'post-'.POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS03;
                break;

            case self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS13:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS13:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS13:
                $ret[] = 'post-'.POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS13;
                break;

            case self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS04:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS04:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS04:
                $ret[] = 'post-'.POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS04;
                break;

            case self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS14:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS14:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS14:
                $ret[] = 'post-'.POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS14;
                break;

            case self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS05:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS05:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS05:
                $ret[] = 'post-'.POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS05;
                break;

            case self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS15:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS15:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS15:
                $ret[] = 'post-'.POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS15;
                break;

            case self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS06:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS06:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS06:
                $ret[] = 'post-'.POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS06;
                break;

            case self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS16:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS16:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS16:
                $ret[] = 'post-'.POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS16;
                break;

            case self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS07:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS07:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS07:
                $ret[] = 'post-'.POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS07;
                break;

            case self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS17:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS17:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS17:
                $ret[] = 'post-'.POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS17;
                break;

            case self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS08:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS08:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS08:
                $ret[] = 'post-'.POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS08;
                break;

            case self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS18:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS18:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS18:
                $ret[] = 'post-'.POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS18;
                break;

            case self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS09:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS09:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS09:
                $ret[] = 'post-'.POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS09;
                break;

            case self::COMPONENT_LATESTCOUNT_CATEGORYPOSTS19:
            case self::COMPONENT_LATESTCOUNT_AUTHOR_CATEGORYPOSTS19:
            case self::COMPONENT_LATESTCOUNT_TAG_CATEGORYPOSTS19:
                $ret[] = 'post-'.POP_CATEGORYPOSTS_CAT_CATEGORYPOSTS19;
                break;
        }

        // Allow to hook in POP_CONTENTPOSTLINKS_CAT_CONTENTPOSTLINKS
        $ret = \PoP\Root\App::applyFilters(
            'latestcounts:categoryposts:classes',
            $ret,
            $component,
            $props
        );

        return $ret;
    }
}


