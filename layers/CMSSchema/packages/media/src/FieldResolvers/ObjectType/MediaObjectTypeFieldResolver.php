<?php

declare(strict_types=1);

namespace PoPCMSSchema\Media\FieldResolvers\ObjectType;

use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Component\Component;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use DateTime;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractQueryableObjectTypeFieldResolver;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoPCMSSchema\SchemaCommons\Formatters\DateFormatterInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoPCMSSchema\Media\TypeAPIs\MediaTypeAPIInterface;
use PoPCMSSchema\Media\TypeResolvers\ObjectType\MediaObjectTypeResolver;
use PoPCMSSchema\SchemaCommons\ComponentProcessors\CommonFilterInputContainerComponentProcessor;
use PoPSchema\SchemaCommons\TypeResolvers\ScalarType\DateTimeScalarTypeResolver;
use PoPSchema\SchemaCommons\TypeResolvers\ScalarType\URLScalarTypeResolver;

class MediaObjectTypeFieldResolver extends AbstractQueryableObjectTypeFieldResolver
{
    private ?MediaTypeAPIInterface $mediaTypeAPI = null;
    private ?DateFormatterInterface $dateFormatter = null;
    private ?URLScalarTypeResolver $urlScalarTypeResolver = null;
    private ?IntScalarTypeResolver $intScalarTypeResolver = null;
    private ?StringScalarTypeResolver $stringScalarTypeResolver = null;
    private ?DateTimeScalarTypeResolver $dateTimeScalarTypeResolver = null;

    final public function setMediaTypeAPI(MediaTypeAPIInterface $mediaTypeAPI): void
    {
        $this->mediaTypeAPI = $mediaTypeAPI;
    }
    final protected function getMediaTypeAPI(): MediaTypeAPIInterface
    {
        /** @var MediaTypeAPIInterface */
        return $this->mediaTypeAPI ??= $this->instanceManager->getInstance(MediaTypeAPIInterface::class);
    }
    final public function setDateFormatter(DateFormatterInterface $dateFormatter): void
    {
        $this->dateFormatter = $dateFormatter;
    }
    final protected function getDateFormatter(): DateFormatterInterface
    {
        /** @var DateFormatterInterface */
        return $this->dateFormatter ??= $this->instanceManager->getInstance(DateFormatterInterface::class);
    }
    final public function setURLScalarTypeResolver(URLScalarTypeResolver $urlScalarTypeResolver): void
    {
        $this->urlScalarTypeResolver = $urlScalarTypeResolver;
    }
    final protected function getURLScalarTypeResolver(): URLScalarTypeResolver
    {
        /** @var URLScalarTypeResolver */
        return $this->urlScalarTypeResolver ??= $this->instanceManager->getInstance(URLScalarTypeResolver::class);
    }
    final public function setIntScalarTypeResolver(IntScalarTypeResolver $intScalarTypeResolver): void
    {
        $this->intScalarTypeResolver = $intScalarTypeResolver;
    }
    final protected function getIntScalarTypeResolver(): IntScalarTypeResolver
    {
        /** @var IntScalarTypeResolver */
        return $this->intScalarTypeResolver ??= $this->instanceManager->getInstance(IntScalarTypeResolver::class);
    }
    final public function setStringScalarTypeResolver(StringScalarTypeResolver $stringScalarTypeResolver): void
    {
        $this->stringScalarTypeResolver = $stringScalarTypeResolver;
    }
    final protected function getStringScalarTypeResolver(): StringScalarTypeResolver
    {
        /** @var StringScalarTypeResolver */
        return $this->stringScalarTypeResolver ??= $this->instanceManager->getInstance(StringScalarTypeResolver::class);
    }
    final public function setDateTimeScalarTypeResolver(DateTimeScalarTypeResolver $dateTimeScalarTypeResolver): void
    {
        $this->dateTimeScalarTypeResolver = $dateTimeScalarTypeResolver;
    }
    final protected function getDateTimeScalarTypeResolver(): DateTimeScalarTypeResolver
    {
        /** @var DateTimeScalarTypeResolver */
        return $this->dateTimeScalarTypeResolver ??= $this->instanceManager->getInstance(DateTimeScalarTypeResolver::class);
    }

    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo(): array
    {
        return [
            MediaObjectTypeResolver::class,
        ];
    }

