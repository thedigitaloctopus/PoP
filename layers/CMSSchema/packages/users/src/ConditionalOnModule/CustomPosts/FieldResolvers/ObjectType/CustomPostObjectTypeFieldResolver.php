<?php

declare(strict_types=1);

namespace PoPCMSSchema\Users\ConditionalOnModule\CustomPosts\FieldResolvers\ObjectType;

use PoP\ComponentModel\FieldResolvers\InterfaceType\InterfaceTypeFieldResolverInterface;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoPCMSSchema\CustomPosts\TypeResolvers\ObjectType\AbstractCustomPostObjectTypeResolver;
use PoPCMSSchema\Users\ConditionalOnModule\CustomPosts\TypeAPIs\CustomPostUserTypeAPIInterface;
use PoPCMSSchema\Users\FieldResolvers\InterfaceType\WithAuthorInterfaceTypeFieldResolver;

class CustomPostObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    private ?CustomPostUserTypeAPIInterface $customPostUserTypeAPI = null;
    private ?WithAuthorInterfaceTypeFieldResolver $withAuthorInterfaceTypeFieldResolver = null;

    final public function setCustomPostUserTypeAPI(CustomPostUserTypeAPIInterface $customPostUserTypeAPI): void
    {
        $this->customPostUserTypeAPI = $customPostUserTypeAPI;
    }
    final protected function getCustomPostUserTypeAPI(): CustomPostUserTypeAPIInterface
    {
        /** @var CustomPostUserTypeAPIInterface */
        return $this->customPostUserTypeAPI ??= $this->instanceManager->getInstance(CustomPostUserTypeAPIInterface::class);
    }
    final public function setWithAuthorInterfaceTypeFieldResolver(WithAuthorInterfaceTypeFieldResolver $withAuthorInterfaceTypeFieldResolver): void
    {
        $this->withAuthorInterfaceTypeFieldResolver = $withAuthorInterfaceTypeFieldResolver;
    }
    final protected function getWithAuthorInterfaceTypeFieldResolver(): WithAuthorInterfaceTypeFieldResolver
    {
        /** @var WithAuthorInterfaceTypeFieldResolver */
        return $this->withAuthorInterfaceTypeFieldResolver ??= $this->instanceManager->getInstance(WithAuthorInterfaceTypeFieldResolver::class);
    }

    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo(): array
    {
        return [
            AbstractCustomPostObjectTypeResolver::class,
        ];
    }

    /**
     * @return array<InterfaceTypeFieldResolverInterface>
     */
    public function getImplementedInterfaceTypeFieldResolvers(): array
    {
        return [
            $this->getWithAuthorInterfaceTypeFieldResolver(),
        ];
    }

    /**
     * @return string[]
     */
    public function getFieldNamesToResolve(): array
    {
        return [
            'author',
        ];
    }

    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ?string
    {
        return match ($fieldName) {
            'author' => $this->__('The post\'s author', ''),
            default => parent::getFieldDescription($objectTypeResolver, $fieldName),
        };
    }

    public function resolveValue(
        ObjectTypeResolverInterface $objectTypeResolver,
        object $object,
        FieldDataAccessorInterface $fieldDataAccessor,
        ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore,
    ): mixed {
        switch ($fieldDataAccessor->getFieldName()) {
            case 'author':
                /** @var string|int */
                return $this->getCustomPostUserTypeAPI()->getAuthorID($object);
        }

        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
}
