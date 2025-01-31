<?php

class GD_SocialNetwork_Module_Processor_QuicklinkButtonGroups extends PoP_Module_Processor_ControlButtonGroupsBase
{
    public final const COMPONENT_QUICKLINKBUTTONGROUP_USERFOLLOWUNFOLLOWUSER = 'quicklinkbuttongroup-userfollowunfollowuser';
    public final const COMPONENT_QUICKLINKBUTTONGROUP_POSTRECOMMENDUNRECOMMEND = 'quicklinkbuttongroup-postrecommendunrecommend';
    public final const COMPONENT_QUICKLINKBUTTONGROUP_POSTUPVOTEUNDOUPVOTE = 'quicklinkbuttongroup-postupvoteundoupvote';
    public final const COMPONENT_QUICKLINKBUTTONGROUP_POSTDOWNVOTEUNDODOWNVOTE = 'quicklinkbuttongroup-postdownvoteundodownvote';
    public final const COMPONENT_QUICKLINKBUTTONGROUP_TAGSUBSCRIBETOUNSUBSCRIBEFROM = 'quicklinkbuttongroup-tagsubscribetounsubscribefrom';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_QUICKLINKBUTTONGROUP_USERFOLLOWUNFOLLOWUSER,
            self::COMPONENT_QUICKLINKBUTTONGROUP_POSTRECOMMENDUNRECOMMEND,
            self::COMPONENT_QUICKLINKBUTTONGROUP_POSTUPVOTEUNDOUPVOTE,
            self::COMPONENT_QUICKLINKBUTTONGROUP_POSTDOWNVOTEUNDODOWNVOTE,
            self::COMPONENT_QUICKLINKBUTTONGROUP_TAGSUBSCRIBETOUNSUBSCRIBEFROM,
        );
    }

    /**
     * @return \PoP\ComponentModel\Component\Component[]
     */
    public function getSubcomponents(\PoP\ComponentModel\Component\Component $component): array
    {
        $ret = parent::getSubcomponents($component);
    
        switch ($component->name) {
            case self::COMPONENT_QUICKLINKBUTTONGROUP_USERFOLLOWUNFOLLOWUSER:
                $ret[] = [PoP_Module_Processor_FunctionButtons::class, PoP_Module_Processor_FunctionButtons::COMPONENT_BUTTON_FOLLOWUSER_PREVIEW];
                $ret[] = [PoP_Module_Processor_FunctionButtons::class, PoP_Module_Processor_FunctionButtons::COMPONENT_BUTTON_UNFOLLOWUSER_PREVIEW];
                break;

            case self::COMPONENT_QUICKLINKBUTTONGROUP_POSTRECOMMENDUNRECOMMEND:
                $ret[] = [PoP_Module_Processor_FunctionButtons::class, PoP_Module_Processor_FunctionButtons::COMPONENT_BUTTON_RECOMMENDPOST_PREVIEW];
                $ret[] = [PoP_Module_Processor_FunctionButtons::class, PoP_Module_Processor_FunctionButtons::COMPONENT_BUTTON_UNRECOMMENDPOST_PREVIEW];
                break;

            case self::COMPONENT_QUICKLINKBUTTONGROUP_POSTUPVOTEUNDOUPVOTE:
                $ret[] = [PoP_Module_Processor_FunctionButtons::class, PoP_Module_Processor_FunctionButtons::COMPONENT_BUTTON_UPVOTEPOST_PREVIEW];
                $ret[] = [PoP_Module_Processor_FunctionButtons::class, PoP_Module_Processor_FunctionButtons::COMPONENT_BUTTON_UNDOUPVOTEPOST_PREVIEW];
                break;

            case self::COMPONENT_QUICKLINKBUTTONGROUP_POSTDOWNVOTEUNDODOWNVOTE:
                $ret[] = [PoP_Module_Processor_FunctionButtons::class, PoP_Module_Processor_FunctionButtons::COMPONENT_BUTTON_DOWNVOTEPOST_PREVIEW];
                $ret[] = [PoP_Module_Processor_FunctionButtons::class, PoP_Module_Processor_FunctionButtons::COMPONENT_BUTTON_UNDODOWNVOTEPOST_PREVIEW];
                break;

            case self::COMPONENT_QUICKLINKBUTTONGROUP_TAGSUBSCRIBETOUNSUBSCRIBEFROM:
                $ret[] = [PoP_Module_Processor_FunctionButtons::class, PoP_Module_Processor_FunctionButtons::COMPONENT_BUTTON_SUBSCRIBETOTAG_PREVIEW];
                $ret[] = [PoP_Module_Processor_FunctionButtons::class, PoP_Module_Processor_FunctionButtons::COMPONENT_BUTTON_UNSUBSCRIBEFROMTAG_PREVIEW];
                break;
        }
        
        return $ret;
    }
}


