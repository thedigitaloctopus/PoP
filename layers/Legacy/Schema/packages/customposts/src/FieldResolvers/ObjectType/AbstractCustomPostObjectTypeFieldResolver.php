<?php

declare(strict_types=1);

namespace PoPSchema\CustomPosts\FieldResolvers\ObjectType;

use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\Engine\Facades\Formatters\DateFormatterFacade;
use PoPSchema\CustomPosts\Facades\CustomPostTypeAPIFacade;
use PoPSchema\CustomPosts\FieldResolvers\InterfaceType\IsCustomPostInterfaceTypeFieldResolver;
use PoPSchema\CustomPosts\TypeAPIs\CustomPostTypeAPIInterface;

abstract class AbstractCustomPostObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    public function getFieldNamesToResolve(): array
    {
        return [];
    }

    public function getImplementedInterfaceTypeFieldResolverClasses(): array
    {
        return [
            IsCustomPostInterfaceTypeFieldResolver::class,
        ];
    }

    protected function getCustomPostTypeAPI(): CustomPostTypeAPIInterface
    {
        $customPostTypeAPI = CustomPostTypeAPIFacade::getInstance();
        return $customPostTypeAPI;
    }

    /**
     * @param array<string, mixed> $fieldArgs
     * @param array<string, mixed>|null $variables
     * @param array<string, mixed>|null $expressions
     * @param array<string, mixed> $options
     */
    public function resolveValue(
        ObjectTypeResolverInterface $objectTypeResolver,
        object $object,
        string $fieldName,
        array $fieldArgs = [],
        ?array $variables = null,
        ?array $expressions = null,
        array $options = []
    ): mixed {
        $dateFormatter = DateFormatterFacade::getInstance();
        $customPostTypeAPI = $this->getCustomPostTypeAPI();
        $customPost = $object;
        switch ($fieldName) {
            case 'datetime':
                // If it is the current year, don't add the year. Otherwise, do
                // 15 Jul, 21:47 or // 15 Jul 2018, 21:47
                $date = $customPostTypeAPI->getPublishedDate($customPost);
                $format = $fieldArgs['format'];
                if (!$format) {
                    $format = ($dateFormatter->format('Y', $date) == date('Y')) ? 'j M, H:i' : 'j M Y, H:i';
                }
                return $dateFormatter->format($format, $date);
        }

        return parent::resolveValue($objectTypeResolver, $object, $fieldName, $fieldArgs, $variables, $expressions, $options);
    }
}