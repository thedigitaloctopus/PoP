<?php

declare(strict_types=1);

namespace PoP\GraphQLParser\Exception\Parser;

use PoP\GraphQLParser\Exception\LocationableExceptionInterface;
use PoP\GraphQLParser\Spec\Parser\Location;
use PoP\Root\Exception\AbstractException;

abstract class AbstractParserException extends AbstractException implements LocationableExceptionInterface
{
    public function __construct(
        string $message,
        private string $namespacedCode,
        private Location $location,
    ) {
        parent::__construct($message);
    }

    public function getNamespacedCode(): string
    {
        return $this->namespacedCode;
    }

    public function getLocation(): Location
    {
        return $this->location;
    }
}