<?php
use PoP\ComponentModel\Facades\ComponentPath\ComponentPathManagerFacade;
use PoP\ComponentModel\Facades\ComponentProcessors\ComponentProcessorManagerFacade;
use PoP\ComponentModel\Misc\RequestUtils;
use PoP\ComponentModel\ComponentProcessors\DataloadingComponentInterface;
use PoP\ComponentModel\ComponentProcessors\FormattableModuleInterface;
use PoP\ComponentModel\State\ApplicationState;
use PoPCMSSchema\SchemaCommons\Facades\CMS\CMSServiceFacade;
use PoP\Root\Routing\RequestNature;
use PoPCMSSchema\CustomPosts\Facades\CustomPostTypeAPIFacade;
use PoPCMSSchema\CustomPosts\Routing\RequestNature as CustomPostRequestNature;
use PoPCMSSchema\Pages\Routing\RequestNature as PageRequestNature;
use PoPCMSSchema\PostTags\Facades\PostTagTypeAPIFacade;
use PoPCMSSchema\Tags\Routing\RequestNature as TagRequestNature;
use PoPCMSSchema\Users\Facades\UserTypeAPIFacade;
use PoPCMSSchema\Users\Routing\RequestNature as UserRequestNature;

abstract class PoP_Module_Processor_SectionBlocksBase extends PoP_Module_Processor_BlocksBase implements FormattableModuleInterface
{
    // public function getNature(\PoP\ComponentModel\Component\Component $component)
    // {
    //     if ($inner = $this->getInnerSubcomponent($component)) {
    //         $componentprocessor_manager = ComponentProcessorManagerFacade::getInstance();
    //         $processor = $componentprocessor_manager->getComponentProcessor($inner);
    //         return $processor->getNature($inner);
    //     }

    //     return parent::getNature($component);
    // }

    public function getSubmenuSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {

        // Add only if the current nature is the one expected by the block
        // if (\PoP\Root\App::getState('nature') == $this->getNature($component)) {
        switch (\PoP\Root\App::getState('nature')) {
            case UserRequestNature::USER:
                return [PoP_Module_Processor_CustomSubMenus::class, PoP_Module_Processor_CustomSubMenus::COMPONENT_SUBMENU_AUTHOR];

            case TagRequestNature::TAG:
                return [PoP_Module_Processor_CustomSubMenus::class, PoP_Module_Processor_CustomSubMenus::COMPONENT_SUBMENU_TAG];

            case CustomPostRequestNature::CUSTOMPOST:
                return PoP_Module_Processor_CustomSectionBlocksUtils::getSingleSubmenu();
        }
        // }

        return parent::getSubmenuSubcomponent($component);
    }

    public function getTitle(\PoP\ComponentModel\Component\Component $component, array &$props)
    {

        // Add only if the current nature is the one expected by the block
        // if (\PoP\Root\App::getState('nature') == $this->getNature($component)) {
        switch (\PoP\Root\App::getState('nature')) {
            case UserRequestNature::USER:
                return PoP_Module_Processor_CustomSectionBlocksUtils::getAuthorTitle();

            case TagRequestNature::TAG:
                return PoP_Module_Processor_CustomSectionBlocksUtils::getTagTitle();

            case CustomPostRequestNature::CUSTOMPOST:
                return PoP_Module_Processor_CustomSectionBlocksUtils::getSingleTitle();
        }
        // }

        return parent::getTitle($component, $props);
    }

    protected function getTitleLink(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        if ($route = $this->getRelevantRoute($component, $props)) {
            $cmsService = CMSServiceFacade::getInstance();
            $userTypeAPI = UserTypeAPIFacade::getInstance();
            $customPostTypeAPI = CustomPostTypeAPIFacade::getInstance();
            $postTagTypeAPI = PostTagTypeAPIFacade::getInstance();
            switch (\PoP\Root\App::getState('nature')) {
                case UserRequestNature::USER:
                    $url = $userTypeAPI->getUserURL(\PoP\Root\App::getState(['routing', 'queried-object-id']));
                    return RequestUtils::addRoute($url, $route);

                case TagRequestNature::TAG:
                    $url = $postTagTypeAPI->getTagURL(\PoP\Root\App::getState(['routing', 'queried-object-id']));
                    return RequestUtils::addRoute($url, $route);

                case PageRequestNature::PAGE:
                case CustomPostRequestNature::CUSTOMPOST:
                    $url = $customPostTypeAPI->getPermalink(\PoP\Root\App::getState(['routing', 'queried-object-id']));
                    return RequestUtils::addRoute($url, $route);

                case RequestNature::HOME:
                    $url = $cmsService->getHomeURL();
                    return RequestUtils::addRoute($url, $route);
            }
        }

        return parent::getTitleLink($component, $props);
    }

