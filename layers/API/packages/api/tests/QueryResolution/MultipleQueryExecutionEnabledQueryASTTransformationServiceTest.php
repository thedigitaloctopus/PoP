<?php

declare(strict_types=1);

namespace PoPAPI\API\QueryResolution;

class MultipleQueryExecutionEnabledQueryASTTransformationServiceTest extends AbstractMultipleQueryExecutionDisabledQueryASTTransformationServiceTest
{
    protected static function enabled(): bool
    {
        return true;
    }
}
