<?php
use PoP\Engine\ComponentProcessors\ObjectIDFromURLParamComponentProcessorTrait;
use PoP\Root\Facades\Translation\TranslationAPIFacade;
use PoPCMSSchema\Events\TypeResolvers\ObjectType\EventObjectTypeResolver;
use PoPSitesWassup\EventMutations\MutationResolverBridges\CreateEventMutationResolverBridge;
use PoPSitesWassup\EventMutations\MutationResolverBridges\UpdateEventMutationResolverBridge;

class GD_EM_Module_Processor_CreateUpdatePostDataloads extends PoP_Module_Processor_AddEditContentDataloadsBase
{
    use ObjectIDFromURLParamComponentProcessorTrait;

    public final const COMPONENT_DATALOAD_EVENT_UPDATE = 'dataload-event-update';
    public final const COMPONENT_DATALOAD_EVENT_CREATE = 'dataload-event-create';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_DATALOAD_EVENT_UPDATE,
            self::COMPONENT_DATALOAD_EVENT_CREATE,
        );
    }

    public function getRelevantRoute(\PoP\ComponentModel\Component\Component $component, array &$props): ?string
    {
        return match($component->name) {
            self::COMPONENT_DATALOAD_EVENT_CREATE => POP_EVENTSCREATION_ROUTE_ADDEVENT,
            self::COMPONENT_DATALOAD_EVENT_UPDATE => POP_EVENTSCREATION_ROUTE_EDITEVENT,
            default => parent::getRelevantRoute($component, $props),
        };
    }

    public function getRelevantRouteCheckpointTarget(\PoP\ComponentModel\Component\Component $component, array &$props): string
    {
        switch ($component->name) {
            case self::COMPONENT_DATALOAD_EVENT_CREATE:
                return \PoP\ComponentModel\Constants\DataLoading::ACTION_EXECUTION_CHECKPOINTS;
        }

        return parent::getRelevantRouteCheckpointTarget($component, $props);
    }

    protected function getInnerSubcomponents(\PoP\ComponentModel\Component\Component $component): array
    {
        $ret = parent::getInnerSubcomponents($component);

        $inners = array(
            self::COMPONENT_DATALOAD_EVENT_UPDATE => [GD_EM_Module_Processor_CreateUpdatePostForms::class, GD_EM_Module_Processor_CreateUpdatePostForms::COMPONENT_FORM_EVENT],
            self::COMPONENT_DATALOAD_EVENT_CREATE => [GD_EM_Module_Processor_CreateUpdatePostForms::class, GD_EM_Module_Processor_CreateUpdatePostForms::COMPONENT_FORM_EVENT],
        );
        if ($inner = $inners[$component->name] ?? null) {
            $ret[] = $inner;
        }

        return $ret;
    }

    protected function isCreate(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_DATALOAD_EVENT_CREATE:
                return true;
        }

        return parent::isCreate($component);
    }
    protected function isUpdate(\PoP\ComponentModel\Component\Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_DATALOAD_EVENT_UPDATE:
                return true;
        }

        return parent::isUpdate($component);
    }

    public function initModelProps(\PoP\ComponentModel\Component\Component $component, array &$props): void
    {
        switch ($component->name) {
            case self::COMPONENT_DATALOAD_EVENT_UPDATE:
            case self::COMPONENT_DATALOAD_EVENT_CREATE:
                if ($this->isUpdate($component)) {
                    $this->setProp([PoP_ContentCreation_Module_Processor_FeedbackMessageLayouts::class, PoP_ContentCreation_Module_Processor_FeedbackMessageLayouts::COMPONENT_LAYOUT_FEEDBACKMESSAGE_UPDATECONTENT], $props, 'objectname', TranslationAPIFacade::getInstance()->__('Event', 'pop-evenscreation-processors'));
                } elseif ($this->isCreate($component)) {
                    $this->setProp([PoP_ContentCreation_Module_Processor_FeedbackMessageLayouts::class, PoP_ContentCreation_Module_Processor_FeedbackMessageLayouts::COMPONENT_LAYOUT_FEEDBACKMESSAGE_CREATECONTENT], $props, 'objectname', TranslationAPIFacade::getInstance()->__('Event', 'pop-evenscreation-processors'));
                }
                break;
        }

        parent::initModelProps($component, $props);
    }

    public function getComponentMutationResolverBridge(\PoP\ComponentModel\Component\Component $component): ?\PoP\ComponentModel\MutationResolverBridges\ComponentMutationResolverBridgeInterface
    {
        switch ($component->name) {
            case self::COMPONENT_DATALOAD_EVENT_CREATE:
                return $this->instanceManager->getInstance(CreateEventMutationResolverBridge::class);
            case self::COMPONENT_DATALOAD_EVENT_UPDATE:
                return $this->instanceManager->getInstance(UpdateEventMutationResolverBridge::class);
        }

        return parent::getComponentMutationResolverBridge($component);
    }

    public function getObjectIDOrIDs(\PoP\ComponentModel\Component\Component $component, array &$props, &$data_properties): string|int|array
    {
        switch ($component->name) {
            case self::COMPONENT_DATALOAD_EVENT_UPDATE:
                return $this->getObjectIDFromURLParam($component, $props, $data_properties);
        }
        return parent::getObjectIDOrIDs($component, $props, $data_properties);
    }

    protected function getObjectIDParamName(\PoP\ComponentModel\Component\Component $component, array &$props, array &$data_properties): ?string
    {
        switch ($component->name) {
            case self::COMPONENT_DATALOAD_EVENT_UPDATE:
                return \PoPCMSSchema\Posts\Constants\InputNames::POST_ID;
        }
        return null;
    }

    public function getRelationalTypeResolver(\PoP\ComponentModel\Component\Component $component): ?\PoP\ComponentModel\TypeResolvers\RelationalTypeResolverInterface
    {
        switch ($component->name) {
            case self::COMPONENT_DATALOAD_EVENT_UPDATE:
            case self::COMPONENT_DATALOAD_EVENT_CREATE:
                return $this->instanceManager->getInstance(EventObjectTypeResolver::class);
        }

        return parent::getRelationalTypeResolver($component);
    }
}


