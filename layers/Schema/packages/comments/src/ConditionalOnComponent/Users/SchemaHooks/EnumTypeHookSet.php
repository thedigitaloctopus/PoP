<?php

declare(strict_types=1);

namespace PoPSchema\Comments\ConditionalOnComponent\Users\SchemaHooks;

use PoP\ComponentModel\TypeResolvers\EnumType\EnumTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\EnumType\HookNames;
use PoP\Hooks\AbstractHookSet;
use PoPSchema\Comments\ConditionalOnComponent\Users\Constants\CommentOrderBy;
use PoPSchema\Comments\TypeResolvers\EnumType\CommentOrderByEnumTypeResolver;

class EnumTypeHookSet extends AbstractHookSet
{
    protected function init(): void
    {
        $this->getHooksAPI()->addFilter(
            HookNames::ENUM_VALUES,
            [$this, 'getEnumValues'],
            10,
            2
        );
        $this->getHooksAPI()->addFilter(
            HookNames::ENUM_VALUE_DESCRIPTION,
            [$this, 'getEnumValueDescription'],
            10,
            3
        );
    }

    /**
     * @param string[] $enumValues
     */
    public function getEnumValues(
        array $enumValues,
        EnumTypeResolverInterface $enumTypeResolver,
    ): array {
        if (!($enumTypeResolver instanceof CommentOrderByEnumTypeResolver)) {
            return $enumValues;
        }
        return array_merge(
            $enumValues,
            [
                CommentOrderBy::AUTHOR,
            ]
        );
    }

    public function getEnumValueDescription(
        ?string $enumValueDescription,
        EnumTypeResolverInterface $enumTypeResolver,
        string $enumValue
    ): ?string {
        if (!($enumTypeResolver instanceof CommentOrderByEnumTypeResolver)) {
            return $enumValueDescription;
        }
        return match ($enumValue) {
            CommentOrderBy::AUTHOR => $this->getTranslationAPI()->__('Order by comment author', 'comments'),
            default => $enumValueDescription,
        };
    }
}