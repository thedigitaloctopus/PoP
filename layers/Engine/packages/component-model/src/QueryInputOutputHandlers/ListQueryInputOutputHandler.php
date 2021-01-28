<?php

declare(strict_types=1);

namespace PoP\ComponentModel\QueryInputOutputHandlers;

use PoP\ComponentModel\QueryInputOutputHandlers\AbstractQueryInputOutputHandler;

class ListQueryInputOutputHandler extends AbstractQueryInputOutputHandler
{
    public function prepareQueryArgs(&$query_args)
    {
        parent::prepareQueryArgs($query_args);

        // Handle edge cases for the limit (for security measures)
        $configuredLimit = $this->getLimit();
        if (isset($query_args[GD_URLPARAM_LIMIT])) {
            $limit = $query_args[GD_URLPARAM_LIMIT];
            if ($limit === -1 || $limit === 0 || $limit > $configuredLimit) {
                $limit = $configuredLimit;
            }
        } else {
            $limit = $configuredLimit;
        }
        $query_args[GD_URLPARAM_LIMIT] = intval($limit);
        $query_args[\PoP\ComponentModel\Constants\Params::PAGE_NUMBER] = $query_args[\PoP\ComponentModel\Constants\Params::PAGE_NUMBER] ? intval($query_args[\PoP\ComponentModel\Constants\Params::PAGE_NUMBER]) : 1;
    }

    protected function getLimit()
    {
        // By default: no limit
        return -1;
    }
}
