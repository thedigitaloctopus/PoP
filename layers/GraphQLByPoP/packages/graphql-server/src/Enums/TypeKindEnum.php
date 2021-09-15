<?php

declare(strict_types=1);

namespace GraphQLByPoP\GraphQLServer\Enums;

use PoP\ComponentModel\Enums\AbstractEnumTypeResolver;
use GraphQLByPoP\GraphQLServer\ObjectModels\TypeKinds;

class TypeKindEnum extends AbstractEnumTypeResolver
{
    public function getTypeName(): string
    {
        return 'TypeKind';
    }
    /**
     * @return array<int|float|bool|string>
     */
    public function getValues(): array
    {
        return [
            TypeKinds::SCALAR,
            TypeKinds::OBJECT,
            TypeKinds::INTERFACE,
            TypeKinds::UNION,
            TypeKinds::ENUM,
            TypeKinds::INPUT_OBJECT,
            TypeKinds::LIST,
            TypeKinds::NON_NULL,
        ];
    }
}
