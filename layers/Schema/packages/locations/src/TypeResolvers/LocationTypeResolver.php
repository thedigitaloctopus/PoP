<?php

declare(strict_types=1);

namespace PoPSchema\Locations\TypeResolvers;

use PoPSchema\Locations\TypeDataLoaders\LocationTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\AbstractTypeResolver;
use PoPSchema\Locations\Facades\LocationTypeAPIFacade;

class LocationTypeResolver extends AbstractTypeResolver
{
    public function getTypeName(): string
    {
        return 'Location';
    }

    public function getSchemaTypeDescription(): ?string
    {
        return $this->translationAPI->__('Representation of a location entity, with a name, address and coordinates', 'locations');
    }

    public function getID(object $resultItem): string | int
    {
        $locationTypeAPI = LocationTypeAPIFacade::getInstance();
        return $locationTypeAPI->getID($resultItem);
    }

    public function getTypeDataLoaderClass(): string
    {
        return LocationTypeDataLoader::class;
    }
}
