<?php

declare(strict_types=1);

namespace PoPCMSSchema\Users\ConditionalOnModule\CustomPosts\ConditionalOnModule\RESTAPI\Hooks;

use PoP\Root\App;
use PoP\Root\Hooks\AbstractHookSet;
use PoPAPI\RESTAPI\Helpers\HookHelpers;
use PoPCMSSchema\CustomPosts\ConditionalOnModule\RESTAPI\ComponentRoutingProcessors\AbstractCustomPostRESTEntryComponentRoutingProcessor;

class CustomPostHookSet extends AbstractHookSet
{
    const AUTHOR_RESTFIELDS = 'author.id|name|url';

    protected function init(): void
    {
        App::addFilter(
            HookHelpers::getHookName(AbstractCustomPostRESTEntryComponentRoutingProcessor::class),
            $this->getGraphQLQueryToResolveRESTEndpoint(...)
        );
    }

    public function getGraphQLQueryToResolveRESTEndpoint($restEndpointGraphQLQuery): string
    {
        return $restEndpointGraphQLQuery . ',' . self::AUTHOR_RESTFIELDS;
    }
}
