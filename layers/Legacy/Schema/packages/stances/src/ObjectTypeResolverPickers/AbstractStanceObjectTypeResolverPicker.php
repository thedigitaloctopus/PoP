<?php

declare(strict_types=1);

namespace PoPSchema\Stances\ObjectTypeResolverPickers;

use Symfony\Contracts\Service\Attribute\Required;
use PoP\ComponentModel\ObjectTypeResolverPickers\AbstractObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoPSchema\Stances\Facades\StanceTypeAPIFacade;
use PoPSchema\Stances\TypeResolvers\ObjectType\StanceObjectTypeResolver;

abstract class AbstractStanceObjectTypeResolverPicker extends AbstractObjectTypeResolverPicker
{
    protected StanceObjectTypeResolver $stanceObjectTypeResolver;
    
    #[Required]
    public function autowireAbstractStanceObjectTypeResolverPicker(StanceObjectTypeResolver $stanceObjectTypeResolver)
    {
        $this->stanceObjectTypeResolver = $stanceObjectTypeResolver;
    }
    
    public function getObjectTypeResolver(): ObjectTypeResolverInterface
    {
        return $this->stanceObjectTypeResolver;
    }

    public function isInstanceOfType(object $object): bool
    {
        $stanceTypeAPI = StanceTypeAPIFacade::getInstance();
        return $stanceTypeAPI->isInstanceOfStanceType($object);
    }

    public function isIDOfType(string | int $objectID): bool
    {
        $stanceTypeAPI = StanceTypeAPIFacade::getInstance();
        return $stanceTypeAPI->stanceExists($objectID);
    }
}
