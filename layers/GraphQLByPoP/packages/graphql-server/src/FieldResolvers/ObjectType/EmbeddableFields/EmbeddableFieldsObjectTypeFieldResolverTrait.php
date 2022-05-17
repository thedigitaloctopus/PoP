<?php

declare(strict_types=1);

namespace GraphQLByPoP\GraphQLServer\FieldResolvers\ObjectType\EmbeddableFields;

use PoP\Root\App;
use PoPAPI\API\Module as APIModule;
use PoPAPI\API\ModuleConfiguration as APIComponentConfiguration;

trait EmbeddableFieldsObjectTypeFieldResolverTrait
{
    /**
     * Only use it when "embeddable fields" is enabled.
     *
     * Check on runtime (not via container) since this option can be
     * assigned to the Schema Configuration in the GraphQL API plugin.
     */
    public function isServiceEnabled(): bool
    {
        /** @var APIComponentConfiguration */
        $moduleConfiguration = App::getComponent(APIModule::class)->getConfiguration();
        return $moduleConfiguration->enableEmbeddableFields();
    }
}