    /**
     * @return string[]
     */
    public function getFieldNamesToResolve(): array
    {
        return [
            'src',
            'srcSet',
            'width',
            'height',
            'sizes',
            'title',
            'caption',
            'altText',
            'description',
            'date',
            'dateStr',
            'modifiedDate',
            'modifiedDateStr',
            'mimeType',
        ];
    }

    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ConcreteTypeResolverInterface
    {
        return match ($fieldName) {
            'src' => $this->getURLScalarTypeResolver(),
            'srcSet' => $this->getStringScalarTypeResolver(),
            'width' => $this->getIntScalarTypeResolver(),
            'height' => $this->getIntScalarTypeResolver(),
            'sizes' => $this->getStringScalarTypeResolver(),
            'title' => $this->getStringScalarTypeResolver(),
            'caption' => $this->getStringScalarTypeResolver(),
            'altText' => $this->getStringScalarTypeResolver(),
            'description' => $this->getStringScalarTypeResolver(),
            'date' => $this->getDateTimeScalarTypeResolver(),
            'dateStr' => $this->getStringScalarTypeResolver(),
            'modifiedDate' => $this->getDateTimeScalarTypeResolver(),
            'modifiedDateStr' => $this->getStringScalarTypeResolver(),
            'mimeType' => $this->getStringScalarTypeResolver(),
            default => parent::getFieldTypeResolver($objectTypeResolver, $fieldName),
        };
    }

    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): int
    {
        return match ($fieldName) {
            'src',
            'date',
            'dateStr',
            'modifiedDate',
            'modifiedDateStr'
                => SchemaTypeModifiers::NON_NULLABLE,
            default
                => parent::getFieldTypeModifiers($objectTypeResolver, $fieldName),
        };
    }

    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ?string
    {
        return match ($fieldName) {
            'src' => $this->__('Media element URL source', 'pop-media'),
            'srcSet' => $this->__('Media element URL srcset', 'pop-media'),
            'width' => $this->__('Media element\'s width', 'pop-media'),
            'height' => $this->__('Media element\'s height', 'pop-media'),
            'sizes' => $this->__('Media element\'s ‘sizes’ attribute value for an image', 'pop-media'),
            'title' => $this->__('Media element title', 'pop-media'),
            'caption' => $this->__('Media element caption', 'pop-media'),
            'altText' => $this->__('Media element alt text', 'pop-media'),
            'description' => $this->__('Media element description', 'pop-media'),
            'date' => $this->__('Media element\'s published date', 'pop-media'),
            'dateStr' => $this->__('Media element\'s published date, in String format', 'pop-media'),
            'modifiedDate' => $this->__('Media element\'s modified date', 'pop-media'),
            'modifiedDateStr' => $this->__('Media element\'s modified date, in String format', 'pop-media'),
            'mimeType' => $this->__('Media element\'s mime type', 'pop-media'),
            default => parent::getFieldDescription($objectTypeResolver, $fieldName),
        };
    }

    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getFieldArgNameTypeResolvers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): array
    {
        return match ($fieldName) {
            'src',
            'srcSet',
            'width',
            'height',
            'sizes'
                => [
                    'size' => $this->getStringScalarTypeResolver(),
                ],
            default
                => parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName),
        };
    }

    public function getFieldArgDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName): ?string
    {
        return match ($fieldArgName) {
            'size' => $this->__('Size of the image', 'pop-media'),
            default => parent::getFieldArgDescription($objectTypeResolver, $fieldName, $fieldArgName),
        };
    }

    public function getFieldFilterInputContainerComponent(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ?Component
    {
        return match ($fieldName) {
            'date' => new Component(CommonFilterInputContainerComponentProcessor::class, CommonFilterInputContainerComponentProcessor::COMPONENT_FILTERINPUTCONTAINER_GMTDATE),
            'dateStr' => new Component(CommonFilterInputContainerComponentProcessor::class, CommonFilterInputContainerComponentProcessor::COMPONENT_FILTERINPUTCONTAINER_GMTDATE_AS_STRING),
            'modifiedDate' => new Component(CommonFilterInputContainerComponentProcessor::class, CommonFilterInputContainerComponentProcessor::COMPONENT_FILTERINPUTCONTAINER_GMTDATE),
            'modifiedDateStr' => new Component(CommonFilterInputContainerComponentProcessor::class, CommonFilterInputContainerComponentProcessor::COMPONENT_FILTERINPUTCONTAINER_GMTDATE_AS_STRING),
            default => parent::getFieldFilterInputContainerComponent($objectTypeResolver, $fieldName),
        };
    }

    public function resolveValue(
        ObjectTypeResolverInterface $objectTypeResolver,
        object $object,
        FieldDataAccessorInterface $fieldDataAccessor,
        ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore,
    ): mixed {
        $media = $object;
        $size = $this->obtainImageSizeFromParameters($fieldDataAccessor);
        switch ($fieldDataAccessor->getFieldName()) {
            case 'src':
                // The media item may be an image, or a video or audio.
                // If image, $imgSrc will have a value. Otherwise, get the URL
                $imgSrc = $this->getMediaTypeAPI()->getImageSrc($media, $size);
                if ($imgSrc !== null) {
                    return $imgSrc;
                }
                return $this->getMediaTypeAPI()->getMediaItemSrc($media);
            case 'width':
            case 'height':
                $properties = $this->getMediaTypeAPI()->getImageProperties($media, $size);
                return $properties[$fieldDataAccessor->getFieldName()] ?? null;
            case 'srcSet':
                return $this->getMediaTypeAPI()->getImageSrcSet($media, $size);
            case 'sizes':
                return $this->getMediaTypeAPI()->getImageSizes($media, $size);
            case 'title':
                return $this->getMediaTypeAPI()->getTitle($media);
            case 'caption':
                return $this->getMediaTypeAPI()->getCaption($media);
            case 'altText':
                return $this->getMediaTypeAPI()->getAltText($media);
            case 'description':
                return $this->getMediaTypeAPI()->getDescription($media);
            case 'date':
                /** @var string */
                $date = $this->getMediaTypeAPI()->getDate($media, $fieldDataAccessor->getValue('gmt'));
                return new DateTime($date);
            case 'dateStr':
                /** @var string */
                $date = $this->getMediaTypeAPI()->getDate($media, $fieldDataAccessor->getValue('gmt'));
                return $this->getDateFormatter()->format(
                    $fieldDataAccessor->getValue('format'),
                    $date
                );
            case 'modifiedDate':
                /** @var string */
                $modifiedDate = $this->getMediaTypeAPI()->getModified($media, $fieldDataAccessor->getValue('gmt'));
                return new DateTime($modifiedDate);
            case 'modifiedDateStr':
                /** @var string */
                $modifiedDate = $this->getMediaTypeAPI()->getModified($media, $fieldDataAccessor->getValue('gmt'));
                return $this->getDateFormatter()->format(
                    $fieldDataAccessor->getValue('format'),
                    $modifiedDate
                );
            case 'mimeType':
                return $this->getMediaTypeAPI()->getMimeType($media);
        }

        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }

    protected function obtainImageSizeFromParameters(FieldDataAccessorInterface $fieldDataAccessor): ?string
    {
        return $fieldDataAccessor->getValue('size');
    }
}
