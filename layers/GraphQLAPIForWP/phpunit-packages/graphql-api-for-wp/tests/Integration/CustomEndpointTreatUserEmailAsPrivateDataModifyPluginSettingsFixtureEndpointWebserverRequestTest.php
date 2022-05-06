<?php

declare(strict_types=1);

namespace PHPUnitForGraphQLAPI\GraphQLAPI\Integration;

/**
 * Use a custom endpoint that has option "Expose admin elements in the schema?"
 * with value "disabled". Then, those fields treated as "admin" won't be
 * added to the schema, and the query will produce an error.
 */
class CustomEndpointTreatUserEmailAsPrivateDataModifyPluginSettingsFixtureEndpointWebserverRequestTest extends AbstractTreatUserEmailAsPrivateDataModifyPluginSettingsFixtureEndpointWebserverRequestTest
{
    protected function getEndpoint(): string
    {
        return 'graphql/website/';
    }
}
