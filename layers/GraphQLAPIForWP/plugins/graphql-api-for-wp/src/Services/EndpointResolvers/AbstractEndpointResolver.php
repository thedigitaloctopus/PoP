<?php

declare(strict_types=1);

namespace GraphQLAPI\GraphQLAPI\Services\EndpointResolvers;

use Symfony\Contracts\Service\Attribute\Required;
use GraphQLAPI\GraphQLAPI\Services\Helpers\EndpointHelpers;
use PoP\Root\Services\AbstractAutomaticallyInstantiatedService;

abstract class AbstractEndpointResolver extends AbstractAutomaticallyInstantiatedService
{
    protected EndpointHelpers $endpointHelpers;
    
    #[Required]
    public function autowireAbstractEndpointResolver(EndpointHelpers $endpointHelpers)
    {
        $this->endpointHelpers = $endpointHelpers;
    }

    /**
     * Initialize the resolver
     */
    public function initialize(): void
    {
        // Do nothing
    }
}
