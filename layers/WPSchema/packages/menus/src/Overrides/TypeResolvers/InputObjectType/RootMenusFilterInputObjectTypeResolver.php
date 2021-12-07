<?php

declare(strict_types=1);

namespace PoPWPSchema\Menus\Overrides\TypeResolvers\InputObjectType;

use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoPSchema\Menus\TypeResolvers\InputObjectType\RootMenusFilterInputObjectTypeResolver as UpstreamRootMenusFilterInputObjectTypeResolver;
use PoPWPSchema\Menus\FilterInputProcessors\FilterInputProcessor;
use PoPWPSchema\Menus\TypeResolvers\EnumType\MenuLocationEnumTypeResolver;

class RootMenusFilterInputObjectTypeResolver extends UpstreamRootMenusFilterInputObjectTypeResolver
{
    private ?MenuLocationEnumTypeResolver $menuLocationEnumTypeResolver = null;

    final public function setMenuLocationEnumTypeResolver(MenuLocationEnumTypeResolver $menuLocationEnumTypeResolver): void
    {
        $this->menuLocationEnumTypeResolver = $menuLocationEnumTypeResolver;
    }
    final protected function getMenuLocationEnumTypeResolver(): MenuLocationEnumTypeResolver
    {
        return $this->menuLocationEnumTypeResolver ??= $this->instanceManager->getInstance(MenuLocationEnumTypeResolver::class);
    }

    public function getInputFieldNameTypeResolvers(): array
    {
        return array_merge(
            parent::getInputFieldNameTypeResolvers(),
            [
                'locations' => $this->getMenuLocationEnumTypeResolver(),
            ],
        );
    }

    public function getInputFieldDescription(string $inputFieldName): ?string
    {
        return match ($inputFieldName) {
            'locations' => $this->getTranslationAPI()->__('Filter menus based on locations', 'menus'),
            default => parent::getInputFieldDescription($inputFieldName),
        };
    }

    public function getInputFieldTypeModifiers(string $inputFieldName): int
    {
        return match ($inputFieldName) {
            'locations' => SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY,
            default => parent::getInputFieldTypeModifiers($inputFieldName)
        };
    }

    public function getInputFieldFilterInput(string $inputFieldName): ?array
    {
        return match ($inputFieldName) {
            'locations' => [FilterInputProcessor::class, FilterInputProcessor::FILTERINPUT_LOCATIONS],
            default => parent::getInputFieldFilterInput($inputFieldName),
        };
    }
}