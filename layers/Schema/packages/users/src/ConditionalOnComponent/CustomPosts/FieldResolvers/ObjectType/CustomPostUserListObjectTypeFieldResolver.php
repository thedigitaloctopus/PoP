<?php

declare(strict_types=1);

namespace PoPSchema\Users\ConditionalOnComponent\CustomPosts\FieldResolvers\ObjectType;

use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoPSchema\CustomPosts\FieldResolvers\ObjectType\AbstractCustomPostListObjectTypeFieldResolver;
use PoPSchema\Users\TypeResolvers\ObjectType\UserObjectTypeResolver;

class CustomPostUserListObjectTypeFieldResolver extends AbstractCustomPostListObjectTypeFieldResolver
{
    public function getObjectTypeResolverClassesToAttachTo(): array
    {
        return [
            UserObjectTypeResolver::class,
        ];
    }

    public function getSchemaFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ?string
    {
        $descriptions = [
            'customPosts' => $this->translationAPI->__('Custom posts by the user', 'users'),
            'customPostCount' => $this->translationAPI->__('Number of custom posts by the user', 'users'),
            'customPostsForAdmin' => $this->translationAPI->__('[Unrestricted] Custom posts by the user', 'users'),
            'customPostCountForAdmin' => $this->translationAPI->__('[Unrestricted] Number of custom posts by the user', 'users'),
        ];
        return $descriptions[$fieldName] ?? parent::getSchemaFieldDescription($objectTypeResolver, $fieldName);
    }

    /**
     * @param array<string, mixed> $fieldArgs
     * @return array<string, mixed>
     */
    protected function getQuery(
        ObjectTypeResolverInterface $objectTypeResolver,
        object $object,
        string $fieldName,
        array $fieldArgs = []
    ): array {
        $query = parent::getQuery($objectTypeResolver, $object, $fieldName, $fieldArgs);

        $user = $object;
        switch ($fieldName) {
            case 'customPosts':
            case 'customPostCount':
            case 'customPostsForAdmin':
            case 'customPostCountForAdmin':
                $query['authors'] = [$objectTypeResolver->getID($user)];
                break;
        }

        return $query;
    }
}