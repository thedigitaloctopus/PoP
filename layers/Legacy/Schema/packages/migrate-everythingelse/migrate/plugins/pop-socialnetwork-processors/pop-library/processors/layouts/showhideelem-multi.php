<?php

class PoP_Module_Processor_ShowHideElemMultiStyleLayouts extends PoP_Module_Processor_MultiplesBase
{
    public final const COMPONENT_LAYOUT_FOLLOWUSER_STYLES = 'layout-followuser-styles';
    public final const COMPONENT_LAYOUT_UNFOLLOWUSER_STYLES = 'layout-unfollowuser-styles';
    public final const COMPONENT_LAYOUT_RECOMMENDPOST_STYLES = 'layout-recommendposts-styles';
    public final const COMPONENT_LAYOUT_UNRECOMMENDPOST_STYLES = 'layout-unrecommendposts-styles';
    public final const COMPONENT_LAYOUT_SUBSCRIBETOTAG_STYLES = 'layout-subscribetotag-styles';
    public final const COMPONENT_LAYOUT_UNSUBSCRIBEFROMTAG_STYLES = 'layout-unsubscribefromtag-styles';
    public final const COMPONENT_LAYOUT_UPVOTEPOST_STYLES = 'layout-upvoteposts-styles';
    public final const COMPONENT_LAYOUT_UNDOUPVOTEPOST_STYLES = 'layout-undoupvoteposts-styles';
    public final const COMPONENT_LAYOUT_DOWNVOTEPOST_STYLES = 'layout-downvoteposts-styles';
    public final const COMPONENT_LAYOUT_UNDODOWNVOTEPOST_STYLES = 'layout-undodownvoteposts-styles';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_LAYOUT_FOLLOWUSER_STYLES,
            self::COMPONENT_LAYOUT_UNFOLLOWUSER_STYLES,
            self::COMPONENT_LAYOUT_RECOMMENDPOST_STYLES,
            self::COMPONENT_LAYOUT_UNRECOMMENDPOST_STYLES,
            self::COMPONENT_LAYOUT_SUBSCRIBETOTAG_STYLES,
            self::COMPONENT_LAYOUT_UNSUBSCRIBEFROMTAG_STYLES,
            self::COMPONENT_LAYOUT_UPVOTEPOST_STYLES,
            self::COMPONENT_LAYOUT_UNDOUPVOTEPOST_STYLES,
            self::COMPONENT_LAYOUT_DOWNVOTEPOST_STYLES,
            self::COMPONENT_LAYOUT_UNDODOWNVOTEPOST_STYLES,
        );
    }

    /**
     * @return \PoP\ComponentModel\Component\Component[]
     */
    public function getSubcomponents(\PoP\ComponentModel\Component\Component $component): array
    {
        $ret = parent::getSubcomponents($component);

        switch ($component->name) {
            case self::COMPONENT_LAYOUT_FOLLOWUSER_STYLES:
                $ret[] = [PoP_Module_Processor_FunctionLayouts::class, PoP_Module_Processor_FunctionLayouts::COMPONENT_LAYOUT_FOLLOWUSER_HIDE_STYLES];
                $ret[] = [PoP_Module_Processor_FunctionLayouts::class, PoP_Module_Processor_FunctionLayouts::COMPONENT_LAYOUT_UNFOLLOWUSER_SHOW_STYLES];
                break;

            case self::COMPONENT_LAYOUT_UNFOLLOWUSER_STYLES:
                $ret[] = [PoP_Module_Processor_FunctionLayouts::class, PoP_Module_Processor_FunctionLayouts::COMPONENT_LAYOUT_UNFOLLOWUSER_HIDE_STYLES];
                $ret[] = [PoP_Module_Processor_FunctionLayouts::class, PoP_Module_Processor_FunctionLayouts::COMPONENT_LAYOUT_FOLLOWUSER_SHOW_STYLES];
                break;

            case self::COMPONENT_LAYOUT_RECOMMENDPOST_STYLES:
                $ret[] = [PoP_Module_Processor_FunctionLayouts::class, PoP_Module_Processor_FunctionLayouts::COMPONENT_LAYOUT_RECOMMENDPOST_HIDE_STYLES];
                $ret[] = [PoP_Module_Processor_FunctionLayouts::class, PoP_Module_Processor_FunctionLayouts::COMPONENT_LAYOUT_UNRECOMMENDPOST_SHOW_STYLES];
                break;

            case self::COMPONENT_LAYOUT_UNRECOMMENDPOST_STYLES:
                $ret[] = [PoP_Module_Processor_FunctionLayouts::class, PoP_Module_Processor_FunctionLayouts::COMPONENT_LAYOUT_UNRECOMMENDPOST_HIDE_STYLES];
                $ret[] = [PoP_Module_Processor_FunctionLayouts::class, PoP_Module_Processor_FunctionLayouts::COMPONENT_LAYOUT_RECOMMENDPOST_SHOW_STYLES];
                break;

            case self::COMPONENT_LAYOUT_SUBSCRIBETOTAG_STYLES:
                $ret[] = [PoP_Module_Processor_FunctionLayouts::class, PoP_Module_Processor_FunctionLayouts::COMPONENT_LAYOUT_SUBSCRIBETOTAG_HIDE_STYLES];
                $ret[] = [PoP_Module_Processor_FunctionLayouts::class, PoP_Module_Processor_FunctionLayouts::COMPONENT_LAYOUT_UNSUBSCRIBEFROMTAG_SHOW_STYLES];
                break;

            case self::COMPONENT_LAYOUT_UNSUBSCRIBEFROMTAG_STYLES:
                $ret[] = [PoP_Module_Processor_FunctionLayouts::class, PoP_Module_Processor_FunctionLayouts::COMPONENT_LAYOUT_UNSUBSCRIBEFROMTAG_HIDE_STYLES];
                $ret[] = [PoP_Module_Processor_FunctionLayouts::class, PoP_Module_Processor_FunctionLayouts::COMPONENT_LAYOUT_SUBSCRIBETOTAG_SHOW_STYLES];
                break;

            case self::COMPONENT_LAYOUT_UPVOTEPOST_STYLES:
                $ret[] = [PoP_Module_Processor_FunctionLayouts::class, PoP_Module_Processor_FunctionLayouts::COMPONENT_LAYOUT_UPVOTEPOST_HIDE_STYLES];
                $ret[] = [PoP_Module_Processor_FunctionLayouts::class, PoP_Module_Processor_FunctionLayouts::COMPONENT_LAYOUT_UNDOUPVOTEPOST_SHOW_STYLES];
                break;

            case self::COMPONENT_LAYOUT_UNDOUPVOTEPOST_STYLES:
                $ret[] = [PoP_Module_Processor_FunctionLayouts::class, PoP_Module_Processor_FunctionLayouts::COMPONENT_LAYOUT_UNDOUPVOTEPOST_HIDE_STYLES];
                $ret[] = [PoP_Module_Processor_FunctionLayouts::class, PoP_Module_Processor_FunctionLayouts::COMPONENT_LAYOUT_UPVOTEPOST_SHOW_STYLES];
                break;

            case self::COMPONENT_LAYOUT_DOWNVOTEPOST_STYLES:
                $ret[] = [PoP_Module_Processor_FunctionLayouts::class, PoP_Module_Processor_FunctionLayouts::COMPONENT_LAYOUT_DOWNVOTEPOST_HIDE_STYLES];
                $ret[] = [PoP_Module_Processor_FunctionLayouts::class, PoP_Module_Processor_FunctionLayouts::COMPONENT_LAYOUT_UNDODOWNVOTEPOST_SHOW_STYLES];
                break;

            case self::COMPONENT_LAYOUT_UNDODOWNVOTEPOST_STYLES:
                $ret[] = [PoP_Module_Processor_FunctionLayouts::class, PoP_Module_Processor_FunctionLayouts::COMPONENT_LAYOUT_UNDODOWNVOTEPOST_HIDE_STYLES];
                $ret[] = [PoP_Module_Processor_FunctionLayouts::class, PoP_Module_Processor_FunctionLayouts::COMPONENT_LAYOUT_DOWNVOTEPOST_SHOW_STYLES];
                break;
        }

        return $ret;
    }
}



