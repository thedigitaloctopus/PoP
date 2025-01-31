<?php
use PoP\Root\Facades\Translation\TranslationAPIFacade;

class PoP_Module_Processor_CustomPreviewPostLayouts extends PoP_Module_Processor_CustomPreviewPostLayoutsBase
{
    public final const COMPONENT_LAYOUT_PREVIEWPOST_HEADER = 'layout-previewpost-header';
    public final const COMPONENT_LAYOUT_PREVIEWPOST_NAVIGATOR = 'layout-previewpost-navigator';
    public final const COMPONENT_LAYOUT_PREVIEWPOST_ADDONS = 'layout-previewpost-addons';
    public final const COMPONENT_LAYOUT_PREVIEWPOST_DETAILS = 'layout-previewpost-details';
    public final const COMPONENT_LAYOUT_PREVIEWPOST_THUMBNAIL = 'layout-previewpost-thumbnail';
    public final const COMPONENT_LAYOUT_PREVIEWPOST_LIST = 'layout-previewpost-list';
    public final const COMPONENT_LAYOUT_PREVIEWPOST_LINE = 'layout-previewpost-line';
    public final const COMPONENT_LAYOUT_PREVIEWPOST_RELATED = 'layout-previewpost-related';
    public final const COMPONENT_LAYOUT_PREVIEWPOST_EDIT = 'layout-previewpost-edit';
    public final const COMPONENT_LAYOUT_PREVIEWPOST_HIGHLIGHT_CONTENT = 'layout-previewpost-highlight-content';
    public final const COMPONENT_LAYOUT_PREVIEWPOST_HIGHLIGHT_EDIT = 'layout-previewpost-highlight-edit';
    public final const COMPONENT_LAYOUT_PREVIEWPOST_POST_NAVIGATOR = 'layout-previewpost-post-navigator';
    public final const COMPONENT_LAYOUT_PREVIEWPOST_POST_THUMBNAIL = 'layout-previewpost-post-thumbnail';
    public final const COMPONENT_LAYOUT_PREVIEWPOST_POST_ADDONS = 'layout-previewpost-post-addons';
    public final const COMPONENT_LAYOUT_PREVIEWPOST_POST_DETAILS = 'layout-previewpost-post-details';
    public final const COMPONENT_LAYOUT_PREVIEWPOST_POST_LIST = 'layout-previewpost-post-list';
    public final const COMPONENT_LAYOUT_PREVIEWPOST_POST_RELATED = 'layout-previewpost-post-related';
    public final const COMPONENT_LAYOUT_PREVIEWPOST_POST_EDIT = 'layout-previewpost-post-edit';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_LAYOUT_PREVIEWPOST_HEADER,

            self::COMPONENT_LAYOUT_PREVIEWPOST_NAVIGATOR,
            self::COMPONENT_LAYOUT_PREVIEWPOST_ADDONS,
            self::COMPONENT_LAYOUT_PREVIEWPOST_DETAILS,
            self::COMPONENT_LAYOUT_PREVIEWPOST_THUMBNAIL,
            self::COMPONENT_LAYOUT_PREVIEWPOST_LIST,
            self::COMPONENT_LAYOUT_PREVIEWPOST_LINE,
            self::COMPONENT_LAYOUT_PREVIEWPOST_RELATED,
            self::COMPONENT_LAYOUT_PREVIEWPOST_EDIT,

            self::COMPONENT_LAYOUT_PREVIEWPOST_HIGHLIGHT_CONTENT,
            self::COMPONENT_LAYOUT_PREVIEWPOST_HIGHLIGHT_EDIT,

