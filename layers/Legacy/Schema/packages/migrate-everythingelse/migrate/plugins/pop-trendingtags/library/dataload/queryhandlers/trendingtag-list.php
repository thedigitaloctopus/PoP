<?php
namespace PoP\TrendingTags;
use PoP\Application\QueryInputOutputHandlers\ListQueryInputOutputHandler;

class QueryInputOutputHandler_TrendingTagList extends ListQueryInputOutputHandler
{
    /**
     * @param array<string,mixed> $query_args
     */
    public function prepareQueryArgs(array &$query_args): void
    {
        parent::prepareQueryArgs($query_args);

        // One Week by default
        $query_args['days'] = $query_args['days'] ? intval($query_args['days']) : POP_TRENDINGTAGS_DAYS_TRENDINGTAGS;
    }
}
    
/**
 * Initialize
 */
new QueryInputOutputHandler_TrendingTagList();
