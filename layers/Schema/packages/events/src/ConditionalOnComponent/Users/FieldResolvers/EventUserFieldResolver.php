<?php

declare(strict_types=1);

namespace PoPSchema\Events\ConditionalOnComponent\Users\FieldResolvers;

use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoPSchema\Events\FieldResolvers\AbstractEventFieldResolver;
use PoPSchema\Users\TypeResolvers\UserTypeResolver;

class EventUserFieldResolver extends AbstractEventFieldResolver
{
    public function getClassesToAttachTo(): array
    {
        return array(UserTypeResolver::class);
    }

    public function getSchemaFieldDescription(TypeResolverInterface $typeResolver, string $fieldName): ?string
    {
        $descriptions = [
            'events' => $this->translationAPI->__('Events by the user', 'events'),
            'eventCount' => $this->translationAPI->__('Number of events by the user', 'events'),
        ];
        return $descriptions[$fieldName] ?? parent::getSchemaFieldDescription($typeResolver, $fieldName);
    }

    /**
     * @param array<string, mixed> $fieldArgs
     * @return array<string, mixed>
     */
    protected function getQuery(
        TypeResolverInterface $typeResolver,
        object $resultItem,
        string $fieldName,
        array $fieldArgs = []
    ): array {

        $query = parent::getQuery($typeResolver, $resultItem, $fieldName, $fieldArgs);

        $user = $resultItem;
        switch ($fieldName) {
            case 'events':
            case 'eventCount':
                $query['authors'] = [$typeResolver->getID($user)];
                break;
        }

        return $query;
    }
}
