<?php

declare(strict_types=1);

namespace PoPSchema\Menus\TypeResolvers\ObjectType;

use Symfony\Contracts\Service\Attribute\Required;
use PoP\ComponentModel\Engine\DataloadingEngineInterface;
use PoP\ComponentModel\AttachableExtensions\AttachableExtensionManagerInterface;
use PoP\ComponentModel\DirectivePipeline\DirectivePipelineServiceInterface;
use PoP\Translation\TranslationAPIInterface;
use PoP\Hooks\HooksAPIInterface;
use PoP\ComponentModel\Instances\InstanceManagerInterface;
use PoP\ComponentModel\Schema\SchemaNamespacingServiceInterface;
use PoP\ComponentModel\Schema\SchemaDefinitionServiceInterface;
use PoP\ComponentModel\Schema\FeedbackMessageStoreInterface;
use PoP\ComponentModel\Schema\FieldQueryInterpreterInterface;
use PoP\ComponentModel\ErrorHandling\ErrorProviderInterface;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\AbstractObjectTypeResolver;
use PoPSchema\Menus\ObjectModels\MenuItem;
use PoPSchema\Menus\RelationalTypeDataLoaders\ObjectType\MenuItemTypeDataLoader;

class MenuItemObjectTypeResolver extends AbstractObjectTypeResolver
{
    protected MenuItemTypeDataLoader $menuItemTypeDataLoader;
    
    #[Required]
    public function autowireMenuItemObjectTypeResolver(
        MenuItemTypeDataLoader $menuItemTypeDataLoader,
    ) {
        $this->menuItemTypeDataLoader = $menuItemTypeDataLoader;
    }

    public function getTypeName(): string
    {
        return 'MenuItem';
    }

    public function getSchemaTypeDescription(): ?string
    {
        return $this->translationAPI->__('Items (links, pages, etc) added to a menu', 'menus');
    }

    public function getID(object $object): string | int | null
    {
        /** @var MenuItem */
        $menuItem = $object;
        return $menuItem->id;
    }

    public function getRelationalTypeDataLoader(): RelationalTypeDataLoaderInterface
    {
        return $this->menuItemTypeDataLoader;
    }
}
