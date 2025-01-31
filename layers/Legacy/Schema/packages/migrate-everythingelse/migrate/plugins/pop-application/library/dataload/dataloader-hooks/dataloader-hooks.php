<?php
use PoP\ComponentModel\State\ApplicationState;

class PoP_Application_DataloaderHooks
{
    public function __construct()
    {
        \PoP\Root\App::addFilter(
            'GD_Dataloader_List:query:pagenumber',
            $this->maybeGetLoadinglatestPagenumber(...)
        );
        \PoP\Root\App::addFilter(
            'GD_Dataloader_List:query:limit',
            $this->maybeGetLoadinglatestLimit(...)
        );
        \PoP\Root\App::addFilter(
            'CustomPostTypeDataLoader:query:limit',
            $this->maybeGetLoadinglatestLimitForPost(...)
        );
        \PoP\Root\App::addFilter(
            'CustomPostTypeDataLoader:query',
            $this->maybeAddLoadinglatestTimestamp(...),
            10,
            2
        );
    }

    public function maybeGetLoadinglatestPagenumber($pagenumber)
    {
        if (\PoP\Root\App::hasState('loading-latest') && \PoP\Root\App::getState('loading-latest')) {
            return 1;
        }

        return $pagenumber;
    }

    public function maybeGetLoadinglatestLimit($limit)
    {
        if (\PoP\Root\App::hasState('loading-latest') && \PoP\Root\App::getState('loading-latest')) {
            return 0;
        }

        return $limit;
    }

    public function maybeGetLoadinglatestLimitForPost($limit)
    {
        // No-limit for posts is -1, not 0
        if (\PoP\Root\App::hasState('loading-latest') && \PoP\Root\App::getState('loading-latest')) {
            return -1;
        }

        return $limit;
    }

    public function maybeAddLoadinglatestTimestamp($query, $query_args)
    {
        if (\PoP\Root\App::hasState('loading-latest') && \PoP\Root\App::getState('loading-latest')) {
            // Return the posts created after the given timestamp
            $timestamp = $query_args[GD_URLPARAM_TIMESTAMP];
            // $query['date-query'] = array(
            //     array(
            //         'after' => date('Y-m-d H:i:s', $timestamp),
            //         'inclusive' => false,
            //     )
            // );
            $query['date-from'] = date('Y-m-d H:i:s', $timestamp);
        }

        return $query;
    }
}

/**
 * Initialize
 */
new PoP_Application_DataloaderHooks();
