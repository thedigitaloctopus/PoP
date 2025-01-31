<?php
use PoP\ComponentModel\Facades\ComponentProcessors\ComponentProcessorManagerFacade;
use PoP\ComponentModel\State\ApplicationState;
use PoP\Root\Facades\Translation\TranslationAPIFacade;
use PoPCMSSchema\Users\TypeResolvers\ObjectType\UserObjectTypeResolver;

class PoP_UserCommunities_Module_Processor_MySectionDataloads extends PoP_Module_Processor_SectionDataloadsBase
{
    public final const COMPONENT_DATALOAD_MYMEMBERS_TABLE_EDIT = 'dataload-mymembers-table-edit';
    public final const COMPONENT_DATALOAD_MYMEMBERS_SCROLL_FULLVIEW = 'dataload-mymembers-scroll-fullviewpreview';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_DATALOAD_MYMEMBERS_TABLE_EDIT,
            self::COMPONENT_DATALOAD_MYMEMBERS_SCROLL_FULLVIEW,
        );
    }

    public function getRelevantRoute(\PoP\ComponentModel\Component\Component $component, array &$props): ?string
    {
        return match($component->name) {
            self::COMPONENT_DATALOAD_MYMEMBERS_SCROLL_FULLVIEW => POP_USERCOMMUNITIES_ROUTE_MYMEMBERS,
            self::COMPONENT_DATALOAD_MYMEMBERS_TABLE_EDIT => POP_USERCOMMUNITIES_ROUTE_MYMEMBERS,
            default => parent::getRelevantRoute($component, $props),
        };
    }

    protected function getInnerSubcomponents(\PoP\ComponentModel\Component\Component $component): array
    {
        $componentprocessor_manager = ComponentProcessorManagerFacade::getInstance();

        $ret = parent::getInnerSubcomponents($component);

        switch ($component->name) {
            case self::COMPONENT_DATALOAD_MYMEMBERS_TABLE_EDIT:
                $ret[] = [PoP_UserCommunities_Module_Processor_Codes::class, PoP_UserCommunities_Module_Processor_Codes::COMPONENT_CODE_INVITENEWMEMBERSHELP];
                $ret[] = [GD_URE_Module_Processor_CustomAnchorControls::class, GD_URE_Module_Processor_CustomAnchorControls::COMPONENT_ANCHORCONTROL_INVITENEWMEMBERS_BIG];
                $ret[] = [PoP_UserCommunities_Module_Processor_Tables::class, PoP_UserCommunities_Module_Processor_Tables::COMPONENT_TABLE_MYMEMBERS];
                break;

            case self::COMPONENT_DATALOAD_MYMEMBERS_SCROLL_FULLVIEW:
                $ret[] = [PoP_UserCommunities_Module_Processor_CustomScrolls::class, PoP_UserCommunities_Module_Processor_CustomScrolls::COMPONENT_SCROLL_MYMEMBERS_FULLVIEWPREVIEW];
                break;
        }

        return $ret;
    }

    public function getJsmethods(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        $ret = parent::getJsmethods($component, $props);

        switch ($component->name) {
            case self::COMPONENT_DATALOAD_MYMEMBERS_TABLE_EDIT:
            case self::COMPONENT_DATALOAD_MYMEMBERS_SCROLL_FULLVIEW:
                $this->addJsmethod($ret, 'destroyPageOnUserLoggedOut');
                $this->addJsmethod($ret, 'refetchBlockOnUserLoggedIn');
                break;
        }

        return $ret;
    }

    public function getFilterSubcomponent(\PoP\ComponentModel\Component\Component $component): ?\PoP\ComponentModel\Component\Component
    {
        switch ($component->name) {
            case self::COMPONENT_DATALOAD_MYMEMBERS_TABLE_EDIT:
            case self::COMPONENT_DATALOAD_MYMEMBERS_SCROLL_FULLVIEW:
                return [GD_URE_Module_Processor_CustomFilters::class, GD_URE_Module_Processor_CustomFilters::COMPONENT_FILTER_MYMEMBERS];
        }

        return parent::getFilterSubcomponent($component);
    }

    public function getFormat(\PoP\ComponentModel\Component\Component $component): ?string
    {

        // Add the format attr
        $tables = array(
            self::COMPONENT_DATALOAD_MYMEMBERS_TABLE_EDIT,
        );
        $fullviews = array(
            self::COMPONENT_DATALOAD_MYMEMBERS_SCROLL_FULLVIEW,
        );
        if (in_array($component, $tables)) {
            $format = POP_FORMAT_TABLE;
        } elseif (in_array($component, $fullviews)) {
            $format = POP_FORMAT_FULLVIEW;
        }

        return $format ?? parent::getFormat($component);
    }

    protected function getMutableonrequestDataloadQueryArgs(\PoP\ComponentModel\Component\Component $component, array &$props): array
    {
        $ret = parent::getMutableonrequestDataloadQueryArgs($component, $props);

        switch ($component->name) {
         // Members of the Community
            case self::COMPONENT_DATALOAD_MYMEMBERS_TABLE_EDIT:
            case self::COMPONENT_DATALOAD_MYMEMBERS_SCROLL_FULLVIEW:
                $current_user = \PoP\Root\App::getState('current-user-id');
                if (gdUreIsCommunity($current_user)) {
                    $ret['meta-query'][] = [
                        'key' => \PoPCMSSchema\UserMeta\Utils::getMetaKey(GD_URE_METAKEY_PROFILE_COMMUNITIES),
                        'value' => $current_user,
                        'compare' => 'IN',
                    ];
                }
                break;
        }

        return $ret;
    }

    public function getRelationalTypeResolver(\PoP\ComponentModel\Component\Component $component): ?\PoP\ComponentModel\TypeResolvers\RelationalTypeResolverInterface
    {
        switch ($component->name) {
            case self::COMPONENT_DATALOAD_MYMEMBERS_TABLE_EDIT:
            case self::COMPONENT_DATALOAD_MYMEMBERS_SCROLL_FULLVIEW:
                return $this->instanceManager->getInstance(UserObjectTypeResolver::class);
        }

        return parent::getRelationalTypeResolver($component);
    }

    protected function getCheckpointMessageComponent(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_DATALOAD_MYMEMBERS_TABLE_EDIT:
            case self::COMPONENT_DATALOAD_MYMEMBERS_SCROLL_FULLVIEW:
                return [GD_UserCommunities_Module_Processor_UserCheckpointMessages::class, GD_UserCommunities_Module_Processor_UserCheckpointMessages::COMPONENT_CHECKPOINTMESSAGE_PROFILECOMMUNITY];
        }

        return parent::getCheckpointMessageComponent($component);
    }

    public function initModelProps(\PoP\ComponentModel\Component\Component $component, array &$props): void
    {
        switch ($component->name) {
            case self::COMPONENT_DATALOAD_MYMEMBERS_TABLE_EDIT:
            case self::COMPONENT_DATALOAD_MYMEMBERS_SCROLL_FULLVIEW:
                $this->setProp([PoP_Module_Processor_DomainFeedbackMessageLayouts::class, PoP_Module_Processor_DomainFeedbackMessageLayouts::COMPONENT_LAYOUT_FEEDBACKMESSAGE_ITEMLIST], $props, 'pluralname', TranslationAPIFacade::getInstance()->__('members', 'poptheme-wassup'));
                $this->setProp([GD_UserCommunities_Module_Processor_UserCheckpointMessageLayouts::class, GD_UserCommunities_Module_Processor_UserCheckpointMessageLayouts::COMPONENT_LAYOUT_CHECKPOINTMESSAGE_PROFILECOMMUNITY], $props, 'action', TranslationAPIFacade::getInstance()->__('view your members', 'poptheme-wassup'));
                break;
        }

        parent::initModelProps($component, $props);
    }
}