            self::COMPONENT_LAYOUT_PREVIEWPOST_POST_NAVIGATOR,
            self::COMPONENT_LAYOUT_PREVIEWPOST_POST_THUMBNAIL,
            self::COMPONENT_LAYOUT_PREVIEWPOST_POST_ADDONS,
            self::COMPONENT_LAYOUT_PREVIEWPOST_POST_DETAILS,
            self::COMPONENT_LAYOUT_PREVIEWPOST_POST_LIST,
            self::COMPONENT_LAYOUT_PREVIEWPOST_POST_RELATED,
            self::COMPONENT_LAYOUT_PREVIEWPOST_POST_EDIT,
        );
    }

    public function getUrlField(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_LAYOUT_PREVIEWPOST_EDIT:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_HIGHLIGHT_EDIT:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_EDIT:
                return 'editURL';
        }

        return parent::getUrlField($component);
    }

    public function getLinktarget(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_LAYOUT_PREVIEWPOST_EDIT:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_HIGHLIGHT_EDIT:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_EDIT:
                if (PoP_Application_Utils::getAddcontentTarget() == POP_TARGET_ADDONS) {
                    return POP_TARGET_ADDONS;
                }
                break;
        }

        return parent::getLinktarget($component, $props);
    }

    public function getQuicklinkgroupBottomSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_LAYOUT_PREVIEWPOST_EDIT:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_EDIT:
                return [PoP_Module_Processor_CustomQuicklinkGroups::class, PoP_Module_Processor_CustomQuicklinkGroups::COMPONENT_QUICKLINKGROUP_POSTEDIT];

            case self::COMPONENT_LAYOUT_PREVIEWPOST_HIGHLIGHT_EDIT:
                return [PoP_AddHighlights_Module_Processor_CustomQuicklinkGroups::class, PoP_AddHighlights_Module_Processor_CustomQuicklinkGroups::COMPONENT_QUICKLINKGROUP_HIGHLIGHTEDIT];

            case self::COMPONENT_LAYOUT_PREVIEWPOST_HIGHLIGHT_CONTENT:
                return [PoP_AddHighlights_Module_Processor_CustomQuicklinkGroups::class, PoP_AddHighlights_Module_Processor_CustomQuicklinkGroups::COMPONENT_QUICKLINKGROUP_HIGHLIGHTCONTENT];

            case self::COMPONENT_LAYOUT_PREVIEWPOST_DETAILS:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_DETAILS:
                return [PoP_Module_Processor_CustomQuicklinkGroups::class, PoP_Module_Processor_CustomQuicklinkGroups::COMPONENT_QUICKLINKGROUP_POSTBOTTOMEXTENDED];
        }

        return parent::getQuicklinkgroupBottomSubcomponent($component);
    }

    public function showPosttitle(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_LAYOUT_PREVIEWPOST_HIGHLIGHT_CONTENT:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_HIGHLIGHT_EDIT:
                return false;
        }

        return parent::showPosttitle($component);
    }

    public function getContentSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_LAYOUT_PREVIEWPOST_HIGHLIGHT_CONTENT:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_HIGHLIGHT_EDIT:
                return [PoP_Module_Processor_ContentLayouts::class, PoP_Module_Processor_ContentLayouts::COMPONENT_LAYOUT_CONTENT_POSTCOMPACT];
        }

        return parent::getContentSubcomponent($component);
    }

    public function getQuicklinkgroupTopSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_LAYOUT_PREVIEWPOST_NAVIGATOR:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_DETAILS:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_THUMBNAIL:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_LIST:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_RELATED:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_NAVIGATOR:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_DETAILS:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_THUMBNAIL:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_ADDONS:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_LIST:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_RELATED:
                return [PoP_Module_Processor_CustomQuicklinkGroups::class, PoP_Module_Processor_CustomQuicklinkGroups::COMPONENT_QUICKLINKGROUP_POST];
        }

        return parent::getQuicklinkgroupTopSubcomponent($component);
    }

    public function getBottomSubcomponents(\PoP\ComponentModel\Component\Component $component)
    {
        $ret = parent::getBottomSubcomponents($component);

        switch ($component->name) {
            case self::COMPONENT_LAYOUT_PREVIEWPOST_ADDONS:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_LIST:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_RELATED:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_LIST:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_ADDONS:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_RELATED:
                $ret[] = [PoP_Module_Processor_PublishedLayouts::class, PoP_Module_Processor_PublishedLayouts::COMPONENT_LAYOUT_PUBLISHED];
                break;

            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_THUMBNAIL:
                $ret[] = [PoP_Module_Processor_PublishedLayouts::class, PoP_Module_Processor_PublishedLayouts::COMPONENT_LAYOUT_PUBLISHED];
                if (PoP_ApplicationProcessors_Utils::addCategories()) {
                    $ret[] = [Wassup_Module_Processor_WidgetWrappers::class, Wassup_Module_Processor_WidgetWrappers::COMPONENT_LAYOUTWRAPPER_CATEGORIES];
                }
                if (PoP_ApplicationProcessors_Utils::addAppliesto()) {
                    $ret[] = [Wassup_Module_Processor_WidgetWrappers::class, Wassup_Module_Processor_WidgetWrappers::COMPONENT_LAYOUTWRAPPER_APPLIESTO];
                }
                break;

            case self::COMPONENT_LAYOUT_PREVIEWPOST_HIGHLIGHT_EDIT:
                $ret[] = [PoP_Module_Processor_Widgets::class, PoP_Module_Processor_Widgets::COMPONENT_WIDGET_HIGHLIGHTEDPOST_LINE];
                break;

            case self::COMPONENT_LAYOUT_PREVIEWPOST_DETAILS:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_DETAILS:
                $ret = array_merge(
                    $ret,
                    $this->getDetailsfeedBottomSubcomponents($component)
                );
                break;
        }

        return $ret;
    }

    public function getBelowthumbLayoutSubcomponents(\PoP\ComponentModel\Component\Component $component)
    {
        $ret = parent::getBelowthumbLayoutSubcomponents($component);

        switch ($component->name) {
            case self::COMPONENT_LAYOUT_PREVIEWPOST_NAVIGATOR:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_DETAILS:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_THUMBNAIL:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_NAVIGATOR:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_DETAILS:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_THUMBNAIL:
                $ret[] = [PoP_Module_Processor_PublishedLayouts::class, PoP_Module_Processor_PublishedLayouts::COMPONENT_LAYOUT_PUBLISHED];
                if (PoP_ApplicationProcessors_Utils::addCategories()) {
                    $ret[] = [Wassup_Module_Processor_WidgetWrappers::class, Wassup_Module_Processor_WidgetWrappers::COMPONENT_LAYOUTWRAPPER_CATEGORIES];
                }
                if (PoP_ApplicationProcessors_Utils::addAppliesto()) {
                    $ret[] = [Wassup_Module_Processor_WidgetWrappers::class, Wassup_Module_Processor_WidgetWrappers::COMPONENT_LAYOUTWRAPPER_APPLIESTO];
                }
                break;
        }

        return $ret;
    }

    public function getPostThumbSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_LAYOUT_PREVIEWPOST_EDIT:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_EDIT:
                return [GD_Custom_Module_Processor_PostThumbLayouts::class, GD_Custom_Module_Processor_PostThumbLayouts::COMPONENT_LAYOUT_POSTTHUMB_CROPPEDSMALL_EDIT];

            case self::COMPONENT_LAYOUT_PREVIEWPOST_HEADER:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_RELATED:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_LIST:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_ADDONS:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_RELATED:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_LIST:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_ADDONS:
                return [GD_Custom_Module_Processor_PostThumbLayouts::class, GD_Custom_Module_Processor_PostThumbLayouts::COMPONENT_LAYOUT_POSTTHUMB_CROPPEDSMALL];

            case self::COMPONENT_LAYOUT_PREVIEWPOST_LINE:
                return [GD_Custom_Module_Processor_PostThumbLayouts::class, GD_Custom_Module_Processor_PostThumbLayouts::COMPONENT_LAYOUT_POSTTHUMB_XSMALL];

            case self::COMPONENT_LAYOUT_PREVIEWPOST_NAVIGATOR:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_DETAILS:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_THUMBNAIL:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_NAVIGATOR:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_DETAILS:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_THUMBNAIL:
                return [GD_Custom_Module_Processor_PostThumbLayouts::class, GD_Custom_Module_Processor_PostThumbLayouts::COMPONENT_LAYOUT_POSTTHUMB_CROPPEDMEDIUM];

            case self::COMPONENT_LAYOUT_PREVIEWPOST_HIGHLIGHT_CONTENT:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_HIGHLIGHT_EDIT:
                return null;
        }

        return parent::getPostThumbSubcomponent($component);
    }

    public function showExcerpt(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_LAYOUT_PREVIEWPOST_DETAILS:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_DETAILS:
                return true;
        }

        return parent::showExcerpt($component);
    }

    public function getTitleHtmlmarkup(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_LAYOUT_PREVIEWPOST_DETAILS:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_DETAILS:
                return 'h3';

            case self::COMPONENT_LAYOUT_PREVIEWPOST_LINE:
                return 'span';
        }

        return parent::getTitleHtmlmarkup($component, $props);
    }

    public function getAuthorAvatarComponent(\PoP\ComponentModel\Component\Component $component)
    {
        if (defined('POP_AVATARPROCESSORS_INITIALIZED')) {
            switch ($component->name) {
                case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_ADDONS:
                case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_LIST:
                case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_NAVIGATOR:
                case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_THUMBNAIL:
                case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_RELATED:
                    return [PoP_Module_Processor_PostAuthorAvatarLayouts::class, PoP_Module_Processor_PostAuthorAvatarLayouts::COMPONENT_LAYOUTPOST_AUTHORAVATAR];
            }
        }

        return parent::getAuthorAvatarComponent($component);
    }

    public function authorPositions(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_LAYOUT_PREVIEWPOST_NAVIGATOR:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_ADDONS:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_RELATED:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_DETAILS:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_THUMBNAIL:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_LIST:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_NAVIGATOR:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_THUMBNAIL:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_DETAILS:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_RELATED:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_ADDONS:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_LIST:
                return array(
                    GD_CONSTANT_AUTHORPOSITION_ABOVETITLE
                );

            case self::COMPONENT_LAYOUT_PREVIEWPOST_HIGHLIGHT_CONTENT:
                return array(
                    GD_CONSTANT_AUTHORPOSITION_BELOWCONTENT
                );

            case self::COMPONENT_LAYOUT_PREVIEWPOST_HEADER:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_EDIT:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_HIGHLIGHT_EDIT:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_HIGHLIGHT_CONTENT:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_EDIT:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_LINE:
                return array();
        }

        return parent::authorPositions($component);
    }

    public function horizontalLayout(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_LAYOUT_PREVIEWPOST_DETAILS:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_DETAILS:
                return true;
        }

        return parent::horizontalLayout($component);
    }

    public function horizontalMediaLayout(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_LAYOUT_PREVIEWPOST_HEADER:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_RELATED:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_EDIT:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_LIST:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_ADDONS:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_LINE:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_RELATED:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_ADDONS:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_LIST:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_EDIT:
                return true;
        }

        return parent::horizontalMediaLayout($component);
    }

    public function getImmutableConfiguration(\PoP\ComponentModel\Component\Component $component, array &$props): array
    {
        $ret = parent::getImmutableConfiguration($component, $props);

        switch ($component->name) {
            case self::COMPONENT_LAYOUT_PREVIEWPOST_HIGHLIGHT_CONTENT:
                $ret[GD_JS_CLASSES]['authors'] = 'pull-right authors-bottom';
                break;
        }

        switch ($component->name) {
            case self::COMPONENT_LAYOUT_PREVIEWPOST_NAVIGATOR:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_DETAILS:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_THUMBNAIL:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_NAVIGATOR:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_DETAILS:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_THUMBNAIL:
                $ret[GD_JS_CLASSES]['belowthumb'] = 'bg-info text-info belowthumb';
                break;

            case self::COMPONENT_LAYOUT_PREVIEWPOST_HIGHLIGHT_EDIT:
                $ret[GD_JS_CLASSES]['content'] = 'well';
                break;
        }

        switch ($component->name) {
            case self::COMPONENT_LAYOUT_PREVIEWPOST_DETAILS:
            case self::COMPONENT_LAYOUT_PREVIEWPOST_POST_DETAILS:
                $ret[GD_JS_CLASSES]['thumb'] = 'pop-thumb-framed';
                break;
        }

        return $ret;
    }

    public function getTitleBeforeauthors(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_LAYOUT_PREVIEWPOST_HIGHLIGHT_CONTENT:
                return array(
                    'belowcontent' => TranslationAPIFacade::getInstance()->__('added by', 'poptheme-wassup')
                );
        }

        return parent::getTitleBeforeauthors($component, $props);
    }

    public function initModelProps(\PoP\ComponentModel\Component\Component $component, array &$props): void
    {
        switch ($component->name) {
            case self::COMPONENT_LAYOUT_PREVIEWPOST_HEADER:
                $this->appendProp($component, $props, 'class', 'alert alert-info alert-sm');
                break;

            case self::COMPONENT_LAYOUT_PREVIEWPOST_HIGHLIGHT_CONTENT:
                $this->appendProp($component, $props, 'class', 'well well-highlight');
                break;
        }

        parent::initModelProps($component, $props);
    }
}


