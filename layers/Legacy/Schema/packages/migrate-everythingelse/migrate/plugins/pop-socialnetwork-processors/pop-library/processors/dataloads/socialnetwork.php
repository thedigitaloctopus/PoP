<?php
use PoP\ComponentModel\Checkpoints\CheckpointInterface;
use PoP\ComponentModel\ComponentProcessors\DataloadingConstants;
use PoPCMSSchema\CustomPosts\TypeResolvers\ObjectType\CustomPostObjectTypeResolver;
use PoPCMSSchema\PostTags\TypeResolvers\ObjectType\PostTagObjectTypeResolver;
use PoPCMSSchema\Users\TypeResolvers\ObjectType\UserObjectTypeResolver;
use PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint;

class PoP_Module_Processor_FunctionsDataloads extends PoP_Module_Processor_DataloadsBase
{
    public final const COMPONENT_DATALOAD_FOLLOWSUSERS = 'dataload-followsusers';
    public final const COMPONENT_DATALOAD_RECOMMENDSPOSTS = 'dataload-recommendsposts';
    public final const COMPONENT_DATALOAD_SUBSCRIBESTOTAGS = 'dataload-subscribestotags';
    public final const COMPONENT_DATALOAD_UPVOTESPOSTS = 'dataload-upvotesposts';
    public final const COMPONENT_DATALOAD_DOWNVOTESPOSTS = 'dataload-downvotesposts';

    private ?UserLoggedInCheckpoint $userLoggedInCheckpoint = null;