    public function getFormat(\PoP\ComponentModel\Component\Component $component): ?string
    {
        if ($inner = $this->getInnerSubcomponent($component)) {
            $componentprocessor_manager = ComponentProcessorManagerFacade::getInstance();
            $processor = $componentprocessor_manager->getComponentProcessor($inner);
            if ($processor instanceof FormattableModuleInterface) {
                return $processor->getFormat($inner);
            }
        }

        return null;
    }

    public function initModelProps(\PoP\ComponentModel\Component\Component $component, array &$props): void
    {
        // If the inner component is a DataloadingComponent, then transfer dataloading properties to its contained component
        if ($inner_component = $this->getInnerSubcomponent($component)) {
            $componentprocessor_manager = ComponentProcessorManagerFacade::getInstance();
            if ($componentprocessor_manager->getComponentProcessor($inner_component) instanceof DataloadingComponentInterface) {

                $skip_data_load = $this->getProp($component, $props, 'skip-data-load');
                if (!is_null($skip_data_load)) {
                    $this->setProp([$inner_component], $props, 'skip-data-load', $skip_data_load);
                }
                $lazy_load = $this->getProp($component, $props, 'lazy-load');
                if (!is_null($lazy_load)) {
                    $this->setProp([$inner_component], $props, 'lazy-load', $lazy_load);
                }
            }
        }

        if ($format = $this->getFormat($component)) {
            $classes = array(
                POP_FORMAT_SIMPLEVIEW => 'feed',
                POP_FORMAT_FULLVIEW => 'feed',
                POP_FORMAT_DETAILS => 'feed',
                POP_FORMAT_THUMBNAIL => 'feed',
                POP_FORMAT_LIST => 'feed',

                // Needed for restraining to 600px together with class pop-outerblock
                POP_FORMAT_TABLE => 'tableblock',
                POP_FORMAT_CAROUSEL => 'block-carousel',
                POP_FORMAT_CAROUSELCONTENT => 'block-carousel',
                POP_FORMAT_CALENDAR => 'calendar pop-block-calendar',
                POP_FORMAT_MAP => 'map pop-block-map',
                POP_FORMAT_CALENDARMAP => 'map pop-block-map pop-block-calendarmap pop-block-calendar',
            );
            if ($class = $classes[$format] ?? null) {
                $this->appendProp($component, $props, 'class', $class);
            }

            $resourceloaders = array(
                POP_FORMAT_CAROUSEL => 'block-carousel',
                POP_FORMAT_CAROUSELCONTENT => 'block-carousel',
                POP_FORMAT_CALENDAR => 'calendar',
                POP_FORMAT_MAP => 'map',
                POP_FORMAT_CALENDARMAP => 'calendarmap',
            );
            if ($resourceloader = $resourceloaders[$format] ?? null) {
                   // Artificial property added to identify the template when adding component-resources
                $this->setProp($component, $props, 'resourceloader', $resourceloader);
            }
        }

        if ($sectionfilter = $this->getSectionFilterComponent($component)) {
            // Class needed to push the "Loading" status a tiny bit down, so it doesn't show on top of the sectionfilter
            $this->appendProp($component, $props, 'class', 'withsectionfilter');

            // Check if the filter needs to be hidden (eg: GetPoP homepage)
            if ($this->getProp($component, $props, 'hide-sectionfilter')) {
                $this->appendProp($sectionfilter, $props, 'class', 'hidden');
            }
        }

        parent::initModelProps($component, $props);
    }

    protected function getInnerSubcomponents(\PoP\ComponentModel\Component\Component $component): array
    {
        $ret = parent::getInnerSubcomponents($component);

        if ($sectionfilter_component = $this->getSectionFilterComponent($component)) {
            $ret[] = $sectionfilter_component;
        }

        if ($inner_component = $this->getInnerSubcomponent($component)) {
            $ret[] = $inner_component;
        }

        return $ret;
    }

    protected function getSectionFilterComponent(\PoP\ComponentModel\Component\Component $component)
    {
        return null;
    }

    protected function getInnerSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        return null;
    }

    /**
     * @return mixed[]|null
     */
    public function getDataFeedbackInterreferencedComponentPath(\PoP\ComponentModel\Component\Component $component, array &$props): ?array
    {

        // If the inner component is a DataloadingComponent, then calculate the datafeedback of this component
        // based on the results from the inner dataloading component. Then, can calculate "do-not-render-if-no-results"
        if ($inner = $this->getInnerSubcomponent($component)) {
            $componentprocessor_manager = ComponentProcessorManagerFacade::getInstance();
            $processor = $componentprocessor_manager->getComponentProcessor($inner);
            if ($processor instanceof DataloadingComponentInterface) {
                $component_path_manager = ComponentPathManagerFacade::getInstance();
                $component_propagation_current_path = $component_path_manager->getPropagationCurrentPath();
                $component_propagation_current_path[] = $component;
                $component_propagation_current_path[] = $inner;
                return $component_propagation_current_path;
            }
        }

        return parent::getDataFeedbackInterreferencedComponentPath($component, $props);
    }
}
