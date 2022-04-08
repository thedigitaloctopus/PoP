<?php

declare(strict_types=1);

namespace GraphQLAPI\WPFakerSchema\Overrides\TypeAPIs;

use GraphQLAPI\WPFakerSchema\App;
use GraphQLAPI\WPFakerSchema\DataProvider\DataProviderInterface;
use PoPCMSSchema\PostsWP\TypeAPIs\PostTypeAPI as UpstreamPostTypeAPI;
use WP_Post;

class PostTypeAPI extends UpstreamPostTypeAPI
{
    use TypeAPITrait;

    private ?DataProviderInterface $dataProvider = null;

    final public function setDataProvider(DataProviderInterface $dataProvider): void
    {
        $this->dataProvider = $dataProvider;
    }
    final protected function getDataProvider(): DataProviderInterface
    {
        return $this->dataProvider ??= $this->instanceManager->getInstance(DataProviderInterface::class);
    }

    protected function resolveGetPost(int | string $id): ?WP_Post
    {
        /** @var ComponentConfiguration */
        $componentConfiguration = App::getComponent(Component::class)->getConfiguration();
        $useFixedDataset = $componentConfiguration->useFixedDataset();

        if ($useFixedDataset) {
            $postDataEntries = $this->getFakePostDataEntries();
            if ($postDataEntries === []) {
                return null;
            }
            $postIDs = array_map(
                fn (array $postDataEntry): int => $postDataEntry['id'],
                $postDataEntries,
            );
            $posts = $this->getFakePosts($postIDs);
            return $posts[0];
        }

        return App::getWPFaker()->post([
            // Create a random new post with the requested ID
            'id' => $id
        ]);
    }

    /**
     * @param int[] $postIDs
     * @return array<string,mixed>
     */
    protected function getFakePostDataEntries(array $postIDs = []): array
    {
        $wpPosts = $this->getPostFixedDataset();
        if ($postIDs !== []) {
            array_filter(
                $wpPosts,
                fn (array $wpPost) => in_array($wpPost['post_id'], $postIDs)
            );
        }

        // $properties = [
        //     'post_title',
        //     'guid',
        //     'post_author',
        //     'post_content',
        //     'post_excerpt',
        //     'post_id',
        //     'post_date',
        //     'post_date_gmt',
        //     'comment_status',
        //     'ping_status',
        //     'post_name',
        //     'status',
        //     'post_parent',
        //     'menu_order',
        //     'post_type',
        //     'post_password',
        //     'is_sticky',
        //     'terms',
        // ];

        /**
         * Convert "post_id" to "id", keep all other properties the same
         */
        return array_map(
            fn (array $wpPost) => [
                ...$wpPost,
                ...[
                    'id' => $wpPost['post_id'],
                ]
            ],
            $wpPosts
        );
    }

    /**
     * @return array<array<string,mixed>>
     */
    protected function getPostFixedDataset(): array
    {
        return $this->getDataProvider()->getFixedDataset()['posts'] ?? [];
    }

    /**
     * @param int[] $postIDs
     * @return WP_Post[]
     */
    protected function getFakePosts(array $postIDs): array
    {
        return array_map(
            fn (array $fakePostDataEntry) => App::getWPFaker()->post($fakePostDataEntry),
            $this->getFakePostDataEntries($postIDs)
        );
    }

    protected function resolveGetPosts(array $query): array
    {
        /** @var ComponentConfiguration */
        $componentConfiguration = App::getComponent(Component::class)->getConfiguration();
        $useFixedDataset = $componentConfiguration->useFixedDataset();

        $retrievePostIDs = $this->retrievePostIDs($query);

        /**
         * If providing the IDs to retrieve, re-generate exactly those objects.
         */
        $ids = $query['include'] ?? null;
        if (!empty($ids)) {
            /** @var int[] */
            $postIDs = is_string($ids) ? array_map(
                fn (string $id) => (int) trim($id),
                explode(',', $ids)
            ) : $ids;
            /**
             * If using a fixed dataset, make sure the ID exists.
             * If it does not, return `null` instead
             */
            if ($useFixedDataset) {
                $postIDs = array_values(array_intersect(
                    $postIDs,
                    $this->getFakePostIDs()
                ));
            }
            if ($retrievePostIDs) {
                return $postIDs;
            }
            return $useFixedDataset
                ? $this->getFakePosts($postIDs)
                : array_map(
                    fn (string|int $id) => App::getWPFaker()->post([
                        // The ID is provided, the rest is random data
                        'id' => $id
                    ]),
                    $postIDs
                );
        }

        /**
         * Get posts from the fixed dataset?
         */
        if ($useFixedDataset) {
            $postDataEntries = $this->getFakePostDataEntries();
            $filterableProperties = [
                'post_type',
                'post_status',
            ];
            foreach ($filterableProperties as $property) {
                if (!isset($query[$property])) {
                    continue;
                }
                $postDataEntries = $this->filterPostDataEntriesByProperty(
                    $postDataEntries,
                    $property,
                    $query[$property]
                );
            }
            $postDataEntries = array_slice(
                $postDataEntries,
                $query['offset'] ?? 0,
                $query['posts_per_page'] ?? 10
            );
            $postIDs = array_map(
                fn (array $postDataEntry): int => $postDataEntry['id'],
                $postDataEntries,
            );
            if ($retrievePostIDs) {
                return $postIDs;
            }
            return $this->getFakePosts($postIDs);
        }

        /**
         * Otherwise, let BrainFaker produce random entries
         */
        $posts = App::getWPFaker()->posts($query['posts_per_page'] ?? 10);
        if ($retrievePostIDs) {
            return array_map(
                fn (WP_Post $post) => $post->ID,
                $posts
            );
        }
        return $posts;
    }

    protected function retrievePostIDs(array $query): bool
    {
        return ($query['fields'] ?? null) === 'ids';
    }

    /**
     * @return int[] $postIDs
     */
    protected function getFakePostIDs(): array
    {
        return array_values(array_map(
            fn (array $wpPost) => (int) $wpPost['post_id'],
            $this->getPostFixedDataset()
        ));
    }

    protected function filterPostDataEntriesByProperty(array $postDataEntries, string $property, string | int $propertyValue): array
    {
        return array_values(array_filter(array_map(
            fn (array $fakePostDataEntry): ?array => $fakePostDataEntry[$property] === $propertyValue ? $fakePostDataEntry : null,
            $postDataEntries,
        )));
    }
}
