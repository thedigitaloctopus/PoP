<?php

declare(strict_types=1);

namespace PoPSchema\GenericCustomPosts\TypeResolvers\ObjectType;

use PoP\ComponentModel\AttachableExtensions\AttachableExtensionManagerInterface;
use PoP\ComponentModel\DirectivePipeline\DirectivePipelineServiceInterface;
use PoP\ComponentModel\Engine\DataloadingEngineInterface;
use PoP\ComponentModel\ErrorHandling\ErrorProviderInterface;
use PoP\ComponentModel\Instances\InstanceManagerInterface;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
use PoP\ComponentModel\Schema\FeedbackMessageStoreInterface;
use PoP\ComponentModel\Schema\FieldQueryInterpreterInterface;
use PoP\ComponentModel\Schema\SchemaDefinitionServiceInterface;
use PoP\ComponentModel\Schema\SchemaNamespacingServiceInterface;
use PoP\Hooks\HooksAPIInterface;
use PoP\Translation\TranslationAPIInterface;
use PoPSchema\CustomPosts\TypeAPIs\CustomPostTypeAPIInterface;
use PoPSchema\CustomPosts\TypeResolvers\ObjectType\AbstractCustomPostObjectTypeResolver;
use PoPSchema\GenericCustomPosts\RelationalTypeDataLoaders\ObjectType\GenericCustomPostTypeDataLoader;

class GenericCustomPostObjectTypeResolver extends AbstractCustomPostObjectTypeResolver
{
    public function __construct(
        TranslationAPIInterface $translationAPI,
        HooksAPIInterface $hooksAPI,
        InstanceManagerInterface $instanceManager,
        SchemaNamespacingServiceInterface $schemaNamespacingService,
        SchemaDefinitionServiceInterface $schemaDefinitionService,
        AttachableExtensionManagerInterface $attachableExtensionManager,
        FeedbackMessageStoreInterface $feedbackMessageStore,
        FieldQueryInterpreterInterface $fieldQueryInterpreter,
        ErrorProviderInterface $errorProvider,
        DataloadingEngineInterface $dataloadingEngine,
        DirectivePipelineServiceInterface $directivePipelineService,
        CustomPostTypeAPIInterface $customPostTypeAPI,
        protected GenericCustomPostTypeDataLoader $genericCustomPostTypeDataLoader,
    ) {
        parent::__construct(
            $translationAPI,
            $hooksAPI,
            $instanceManager,
            $schemaNamespacingService,
            $schemaDefinitionService,
            $attachableExtensionManager,
            $feedbackMessageStore,
            $fieldQueryInterpreter,
            $errorProvider,
            $dataloadingEngine,
            $directivePipelineService,
            $customPostTypeAPI,
        );
    }

    public function getTypeName(): string
    {
        return 'GenericCustomPost';
    }

    public function getSchemaTypeDescription(): ?string
    {
        return $this->translationAPI->__('Any custom post, with or without its own type for the schema', 'customposts');
    }

    public function getRelationalTypeDataLoader(): RelationalTypeDataLoaderInterface
    {
        return $this->genericCustomPostTypeDataLoader;
    }
}
