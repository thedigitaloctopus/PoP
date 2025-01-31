<?php
use PoP\ComponentModel\App;
use PoP\ComponentModel\ComponentProcessors\DataloadingConstants;
use PoP\ComponentModel\QueryInputOutputHandlers\QueryInputOutputHandlerInterface;
use PoP\Engine\ComponentProcessors\ObjectIDFromURLParamComponentProcessorTrait;
use PoP\Root\Facades\Translation\TranslationAPIFacade;
use PoPCMSSchema\CustomPosts\TypeResolvers\ObjectType\CustomPostObjectTypeResolver;

abstract class PoP_Module_Processor_AddEditContentDataloadsBase extends PoP_Module_Processor_DataloadsBase
{
    use ObjectIDFromURLParamComponentProcessorTrait;

    protected function isCreate(\PoP\ComponentModel\Component\Component $component)
    {
        return null;
    }
    protected function isUpdate(\PoP\ComponentModel\Component\Component $component)
    {
        return null;
    }

    public function getObjectIDOrIDs(\PoP\ComponentModel\Component\Component $component, array &$props, &$data_properties): string|int|array
    {
        if ($this->isUpdate($component)) {
            return $this->getObjectIDFromURLParam($component, $props, $data_properties);
        }
        // The parent obtains a list of IDs. Return it as a single ID
        $ids = parent::getObjectIDOrIDs($component, $props, $data_properties);
        if (is_array($ids) && count($ids) == 1) {
            return $ids[0];
        }
        return $ids;
    }

    protected function getObjectIDParamName(\PoP\ComponentModel\Component\Component $component, array &$props, array &$data_properties): ?string
    {
        if ($this->isUpdate($component)) {
            return \PoPCMSSchema\Posts\Constants\InputNames::POST_ID;
        }
        return null;
    }

    public function getRelationalTypeResolver(\PoP\ComponentModel\Component\Component $component): ?\PoP\ComponentModel\TypeResolvers\RelationalTypeResolverInterface
    {
        return $this->instanceManager->getInstance(CustomPostObjectTypeResolver::class);
    }

    public function getQueryInputOutputHandler(\PoP\ComponentModel\Component\Component $component): ?QueryInputOutputHandlerInterface
    {
        if ($this->isUpdate($component)) {
            return $this->instanceManager->getInstance(GD_DataLoad_QueryInputOutputHandler_EditPost::class);
        } elseif ($this->isCreate($component)) {
            return $this->instanceManager->getInstance(GD_DataLoad_QueryInputOutputHandler_AddPost::class);
        }

        return parent::getQueryInputOutputHandler($component);
    }

    public function prepareDataPropertiesAfterMutationExecution(\PoP\ComponentModel\Component\Component $component, array &$props, array &$data_properties): void
    {
        parent::prepareDataPropertiesAfterMutationExecution($component, $props, $data_properties);

        if ($this->isCreate($component)) {
            if ($target_id = App::getMutationResolutionStore()->getResult($this->getComponentMutationResolverBridge($component))) {
                $data_properties[DataloadingConstants::QUERYARGS]['include'] = array($target_id);
            } else {
                $data_properties[DataloadingConstants::SKIPDATALOAD] = true;
            }
        }
    }

    protected function getCheckpointMessageComponent(\PoP\ComponentModel\Component\Component $component)
    {
        if ($this->isCreate($component)) {
            return [GD_UserLogin_Module_Processor_UserCheckpointMessages::class, GD_UserLogin_Module_Processor_UserCheckpointMessages::COMPONENT_CHECKPOINTMESSAGE_LOGGEDIN];
        } elseif ($this->isUpdate($component)) {
            return [GD_UserLogin_Module_Processor_UserCheckpointMessages::class, GD_UserLogin_Module_Processor_UserCheckpointMessages::COMPONENT_CHECKPOINTMESSAGE_LOGGEDINCANEDIT];
        }

        return parent::getCheckpointMessageComponent($component);
    }

    protected function getFeedbackMessageComponent(\PoP\ComponentModel\Component\Component $component)
    {
        if ($this->isCreate($component)) {
            return [PoP_ContentCreation_Module_Processor_FeedbackMessages::class, PoP_ContentCreation_Module_Processor_FeedbackMessages::COMPONENT_FEEDBACKMESSAGE_CREATECONTENT];
        } elseif ($this->isUpdate($component)) {
            return [PoP_ContentCreation_Module_Processor_FeedbackMessages::class, PoP_ContentCreation_Module_Processor_FeedbackMessages::COMPONENT_FEEDBACKMESSAGE_UPDATECONTENT];
        }

        return parent::getFeedbackMessageComponent($component);
    }

    public function getJsmethods(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        $ret = parent::getJsmethods($component, $props);

        if ($this->isCreate($component)) {
            $this->addJsmethod($ret, 'formCreatePostBlock');
        } elseif ($this->isUpdate($component)) {
            $this->addJsmethod($ret, 'destroyPageOnUserLoggedOut');
            $this->addJsmethod($ret, 'refetchBlockOnUserLoggedIn');
        }

        return $ret;
    }

    public function initModelProps(\PoP\ComponentModel\Component\Component $component, array &$props): void
    {
        $this->setProp([[PoP_Module_Processor_Status::class, PoP_Module_Processor_Status::COMPONENT_STATUS]], $props, 'loading-msg', TranslationAPIFacade::getInstance()->__('Submitting...', 'pop-application-processors'));

        if ($this->isCreate($component)) {
            $this->setProp([GD_UserLogin_Module_Processor_UserCheckpointMessageLayouts::class, GD_UserLogin_Module_Processor_UserCheckpointMessageLayouts::COMPONENT_LAYOUT_CHECKPOINTMESSAGE_LOGGEDIN], $props, 'action', TranslationAPIFacade::getInstance()->__('create content', 'poptheme-wassup'));
        } elseif ($this->isUpdate($component)) {
            $this->setProp([GD_UserLogin_Module_Processor_UserCheckpointMessageLayouts::class, GD_UserLogin_Module_Processor_UserCheckpointMessageLayouts::COMPONENT_LAYOUT_CHECKPOINTMESSAGE_LOGGEDINCANEDIT], $props, 'action', TranslationAPIFacade::getInstance()->__('edit this content', 'poptheme-wassup'));
        }

        parent::initModelProps($component, $props);
    }
}
