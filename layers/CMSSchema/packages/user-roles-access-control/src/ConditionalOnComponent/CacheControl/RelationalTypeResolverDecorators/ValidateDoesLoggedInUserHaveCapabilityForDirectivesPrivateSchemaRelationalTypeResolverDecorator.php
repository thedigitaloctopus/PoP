<?php

declare(strict_types=1);

namespace PoPCMSSchema\UserRolesAccessControl\ConditionalOnComponent\CacheControl\RelationalTypeResolverDecorators;

use PoPCMSSchema\UserRolesAccessControl\Services\AccessControlGroups;

class ValidateDoesLoggedInUserHaveCapabilityForDirectivesPrivateSchemaRelationalTypeResolverDecorator extends AbstractValidateDoesLoggedInUserHaveItemForDirectivesPrivateSchemaRelationalTypeResolverDecorator
{
    protected function getConfigurationEntries(): array
    {
        return $this->getAccessControlManager()->getEntriesForDirectives(AccessControlGroups::CAPABILITIES);
    }
}