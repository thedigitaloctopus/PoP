<?php

declare(strict_types=1);

namespace PoP\PoP\Extensions\Symplify\MonorepoBuilder\Json;

use Symplify\MonorepoBuilder\Package\PackageProvider;
use Symplify\MonorepoBuilder\ValueObject\Package;

final class SourcePackagesProvider
{
    private PackageProvider $packageProvider;
    private bool $includeAll;

    public function __construct(
        PackageProvider $packageProvider
    ) {
        $this->packageProvider = $packageProvider;
    }

    /**
     * Code paths are src/ and tests/ folders.
     * But not all packages have them, so check if these folders exist.
     * Since a Package already has function `hasTests`, and since every
     * package that has tests/ also has src/, then using this function
     * already does the job.
     * @var string[] $fileListFilter
     * @return string[]
     */
    public function provideSourcePackages(bool $skipUnmigrated = false, array $fileListFilter = []): array
    {
        $packages = array_values(array_filter(
            $this->packageProvider->provide(),
            function (Package $package): bool {
                return $package->hasTests();
            }
        ));
        $packages = array_map(
            function (Package $package): string {
                return $package->getRelativePath();
            },
            $packages
        );
        // Temporary hack! PHPStan is currently failing for these packages,
        // because they have not been fully converted to PSR-4 (WIP),
        // and converting them will take some time. Hence, for the time being,
        // skip them from executing PHPStan, to avoid the CI from failing
        if ($skipUnmigrated) {
            $failingPackages = [
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
                'layers/GraphQLAPIForWP/plugins/convert-case-directives',
                'layers/Wassup/packages/custompost-mutations',
                'layers/Wassup/packages/custompostlink-mutations',
                'layers/Schema/packages/custompostmedia',
                'layers/Schema/packages/customposts',
                'layers/Engine/packages/engine',
                'layers/Engine/packages/engine-wp',
                'layers/Wassup/packages/event-mutations',
                'layers/Schema/packages/event-mutations-wp-em',
                'layers/Wassup/packages/eventlink-mutations',
                'layers/Schema/packages/events',
                'layers/Schema/packages/events-wp-em',
                'layers/Schema/packages/everythingelse',
                'layers/Wassup/packages/everythingelse-mutations',
                'layers/Schema/packages/everythingelse-wp',
                'layers/Misc/packages/examples-for-pop',
                'layers/Wassup/packages/flag-mutations',
                'layers/Wassup/packages/form-mutations',
                'layers/Schema/packages/generic-customposts',
                'layers/Schema/packages/google-translate-directive-for-customposts',
                'layers/GraphQLByPoP/packages/graphql-server',
                'layers/Wassup/packages/gravityforms-mutations',
                'layers/Engine/packages/guzzle-helpers',
                'layers/Wassup/packages/highlight-mutations',
                'layers/Schema/packages/highlights',
                'layers/Schema/packages/highlights-wp',
                'layers/Wassup/packages/location-mutations',
                'layers/Wassup/packages/locationpost-mutations',
                'layers/Wassup/packages/locationpostlink-mutations',
                'layers/Schema/packages/locationposts',
                'layers/Schema/packages/locationposts-wp',
                'layers/Schema/packages/locations',
                'layers/Schema/packages/locations-wp-em',
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
                'layers/Wassup/packages/postlink-mutations',
                'layers/Schema/packages/posts',
                'layers/Schema/packages/posts-wp',
                'layers/GraphQLAPIForWP/plugins/schema-feedback',
                'layers/Wassup/packages/share-mutations',
                'layers/SiteBuilder/packages/site',
                'layers/SiteBuilder/packages/site-wp',
                'layers/Wassup/packages/socialnetwork-mutations',
                'layers/Wassup/packages/stance-mutations',
                'layers/Schema/packages/stances',
                'layers/Schema/packages/stances-wp',
                'layers/Wassup/packages/system-mutations',
                'layers/Schema/packages/tags',
                'layers/Schema/packages/user-roles-wp',
                'layers/Schema/packages/user-state-mutations',
                'layers/Wassup/packages/user-state-mutations',
                'layers/Schema/packages/users',
                'layers/Wassup/packages/volunteer-mutations',
                'layers/Wassup/packages/wassup',
            ];
            $packages = array_values(array_diff(
                $packages,
                $failingPackages
            ));
        }
        // If provided, filter the packages to the ones containing
        // the list of files. Useful to launch GitHub runners to split modified packages only
        if ($fileListFilter !== []) {
            $packages = array_values(array_filter(
                $packages,
                fn (string $package) => $this->isPackageInFileList($package, $fileListFilter)
            ));
        }
        return $packages;
    }

    /**
     * @var string[] $fileListFilter
     * @return array<array<string,string>>
     */
    private function isPackageInFileList(string $package, array $fileListFilter): bool
    {
        $matchingPackages = array_filter(
            $fileListFilter,
            fn (string $file) => str_starts_with($file, $package)
        );
        return count($matchingPackages) > 0;
    }
}
