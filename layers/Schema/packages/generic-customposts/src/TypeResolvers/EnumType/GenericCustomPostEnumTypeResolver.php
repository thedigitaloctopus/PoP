<?php

declare(strict_types=1);

namespace PoPSchema\GenericCustomPosts\TypeResolvers\EnumType;

use PoP\ComponentModel\TypeResolvers\EnumType\AbstractEnumTypeResolver;
use PoPSchema\GenericCustomPosts\ComponentConfiguration;

class GenericCustomPostEnumTypeResolver extends AbstractEnumTypeResolver
{
    public function getTypeName(): string
    {
        return 'GenericCustomPostEnum';
    }

    /**
     * @return string[]
     */
    public function getEnumValues(): array
    {
        return ComponentConfiguration::getGenericCustomPostTypes();
    }
}