    final public function setUserLoggedInCheckpoint(UserLoggedInCheckpoint $userLoggedInCheckpoint): void
    {
        $this->userLoggedInCheckpoint = $userLoggedInCheckpoint;
    }
    final protected function getUserLoggedInCheckpoint(): UserLoggedInCheckpoint
    {
        /** @var UserLoggedInCheckpoint */
        return $this->userLoggedInCheckpoint ??= $this->instanceManager->getInstance(UserLoggedInCheckpoint::class);
    }
    
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_DATALOAD_FOLLOWSUSERS,
            self::COMPONENT_DATALOAD_RECOMMENDSPOSTS,
            self::COMPONENT_DATALOAD_SUBSCRIBESTOTAGS,
            self::COMPONENT_DATALOAD_UPVOTESPOSTS,
            self::COMPONENT_DATALOAD_DOWNVOTESPOSTS,
        );
    }

    // function getDataaccessCheckpointConfiguration(\PoP\ComponentModel\Component\Component $component, array &$props) {
    /**
     * @return CheckpointInterface[]
     */
    public function getDataAccessCheckpoints(\PoP\ComponentModel\Component\Component $component, array &$props): array
    {
        switch ($component->name) {
            case self::COMPONENT_DATALOAD_FOLLOWSUSERS:
            case self::COMPONENT_DATALOAD_RECOMMENDSPOSTS:
            case self::COMPONENT_DATALOAD_SUBSCRIBESTOTAGS:
            case self::COMPONENT_DATALOAD_UPVOTESPOSTS:
            case self::COMPONENT_DATALOAD_DOWNVOTESPOSTS:
                return $this->maybeOverrideCheckpoints([$this->getUserLoggedInCheckpoint()]);
        }

        // return parent::getDataaccessCheckpointConfiguration($component, $props);
        return parent::getDataAccessCheckpoints($component, $props);
    }

    protected function addHeaddatasetcomponentDataProperties(&$ret, \PoP\ComponentModel\Component\Component $component, array &$props)
    {
        parent::addHeaddatasetcomponentDataProperties($ret, $component, $props);

        switch ($component->name) {
            case self::COMPONENT_DATALOAD_FOLLOWSUSERS:
            case self::COMPONENT_DATALOAD_RECOMMENDSPOSTS:
            case self::COMPONENT_DATALOAD_SUBSCRIBESTOTAGS:
            case self::COMPONENT_DATALOAD_UPVOTESPOSTS:
            case self::COMPONENT_DATALOAD_DOWNVOTESPOSTS:
                // If the user is not logged in, then do not load the data
                if (!PoP_UserState_Utils::currentRouteRequiresUserState() || !\PoP\Root\App::getState('is-user-logged-in')) {
                    $ret[DataloadingConstants::SKIPDATALOAD] = true;
                }
                break;
        }
    }

    public function getImmutableHeaddatasetcomponentDataProperties(\PoP\ComponentModel\Component\Component $component, array &$props): array
    {
        $ret = parent::getImmutableHeaddatasetcomponentDataProperties($component, $props);

        switch ($component->name) {
            case self::COMPONENT_DATALOAD_FOLLOWSUSERS:
            case self::COMPONENT_DATALOAD_RECOMMENDSPOSTS:
            case self::COMPONENT_DATALOAD_UPVOTESPOSTS:
            case self::COMPONENT_DATALOAD_DOWNVOTESPOSTS:
            case self::COMPONENT_DATALOAD_SUBSCRIBESTOTAGS:
                // Bring all of them and then don't bring anymore
                $ret[GD_DATALOAD_QUERYHANDLERPROPERTY_LIST_STOPFETCHING] = true;
                $ret[DataloadingConstants::QUERYARGS]['limit'] = -1;
                break;
        }

        return $ret;
    }

    protected function getInnerSubcomponents(\PoP\ComponentModel\Component\Component $component): array
    {
        $ret = parent::getInnerSubcomponents($component);

        $layouts = array(
            self::COMPONENT_DATALOAD_FOLLOWSUSERS => [PoP_Module_Processor_FunctionsContents::class, PoP_Module_Processor_FunctionsContents::COMPONENT_CONTENT_FOLLOWSUSERS],
            self::COMPONENT_DATALOAD_RECOMMENDSPOSTS => [PoP_Module_Processor_FunctionsContents::class, PoP_Module_Processor_FunctionsContents::COMPONENT_CONTENT_RECOMMENDSPOSTS],
            self::COMPONENT_DATALOAD_SUBSCRIBESTOTAGS => [PoP_Module_Processor_FunctionsContents::class, PoP_Module_Processor_FunctionsContents::COMPONENT_CONTENT_SUBSCRIBESTOTAGS],
            self::COMPONENT_DATALOAD_UPVOTESPOSTS => [PoP_Module_Processor_FunctionsContents::class, PoP_Module_Processor_FunctionsContents::COMPONENT_CONTENT_UPVOTESPOSTS],
            self::COMPONENT_DATALOAD_DOWNVOTESPOSTS => [PoP_Module_Processor_FunctionsContents::class, PoP_Module_Processor_FunctionsContents::COMPONENT_CONTENT_DOWNVOTESPOSTS],
        );
        if ($layout = $layouts[$component->name] ?? null) {
            $ret[] = $layout;
        }

        return $ret;
    }

    public function getObjectIDOrIDs(\PoP\ComponentModel\Component\Component $component, array &$props, &$data_properties): string|int|array
    {
        // All of these modules require the user to be logged in
        if (!\PoP\Root\App::getState('is-user-logged-in')) {
            return [];
        }

        $metaKeys = [
            self::COMPONENT_DATALOAD_FOLLOWSUSERS => GD_METAKEY_PROFILE_FOLLOWSUSERS,
            self::COMPONENT_DATALOAD_RECOMMENDSPOSTS => GD_METAKEY_PROFILE_RECOMMENDSPOSTS,
            self::COMPONENT_DATALOAD_SUBSCRIBESTOTAGS => GD_METAKEY_PROFILE_SUBSCRIBESTOTAGS,
            self::COMPONENT_DATALOAD_UPVOTESPOSTS => GD_METAKEY_PROFILE_UPVOTESPOSTS,
            self::COMPONENT_DATALOAD_DOWNVOTESPOSTS => GD_METAKEY_PROFILE_DOWNVOTESPOSTS,
        ];

        if ($metaKey = $metaKeys[$component->name] ?? null) {
            $userID = \PoP\Root\App::getState('current-user-id');
            return \PoPCMSSchema\UserMeta\Utils::getUserMeta($userID, $metaKey) ?? [];
        }

        return parent::getObjectIDOrIDs($component, $props, $data_properties);
    }

    public function getRelationalTypeResolver(\PoP\ComponentModel\Component\Component $component): ?\PoP\ComponentModel\TypeResolvers\RelationalTypeResolverInterface
    {
        switch ($component->name) {
            case self::COMPONENT_DATALOAD_FOLLOWSUSERS:
                return $this->instanceManager->getInstance(UserObjectTypeResolver::class);

            case self::COMPONENT_DATALOAD_UPVOTESPOSTS:
            case self::COMPONENT_DATALOAD_RECOMMENDSPOSTS:
            case self::COMPONENT_DATALOAD_DOWNVOTESPOSTS:
                return $this->instanceManager->getInstance(CustomPostObjectTypeResolver::class);

            case self::COMPONENT_DATALOAD_SUBSCRIBESTOTAGS:
                return $this->instanceManager->getInstance(PostTagObjectTypeResolver::class);
        }

        return parent::getRelationalTypeResolver($component);
    }

    public function initModelProps(\PoP\ComponentModel\Component\Component $component, array &$props): void
    {
        switch ($component->name) {
            case self::COMPONENT_DATALOAD_FOLLOWSUSERS:
            case self::COMPONENT_DATALOAD_RECOMMENDSPOSTS:
            case self::COMPONENT_DATALOAD_UPVOTESPOSTS:
            case self::COMPONENT_DATALOAD_DOWNVOTESPOSTS:
            case self::COMPONENT_DATALOAD_SUBSCRIBESTOTAGS:
                $this->appendProp($component, $props, 'class', 'hidden');
                break;
        }

        parent::initModelProps($component, $props);
    }
}



