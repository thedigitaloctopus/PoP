<?php

declare(strict_types=1);

namespace PoP\CacheControl\Helpers;

use PoP\CacheControl\DirectiveResolvers\CacheControlDirectiveResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\Argument;
use PoP\GraphQLParser\Spec\Parser\Ast\ArgumentValue\Literal;
use PoP\GraphQLParser\Spec\Parser\Ast\Directive;
use PoP\GraphQLParser\ASTNodes\ASTNodesFactory;
use PoP\Root\Facades\Instances\InstanceManagerFacade;

class CacheControlHelper
{
    protected static ?Directive $noCacheDirective = null;

    final protected static function getCacheControlDirectiveResolver(): CacheControlDirectiveResolver
    {
        $instanceManager = InstanceManagerFacade::getInstance();
        /** @var CacheControlDirectiveResolver */
        return $instanceManager->getInstance(CacheControlDirectiveResolver::class);
    }

    public static function getNoCacheDirective(): Directive
    {
        if (self::$noCacheDirective === null) {
            self::$noCacheDirective = new Directive(
                static::getCacheControlDirectiveResolver()->getDirectiveName(),
                [
                    new Argument(
                        'maxAge',
                        new Literal(
                            0,
                            ASTNodesFactory::getNonSpecificLocation()
                        ),
                        ASTNodesFactory::getNonSpecificLocation()
                    ),
                ],
                ASTNodesFactory::getNonSpecificLocation()
            );
        }
        return self::$noCacheDirective;
    }
}
