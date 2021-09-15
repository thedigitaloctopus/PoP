<?php

declare(strict_types=1);

namespace PoP\API\Enums;

use PoP\API\Schema\SchemaDefinition;
use PoP\ComponentModel\Enums\AbstractEnumTypeResolver;

class SchemaFieldShapeEnum extends AbstractEnumTypeResolver
{
    public function getTypeName(): string
    {
        return 'SchemaOutputShape';
    }
    /**
     * @return array<int|float|bool|string>
     */
    public function getValues(): array
    {
        return [
            SchemaDefinition::ARGVALUE_SCHEMA_SHAPE_FLAT,
            SchemaDefinition::ARGVALUE_SCHEMA_SHAPE_NESTED,
        ];
    }
}
