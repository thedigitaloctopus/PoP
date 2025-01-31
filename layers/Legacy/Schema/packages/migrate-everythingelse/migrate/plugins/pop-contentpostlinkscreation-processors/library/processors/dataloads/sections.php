<?php
use PoP\Root\Facades\Translation\TranslationAPIFacade;
use PoPCMSSchema\CustomPosts\TypeResolvers\ObjectType\CustomPostObjectTypeResolver;

class PoP_ContentPostLinksCreation_Module_Processor_MySectionDataloads extends PoP_Module_Processor_MySectionDataloadsBase
{
    public final const COMPONENT_DATALOAD_MYLINKS_TABLE_EDIT = 'dataload-mylinks-table-edit';
    public final const COMPONENT_DATALOAD_MYLINKS_SCROLL_SIMPLEVIEWPREVIEW = 'dataload-mylinks-scroll-simpleviewpreview';
    public final const COMPONENT_DATALOAD_MYLINKS_SCROLL_FULLVIEWPREVIEW = 'dataload-mylinks-scroll-fullviewpreview';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_DATALOAD_MYLINKS_TABLE_EDIT,
            self::COMPONENT_DATALOAD_MYLINKS_SCROLL_SIMPLEVIEWPREVIEW,
            self::COMPONENT_DATALOAD_MYLINKS_SCROLL_FULLVIEWPREVIEW,
        );
    }

    public function getRelevantRoute(\PoP\ComponentModel\Component\Component $component, array &$props): ?string
    {
        return match($component->name) {
            self::COMPONENT_DATALOAD_MYLINKS_SCROLL_FULLVIEWPREVIEW => POP_CONTENTPOSTLINKSCREATION_ROUTE_MYCONTENTPOSTLINKS,
            self::COMPONENT_DATALOAD_MYLINKS_SCROLL_SIMPLEVIEWPREVIEW => POP_CONTENTPOSTLINKSCREATION_ROUTE_MYCONTENTPOSTLINKS,
            self::COMPONENT_DATALOAD_MYLINKS_TABLE_EDIT => POP_CONTENTPOSTLINKSCREATION_ROUTE_MYCONTENTPOSTLINKS,
            default => parent::getRelevantRoute($component, $props),
        };
    }

    public function getInnerSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        $inner_components = array(

        /*********************************************
         * My Content Tables
         *********************************************/
            self::COMPONENT_DATALOAD_MYLINKS_TABLE_EDIT => [PoP_ContentPostLinksCreation_Module_Processor_Tables::class, PoP_ContentPostLinksCreation_Module_Processor_Tables::COMPONENT_TABLE_MYLINKS],

        /*********************************************
         * My Content Full Post Previews
         *********************************************/
            self::COMPONENT_DATALOAD_MYLINKS_SCROLL_SIMPLEVIEWPREVIEW => [PoP_ContentPostLinksCreation_Module_Processor_CustomScrolls::class, PoP_ContentPostLinksCreation_Module_Processor_CustomScrolls::COMPONENT_SCROLL_MYLINKS_SIMPLEVIEWPREVIEW],
            self::COMPONENT_DATALOAD_MYLINKS_SCROLL_FULLVIEWPREVIEW => [PoP_ContentPostLinksCreation_Module_Processor_CustomScrolls::class, PoP_ContentPostLinksCreation_Module_Processor_CustomScrolls::COMPONENT_SCROLL_MYLINKS_FULLVIEWPREVIEW],
        );

        return $inner_components[$component->name] ?? null;
    }

    public function getFilterSubcomponent(\PoP\ComponentModel\Component\Component $component): ?\PoP\ComponentModel\Component\Component
    {
        switch ($component->name) {
            case self::COMPONENT_DATALOAD_MYLINKS_TABLE_EDIT:
            case self::COMPONENT_DATALOAD_MYLINKS_SCROLL_SIMPLEVIEWPREVIEW:
            case self::COMPONENT_DATALOAD_MYLINKS_SCROLL_FULLVIEWPREVIEW:
                return [PoP_ContentPostLinksCreation_Module_Processor_CustomFilters::class, PoP_ContentPostLinksCreation_Module_Processor_CustomFilters::COMPONENT_FILTER_MYLINKS];
        }

        return parent::getFilterSubcomponent($component);
    }

    public function getFormat(\PoP\ComponentModel\Component\Component $component): ?string
    {

        // Add the format attr
        $tables = array(
            self::COMPONENT_DATALOAD_MYLINKS_TABLE_EDIT,
        );
        $simpleviews = array(
            self::COMPONENT_DATALOAD_MYLINKS_SCROLL_SIMPLEVIEWPREVIEW,
        );
        $fullviews = array(
            self::COMPONENT_DATALOAD_MYLINKS_SCROLL_FULLVIEWPREVIEW,
        );
        if (in_array($component, $tables)) {
            $format = POP_FORMAT_TABLE;
        } elseif (in_array($component, $fullviews)) {
            $format = POP_FORMAT_FULLVIEW;
        } elseif (in_array($component, $simpleviews)) {
            $format = POP_FORMAT_SIMPLEVIEW;
        }

        return $format ?? parent::getFormat($component);
    }

    protected function getImmutableDataloadQueryArgs(\PoP\ComponentModel\Component\Component $component, array &$props): array
    {
        $ret = parent::getImmutableDataloadQueryArgs($component, $props);

        switch ($component->name) {
            case self::COMPONENT_DATALOAD_MYLINKS_TABLE_EDIT:
            case self::COMPONENT_DATALOAD_MYLINKS_SCROLL_SIMPLEVIEWPREVIEW:
            case self::COMPONENT_DATALOAD_MYLINKS_SCROLL_FULLVIEWPREVIEW:
                $ret['categories'] = [POP_CONTENTPOSTLINKS_CAT_CONTENTPOSTLINKS];
                break;
        }

        return $ret;
    }

    public function getRelationalTypeResolver(\PoP\ComponentModel\Component\Component $component): ?\PoP\ComponentModel\TypeResolvers\RelationalTypeResolverInterface
    {
        switch ($component->name) {
            case self::COMPONENT_DATALOAD_MYLINKS_TABLE_EDIT:
            case self::COMPONENT_DATALOAD_MYLINKS_SCROLL_SIMPLEVIEWPREVIEW:
            case self::COMPONENT_DATALOAD_MYLINKS_SCROLL_FULLVIEWPREVIEW:
                return $this->instanceManager->getInstance(CustomPostObjectTypeResolver::class);
        }

        return parent::getRelationalTypeResolver($component);
    }

    public function initModelProps(\PoP\ComponentModel\Component\Component $component, array &$props): void
    {
        switch ($component->name) {
            case self::COMPONENT_DATALOAD_MYLINKS_TABLE_EDIT:
            case self::COMPONENT_DATALOAD_MYLINKS_SCROLL_SIMPLEVIEWPREVIEW:
            case self::COMPONENT_DATALOAD_MYLINKS_SCROLL_FULLVIEWPREVIEW:
                $this->setProp([PoP_Module_Processor_DomainFeedbackMessageLayouts::class, PoP_Module_Processor_DomainFeedbackMessageLayouts::COMPONENT_LAYOUT_FEEDBACKMESSAGE_ITEMLIST], $props, 'pluralname', TranslationAPIFacade::getInstance()->__('links', 'poptheme-wassup'));
                $this->setProp([GD_UserLogin_Module_Processor_UserCheckpointMessageLayouts::class, GD_UserLogin_Module_Processor_UserCheckpointMessageLayouts::COMPONENT_LAYOUT_CHECKPOINTMESSAGE_LOGGEDIN], $props, 'action', TranslationAPIFacade::getInstance()->__('access your links', 'poptheme-wassup'));
                break;
        }
        parent::initModelProps($component, $props);
    }
}



