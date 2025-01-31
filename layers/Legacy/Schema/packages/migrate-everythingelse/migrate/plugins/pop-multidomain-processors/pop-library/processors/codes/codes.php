<?php

class PoP_Module_Processor_MultidomainCodes extends PoP_Module_Processor_HTMLCodesBase
{
    public final const COMPONENT_CODE_EXTERNAL = 'code-external';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_CODE_EXTERNAL,
        );
    }

    public function getRelevantRoute(\PoP\ComponentModel\Component\Component $component, array &$props): ?string
    {
        return match($component->name) {
            self::COMPONENT_CODE_EXTERNAL => POP_MULTIDOMAIN_ROUTE_EXTERNAL,
            default => parent::getRelevantRoute($component, $props),
        };
    }

    public function getJsmethods(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        $ret = parent::getJsmethods($component, $props);

        switch ($component->name) {
            case self::COMPONENT_CODE_EXTERNAL:
                // This is all this block does: load the external url defined in parameter "url"
                $this->addJsmethod($ret, 'clickURLParam');
                break;
        }

        return $ret;
    }

    public function initModelProps(\PoP\ComponentModel\Component\Component $component, array &$props): void
    {
        switch ($component->name) {
            case self::COMPONENT_CODE_EXTERNAL:
                // Make it invisible, nothing to show
                $this->appendProp($component, $props, 'class', 'hidden');
                break;
        }

        parent::initModelProps($component, $props);
    }
}



