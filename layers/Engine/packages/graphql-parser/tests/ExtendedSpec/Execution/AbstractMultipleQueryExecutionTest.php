<?php

declare(strict_types=1);

namespace PoP\GraphQLParser\ExtendedSpec\Execution;

use PoP\GraphQLParser\Spec\Execution\Context;
use PoP\GraphQLParser\Spec\Parser\Ast\Argument;
use PoP\GraphQLParser\Spec\Parser\Ast\ArgumentValue\Literal;
use PoP\GraphQLParser\Spec\Parser\Ast\LeafField;
use PoP\GraphQLParser\Spec\Parser\Ast\QueryOperation;
use PoP\GraphQLParser\Spec\Parser\Ast\RelationalField;
use PoP\GraphQLParser\Spec\Parser\Location;
use PoP\GraphQLParser\Spec\Parser\ParserInterface;
use PoP\Root\AbstractTestCase;

abstract class AbstractMultipleQueryExecutionTest extends AbstractTestCase
{
    /**
     * @return array<string, mixed> [key]: Component class, [value]: Configuration
     */
    protected static function getComponentClassConfiguration(): array
    {
        $componentClassConfiguration = parent::getComponentClassConfiguration();
        $componentClassConfiguration[\PoP\GraphQLParser\Component::class][\PoP\GraphQLParser\Environment::ENABLE_MULTIPLE_QUERY_EXECUTION] = static::enabled();
        return $componentClassConfiguration;
    }

    abstract protected static function enabled(): bool;

    protected function getParser(): ParserInterface
    {
        return $this->getService(ParserInterface::class);
    }

    public function testMultipleQueryExecution(): void
    {
        $parser = $this->getParser();
        $document = $parser->parse('
            query One {
                film(id: 1) {
                    title
                }
            }

            query Two {
                post(id: 2) {
                    title
                }
            }

            query __ALL {
              id
            }
        ');
        $context = new Context('__ALL');
        $executableDocument = new ExecutableDocument($document, $context);
        $executableDocument->validateAndInitialize();
        $allQueryOperation = new QueryOperation(
            '__ALL',
            [],
            [],
            [
                new LeafField('id', null, [], [], new Location(15, 15))
            ],
            new Location(14, 19)
        );
        $this->assertEquals(
            $this->enabled() ?
                [
                    new QueryOperation('One', [], [], [
                        new RelationalField('film', null, [
                            new Argument('id', new Literal(1, new Location(3, 26)), new Location(3, 22)),
                        ], [
                            new LeafField('title', null, [], [], new Location(4, 21)),
                        ], [], new Location(3, 17))
                    ], new Location(2, 19)),
                    new QueryOperation('Two', [], [], [
                        new RelationalField('post', null, [
                            new Argument('id', new Literal(2, new Location(9, 26)), new Location(9, 22)),
                        ], [
                            new LeafField('title', null, [], [], new Location(10, 21)),
                        ], [], new Location(9, 17))
                    ], new Location(8, 19)),
                    $allQueryOperation,
                ] : [
                    $allQueryOperation,
                ],
            $executableDocument->getRequestedOperations()
        );
    }
}