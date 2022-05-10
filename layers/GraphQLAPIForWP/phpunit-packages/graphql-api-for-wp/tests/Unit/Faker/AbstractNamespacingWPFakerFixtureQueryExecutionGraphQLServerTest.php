<?php

declare(strict_types=1);

namespace PHPUnitForGraphQLAPI\GraphQLAPI\Unit\Faker;

use GraphQLByPoP\GraphQLServer\Unit\EnabledDisabledFixtureQueryExecutionGraphQLServerTestCaseTrait;
use PHPUnitForGraphQLAPI\WPFakerSchema\Unit\AbstractWPFakerFixtureQueryExecutionGraphQLServerTest;

abstract class AbstractNamespacingWPFakerFixtureQueryExecutionGraphQLServerTest extends AbstractWPFakerFixtureQueryExecutionGraphQLServerTest
{
    use EnabledDisabledFixtureQueryExecutionGraphQLServerTestCaseTrait;

    /**
     * Directory under the fixture files are placed
     */
    protected function getFixtureFolder(): string
    {
        return __DIR__ . '/fixture-namespacing';
    }

    /**
     * @return string[]
     */
    protected static function getGraphQLServerComponentClasses(): array
    {
        return [
            ...parent::getGraphQLServerComponentClasses(),
            ...[
                \PoPWPSchema\Users\Component::class,
                \PoPWPSchema\Posts\Component::class,
            ]
        ];
    }

    /**
     * @return array<string,mixed>
     */
    protected static function getGraphQLServerComponentClassConfiguration(): array
    {
        return [
            ...parent::getGraphQLServerComponentClassConfiguration(),
            ...[
                \PoP\ComponentModel\Component::class => [
                    \PoP\ComponentModel\Environment::NAMESPACE_TYPES_AND_INTERFACES => static::isEnabled(),
                ],
            ]
        ];
    }
}
