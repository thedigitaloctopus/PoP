<?php

declare(strict_types=1);

namespace GraphQLByPoP\GraphQLServer\RelationalTypeDataLoaders\ObjectType;

use Symfony\Contracts\Service\Attribute\Required;
use PoP\Hooks\HooksAPIInterface;
use PoP\ComponentModel\Instances\InstanceManagerInterface;
use PoP\LooseContracts\NameResolverInterface;
use GraphQLByPoP\GraphQLServer\ObjectModels\QueryRoot;
use PoP\ComponentModel\RelationalTypeDataLoaders\ObjectType\AbstractObjectTypeDataLoader;

class QueryRootTypeDataLoader extends AbstractObjectTypeDataLoader
{
    protected QueryRoot $queryRoot;
    
    #[Required]
    public function autowireQueryRootTypeDataLoader(
        QueryRoot $queryRoot,
    ) {
        $this->queryRoot = $queryRoot;
    }

    public function getObjects(array $ids): array
    {
        return [
            $this->queryRoot,
        ];
    }
}
