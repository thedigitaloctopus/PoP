<?php

declare(strict_types=1);

namespace PoP\PoP\Config\Symplify\MonorepoBuilder;

class UnmigratedFailingPackagesConfig
{
    /**
     * @return string[]
     */
    public function getUnmigratedFailingPackages(): array
    {
        return [
            'layers/Engine/packages/access-control',
            'layers/API/packages/api',
            'layers/API/packages/api-mirrorquery',
            'layers/SiteBuilder/packages/application',
            'layers/Schema/packages/block-metadata-for-wp',
            'layers/Schema/packages/categories',
            'layers/Wassup/packages/comment-mutations',
            'layers/Schema/packages/comment-mutations',
            'layers/Schema/packages/comment-mutations-wp',
            'layers/Schema/packages/comments',
            'layers/Engine/packages/component-model',
            'layers/SiteBuilder/packages/component-model-configuration',
            'layers/Wassup/packages/contactus-mutations',
            'layers/Wassup/packages/contactuser-mutations',
            'layers/Wassup/packages/custompost-mutations',
            'layers/Wassup/packages/custompostlink-mutations',
            'layers/Schema/packages/custompostmedia',
            'layers/Schema/packages/customposts',
            'layers/Engine/packages/engine',
            'layers/Engine/packages/engine-wp',
            'layers/Schema/packages/everythingelse',
            'layers/Wassup/packages/everythingelse-mutations',
            'layers/Schema/packages/everythingelse-wp',
            'layers/Wassup/packages/flag-mutations',
            'layers/Wassup/packages/form-mutations',
            'layers/Schema/packages/generic-customposts',
            'layers/GraphQLByPoP/packages/graphql-server',
            'layers/Wassup/packages/gravityforms-mutations',
            'layers/Engine/packages/guzzle-helpers',
            'layers/Wassup/packages/highlight-mutations',
            'layers/Schema/packages/highlights',
            'layers/Schema/packages/highlights-wp',
            'layers/Schema/packages/media',
            'layers/Schema/packages/menus',
            'layers/Schema/packages/menus-wp',
            'layers/SiteBuilder/packages/multisite',
            'layers/Wassup/packages/newsletter-mutations',
            'layers/Wassup/packages/notification-mutations',
            'layers/Schema/packages/notifications',
            'layers/Schema/packages/pages',
            'layers/Wassup/packages/post-mutations',
            'layers/Schema/packages/post-tags',
            'layers/Schema/packages/post-categories',
            'layers/Wassup/packages/postlink-mutations',
            'layers/Schema/packages/posts',
            'layers/Schema/packages/posts-wp',
            'layers/Wassup/packages/share-mutations',
            'layers/SiteBuilder/packages/site',
            'layers/SiteBuilder/packages/site-wp',
            'layers/Wassup/packages/socialnetwork-mutations',
            'layers/Wassup/packages/stance-mutations',
            'layers/Schema/packages/stances',
            'layers/Schema/packages/stances-wp',
            'layers/Wassup/packages/system-mutations',
            'layers/Schema/packages/tags',
            'layers/Schema/packages/categories',
            'layers/Schema/packages/user-roles-wp',
            'layers/Schema/packages/user-state-mutations',
            'layers/Wassup/packages/user-state-mutations',
            'layers/Schema/packages/users',
            'layers/Wassup/packages/volunteer-mutations',
            'layers/Wassup/packages/wassup',
            'layers/SiteBuilder/packages/application-wp',
            'layers/SiteBuilder/packages/definitionpersistence',
            'layers/SiteBuilder/packages/definitions-base36',
            'layers/SiteBuilder/packages/definitions-emoji',
            'layers/SiteBuilder/packages/resourceloader',
            'layers/SiteBuilder/packages/resources',
            'layers/SiteBuilder/packages/spa',
            'layers/SiteBuilder/packages/static-site-generator',
        ];
    }
}
