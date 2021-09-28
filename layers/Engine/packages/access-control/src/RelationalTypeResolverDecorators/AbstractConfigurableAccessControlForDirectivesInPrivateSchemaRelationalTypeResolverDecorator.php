<?php

declare(strict_types=1);

namespace PoP\AccessControl\RelationalTypeResolverDecorators;

use Symfony\Contracts\Service\Attribute\Required;
use PoP\ComponentModel\Instances\InstanceManagerInterface;
use PoP\AccessControl\Services\AccessControlManagerInterface;
use PoP\ComponentModel\Schema\FieldQueryInterpreterInterface;

abstract class AbstractConfigurableAccessControlForDirectivesInPrivateSchemaRelationalTypeResolverDecorator extends AbstractPrivateSchemaRelationalTypeResolverDecorator
{
    use ConfigurableAccessControlForDirectivesRelationalTypeResolverDecoratorTrait;
    protected AccessControlManagerInterface $accessControlManager;
    
    #[Required]
    public function autowireAbstractConfigurableAccessControlForDirectivesInPrivateSchemaRelationalTypeResolverDecorator(
        AccessControlManagerInterface $accessControlManager,
    ) {
        $this->accessControlManager = $accessControlManager;
    }
}
