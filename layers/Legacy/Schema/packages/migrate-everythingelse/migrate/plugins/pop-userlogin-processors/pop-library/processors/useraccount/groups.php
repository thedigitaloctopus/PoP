<?php

class PoP_Module_Processor_UserAccountGroups extends PoP_Module_Processor_MultiplesBase
{
    public final const COMPONENT_GROUP_LOGGEDINUSERDATA = 'group-loggedinuserdata';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_GROUP_LOGGEDINUSERDATA,
        );
    }

    public function getRelevantRoute(\PoP\ComponentModel\Component\Component $component, array &$props): ?string
    {
        return match($component->name) {
            self::COMPONENT_GROUP_LOGGEDINUSERDATA => POP_USERLOGIN_ROUTE_LOGGEDINUSERDATA,
            default => parent::getRelevantRoute($component, $props),
        };
    }

    /**
     * @return \PoP\ComponentModel\Component\Component[]
     */
    public function getSubcomponents(\PoP\ComponentModel\Component\Component $component): array
    {
        $ret = parent::getSubcomponents($component);

        switch ($component->name) {
            case self::COMPONENT_GROUP_LOGGEDINUSERDATA:
                $ret = array_merge(
                    $ret,
                    PoP_Module_Processor_UserAccountUtils::getLoginComponents()
                );
                break;
        }

        return $ret;
    }

    public function initModelProps(\PoP\ComponentModel\Component\Component $component, array &$props): void
    {
        switch ($component->name) {
            case self::COMPONENT_GROUP_LOGGEDINUSERDATA:
                $this->appendProp($component, $props, 'class', 'hidden');
                break;
        }

        parent::initModelProps($component, $props);
    }
}


