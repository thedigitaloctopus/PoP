<?php

declare(strict_types=1);

namespace GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType;

use PoP\ComponentModel\TypeResolvers\ObjectType\AbstractObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\ReservedNameTypeResolverTrait;

abstract class AbstractIntrospectionObjectTypeResolver extends AbstractObjectTypeResolver
{
    use ReservedNameTypeResolverTrait;

    /**
     * Introspection types must not be namespaced
     */
    public function getNamespace(): string
    {
        return '';
    }
}
