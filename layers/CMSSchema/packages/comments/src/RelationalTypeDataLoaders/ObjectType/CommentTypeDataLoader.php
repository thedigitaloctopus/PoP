<?php

declare(strict_types=1);

namespace PoPCMSSchema\Comments\RelationalTypeDataLoaders\ObjectType;

use PoP\ComponentModel\RelationalTypeDataLoaders\ObjectType\AbstractObjectTypeQueryableDataLoader;
use PoPCMSSchema\Comments\Constants\CommentStatus;
use PoPCMSSchema\Comments\Constants\CommentTypes;
use PoPCMSSchema\Comments\TypeAPIs\CommentTypeAPIInterface;
use PoPSchema\SchemaCommons\Constants\QueryOptions;
use PoPCMSSchema\SchemaCommons\DataLoading\ReturnTypes;

class CommentTypeDataLoader extends AbstractObjectTypeQueryableDataLoader
{
    private ?CommentTypeAPIInterface $commentTypeAPI = null;

    final public function setCommentTypeAPI(CommentTypeAPIInterface $commentTypeAPI): void
    {
        $this->commentTypeAPI = $commentTypeAPI;
    }
    final protected function getCommentTypeAPI(): CommentTypeAPIInterface
    {
        /** @var CommentTypeAPIInterface */
        return $this->commentTypeAPI ??= $this->instanceManager->getInstance(CommentTypeAPIInterface::class);
    }

    /**
     * @param array<string|int> $ids
     * @return array<string,mixed>
     */
    public function getQueryToRetrieveObjectsForIDs(array $ids): array
    {
        return [
            'include' => $ids,
            'type' => [
                CommentTypes::COMMENT,
                CommentTypes::TRACKBACK,
                CommentTypes::PINGBACK,
            ],
            'status' => [
                CommentStatus::APPROVE,
                CommentStatus::HOLD,
                CommentStatus::SPAM,
                CommentStatus::TRASH,
            ],
        ];
    }

    /**
     * @return mixed[]
     * @param array<string,mixed> $query
     * @param array<string,mixed> $options
     */
    public function executeQuery(array $query, array $options = []): array
    {
        return $this->getCommentTypeAPI()->getComments($query, $options);
    }

    /**
     * @param array<string,mixed> $query
     * @return array<string|int>
     */
    public function executeQueryIDs(array $query): array
    {
        $options = [
            QueryOptions::RETURN_TYPE => ReturnTypes::IDS,
        ];
        return $this->executeQuery($query, $options);
    }
}
