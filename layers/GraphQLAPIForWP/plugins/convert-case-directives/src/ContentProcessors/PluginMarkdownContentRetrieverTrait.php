<?php

declare(strict_types=1);

namespace GraphQLAPI\ConvertCaseDirectives\ContentProcessors;

use GraphQLAPI\ConvertCaseDirectives\PluginInfo;

trait PluginMarkdownContentRetrieverTrait
{
    /**
     * Get the dir where to look for the documentation.
     */
    protected function getBaseDir(): string
    {
        return PluginInfo::get('dir');
    }

    /**
     * Get the URL where to look for the documentation.
     */
    protected function getBaseURL(): string
    {
        return PluginInfo::get('url');
    }
}
