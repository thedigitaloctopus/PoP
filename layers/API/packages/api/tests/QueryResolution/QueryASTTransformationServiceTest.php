<?php

declare(strict_types=1);

namespace PoPAPI\API\QueryResolution;

use PoP\GraphQLParser\Spec\Parser\Ast\Argument;
use PoP\GraphQLParser\Spec\Parser\Ast\ArgumentValue\Literal;
use PoP\GraphQLParser\Spec\Parser\Ast\Fragment;
use PoP\GraphQLParser\Spec\Parser\Ast\FragmentReference;
use PoP\GraphQLParser\Spec\Parser\Ast\LeafField;
use PoP\GraphQLParser\Spec\Parser\Ast\QueryOperation;
use PoP\GraphQLParser\Spec\Parser\Ast\RelationalField;
use PoP\GraphQLParser\Spec\Parser\Location;
use PoP\Root\AbstractTestCase;

class QueryASTTransformationServiceTest extends AbstractTestCase
{
    protected function getQueryASTTransformationService(): QueryASTTransformationServiceInterface
    {
        return $this->getService(QueryASTTransformationServiceInterface::class);
    }

    /**
     * This is the AST for this GraphQL query:
     *
     *   ```
     *   query {
     *     film(id: 1) { # level 1
     *       title # level 2
     *       director { # level 2
     *         name # level 3 # <= maximum depth!
     *       }
     *     }
     *     post(id: 2) { # level 1
     *       title # level 2
     *     }
     *   }
     *   ```
     */
    public function testOperationMaximumFieldDepth()
    {
        $leafField2 = new LeafField('name', null, [], [], new Location(6, 23));
        $relationalField2 = new RelationalField(
            'director',
            null,
            [],
            [
                $leafField2,
            ],
            [],
            new Location(5, 21)
        );
        $leafField1 = new LeafField('title', null, [], [], new Location(4, 21));
        $argument1 = new Argument('id', new Literal(1, new Location(3, 26)), new Location(3, 22));
        $relationalField1 = new RelationalField(
            'film',
            null,
            [
                $argument1,
            ],
            [
                $leafField1,
                $relationalField2,
            ],
            [],
            new Location(3, 17)
        );
        $argument2 = new Argument('id', new Literal(2, new Location(9, 26)), new Location(9, 22));
        $leafField3 = new LeafField('title', null, [], [], new Location(10, 21));
        $relationalField3 = new RelationalField(
            'post',
            null,
            [
                $argument2,
            ],
            [
                $leafField3,
            ],
            [],
            new Location(9, 17)
        );
        $operation = new QueryOperation(
            '',
            [],
            [],
            [
                $relationalField1,
                $relationalField3,
            ],
            new Location(8, 19)
        );
        $operationMaximumFieldDepth = $this->getQueryASTTransformationService()->getOperationMaximumFieldDepth($operation, []);
        $this->assertEquals(
            3,
            $operationMaximumFieldDepth
        );
    }

    /**
     * Also append a Fragment Reference and recalculate:
     *
     *   ```
     *   query {
     *     film(id: 1) { # level 1
     *       title # level 2
     *       director { # level 2
     *         name # level 3 # <= maximum depth!
     *       }
     *     }
     *     post(id: 2) { # level 1
     *       title # level 2
     *     }
     *     ...RootData
     *   }
     *
     *   fragment RootData on QueryRoot {
     *     id
     *     self {
     *       id
     *     }
     *   }
     *   ```
     */
    public function testOperationMaximumFieldDepthWithFragment()
    {
        $leafField2 = new LeafField('name', null, [], [], new Location(6, 23));
        $relationalField2 = new RelationalField(
            'director',
            null,
            [],
            [
                $leafField2,
            ],
            [],
            new Location(5, 21)
        );
        $leafField1 = new LeafField('title', null, [], [], new Location(4, 21));
        $argument1 = new Argument('id', new Literal(1, new Location(3, 26)), new Location(3, 22));
        $relationalField1 = new RelationalField(
            'film',
            null,
            [
                $argument1,
            ],
            [
                $leafField1,
                $relationalField2,
            ],
            [],
            new Location(3, 17)
        );
        $argument2 = new Argument('id', new Literal(2, new Location(9, 26)), new Location(9, 22));
        $leafField3 = new LeafField('title', null, [], [], new Location(10, 21));
        $relationalField3 = new RelationalField(
            'post',
            null,
            [
                $argument2,
            ],
            [
                $leafField3,
            ],
            [],
            new Location(9, 17)
        );

        $fragmentReference = new FragmentReference('RootData', new Location(12, 17));
        $operation = new QueryOperation(
            '',
            [],
            [],
            [
                $relationalField1,
                $relationalField3,
                $fragmentReference,
            ],
            new Location(8, 19)
        );

        $fragmentFields = [
            new LeafField('id', null, [], [], new Location(16, 17)),
            new RelationalField('id', null, [], [
                new LeafField('id', null, [], [], new Location(18, 19))
            ], [], new Location(17, 17)),
        ];
        $fragment = new Fragment('RootData', 'QueryRoot', [], $fragmentFields, new Location(15, 15));
        $fragments = [
            $fragment,
        ];

        $operationMaximumFieldDepth = $this->getQueryASTTransformationService()->getOperationMaximumFieldDepth($operation, $fragments);
        $this->assertEquals(
            6,
            $operationMaximumFieldDepth
        );
    }
}
