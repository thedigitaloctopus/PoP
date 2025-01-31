<?php
use PoP\Root\Facades\Translation\TranslationAPIFacade;

class PoP_Module_Processor_TextFormInputs extends PoP_Module_Processor_TextFormInputsBase
{
    public final const COMPONENT_FORMINPUT_TARGETURL = 'forminput-targeturl';
    public final const COMPONENT_FORMINPUT_TARGETTITLE = 'forminput-targettitle';
    public final const COMPONENT_FORMINPUT_POSTTITLE = 'forminput-posttitle';
    public final const COMPONENT_FORMINPUT_USERNICENAME = 'forminput-usernicename';
    public final const COMPONENT_FORMINPUT_SENDERNAME = 'forminput-sendername';
    public final const COMPONENT_FORMINPUT_BROWSERURL = 'forminput-browserurl';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_FORMINPUT_TARGETURL,
            self::COMPONENT_FORMINPUT_TARGETTITLE,
            self::COMPONENT_FORMINPUT_POSTTITLE,
            self::COMPONENT_FORMINPUT_USERNICENAME,
            self::COMPONENT_FORMINPUT_BROWSERURL,
            self::COMPONENT_FORMINPUT_SENDERNAME,
        );
    }

    public function getLabelText(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_FORMINPUT_SENDERNAME:
                return TranslationAPIFacade::getInstance()->__('Your name', 'pop-coreprocessors');
        }

        return parent::getLabelText($component, $props);
    }

    public function getPagesectionJsmethod(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        $ret = parent::getPagesectionJsmethod($component, $props);

        switch ($component->name) {
            case self::COMPONENT_FORMINPUT_TARGETTITLE:
                // fill the input when showing the modal
                $this->addJsmethod($ret, 'fillModalInput');
                break;

            case self::COMPONENT_FORMINPUT_TARGETURL:
                // fill the input when showing the modal
                $this->addJsmethod($ret, 'fillModalURLInput');
                break;
        }

        return $ret;
    }

    public function getDbobjectField(\PoP\ComponentModel\Component\Component $component): ?string
    {
        switch ($component->name) {
            case self::COMPONENT_FORMINPUT_POSTTITLE:
                return 'title';

            case self::COMPONENT_FORMINPUT_USERNICENAME:
                return 'displayName';

            case self::COMPONENT_FORMINPUT_TARGETURL:
                return 'url';
        }

        return parent::getDbobjectField($component);
    }

    public function getJsmethods(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        $ret = parent::getJsmethods($component, $props);

        switch ($component->name) {
            case self::COMPONENT_FORMINPUT_TARGETTITLE:
            case self::COMPONENT_FORMINPUT_POSTTITLE:
            case self::COMPONENT_FORMINPUT_USERNICENAME:
                // // fill the input when a new Addon PageSection is created
                // if ($this->getProp($component, $props, 'replicable')) {
                $this->addJsmethod($ret, 'fillAddonInput');
                // }
                break;

            case self::COMPONENT_FORMINPUT_TARGETURL:
                // // fill the input when a new Addon PageSection is created
                // if ($this->getProp($component, $props, 'replicable')) {
                $this->addJsmethod($ret, 'fillAddonURLInput');
                // }
                break;

            case self::COMPONENT_FORMINPUT_BROWSERURL:
                $this->addJsmethod($ret, 'browserUrl');
                break;

            case self::COMPONENT_FORMINPUT_SENDERNAME:
                $this->addJsmethod($ret, 'addDomainClass');
                break;
        }
        return $ret;
    }

    public function getImmutableJsconfiguration(\PoP\ComponentModel\Component\Component $component, array &$props): array
    {
        $ret = parent::getImmutableJsconfiguration($component, $props);

        switch ($component->name) {
            case self::COMPONENT_FORMINPUT_SENDERNAME:
                // For function addDomainClass
                $ret['addDomainClass']['prefix'] = 'visible-notloggedin-';
                break;
        }

        return $ret;
    }

    public function isHidden(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        switch ($component->name) {
            case self::COMPONENT_FORMINPUT_TARGETURL:
            case self::COMPONENT_FORMINPUT_TARGETTITLE:
            case self::COMPONENT_FORMINPUT_POSTTITLE:
            case self::COMPONENT_FORMINPUT_USERNICENAME:
            case self::COMPONENT_FORMINPUT_BROWSERURL:
            // case self::COMPONENT_FORMINPUT_FILTERNAME:
                return true;
        }

        return parent::isHidden($component, $props);
    }

    public function initModelProps(\PoP\ComponentModel\Component\Component $component, array &$props): void
    {
        switch ($component->name) {
            case self::COMPONENT_FORMINPUT_TARGETURL:
                $this->mergeProp(
                    $component,
                    $props,
                    'params',
                    array(
                        'data-attr' => 'target-url'
                    )
                );
                break;

            case self::COMPONENT_FORMINPUT_TARGETTITLE:
            case self::COMPONENT_FORMINPUT_POSTTITLE:
            case self::COMPONENT_FORMINPUT_USERNICENAME:
                $this->mergeProp(
                    $component,
                    $props,
                    'params',
                    array(
                        'data-attr' => 'target-title'
                    )
                );
                break;

            case self::COMPONENT_FORMINPUT_BROWSERURL:
                $this->appendProp($component, $props, 'class', 'pop-browserurl');
                break;

            case self::COMPONENT_FORMINPUT_SENDERNAME:
                $this->appendProp($component, $props, 'class', 'visible-notloggedin');

                // If we don't use the loggedinuser-data, then show the inputs always
                if (!PoP_FormUtils::useLoggedinuserData()) {
                    $this->appendProp($component, $props, 'class', 'visible-always');
                }
                break;
        }

        parent::initModelProps($component, $props);
    }
}



