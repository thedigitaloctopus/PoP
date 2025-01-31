<?php
use PoP\ComponentModel\Facades\ComponentProcessors\ComponentProcessorManagerFacade;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\GraphQLParser\Spec\Parser\Ast\WithArgumentsInterface;
use PoP\Root\Facades\Translation\TranslationAPIFacade;
use PoPCMSSchema\CustomPostMutations\MutationResolvers\AbstractCreateUpdateCustomPostMutationResolver;
use PoPSitesWassup\CustomPostMutations\MutationResolverBridges\AbstractCreateUpdateCustomPostMutationResolverBridge;

class PoP_AddPostLinks_DataLoad_ActionExecuter_Hook
{
    public function __construct()
    {
        \PoP\Root\App::addAction(
            AbstractCreateUpdateCustomPostMutationResolverBridge::HOOK_FORM_DATA_CREATE_OR_UPDATE,
            $this->addMutationDataForFieldDataAccessor(...),
            10
        );
        \PoP\Root\App::addAction(
            AbstractCreateUpdateCustomPostMutationResolver::HOOK_VALIDATE_CONTENT,
            $this->validateContent(...),
            10,
            2
        );
        \PoP\Root\App::addAction(
            AbstractCreateUpdateCustomPostMutationResolver::HOOK_EXECUTE_CREATE_OR_UPDATE,
            $this->createUpdate(...),
            10,
            2
        );
    }

    public function validateContent(
        WithArgumentsInterface $withArgumentsAST,
        ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore,
    ): void {
        if ($link = $withArgumentsAST->getArgumentValue('link')) {
            if (!isValidUrl($link)) {
                // @todo Migrate from string to FeedbackItemProvider
                // $objectTypeFieldResolutionFeedbackStore->addError(
                //     new ObjectTypeFieldResolutionFeedback(
                //         new FeedbackItemResolution(
                //             MutationErrorFeedbackItemProvider::class,
                //             MutationErrorFeedbackItemProvider::E1,
                //         ),
                //         $fieldDataAccessor->getField(),
                //     )
                // );
                $errors[] = TranslationAPIFacade::getInstance()->__('The external link has an invalid format', 'pop-addpostlinks');
            }
        }
    }

    public function createUpdate($post_id, WithArgumentsInterface $withArgumentsAST)
    {

        // Save the link in the post meta
        $link = $withArgumentsAST->getArgumentValue('link');
        if ($link) {
            \PoPCMSSchema\CustomPostMeta\Utils::updateCustomPostMeta($post_id, GD_METAKEY_POST_LINK, $link, true);
        } else {
            \PoPCMSSchema\CustomPostMeta\Utils::deleteCustomPostMeta($post_id, GD_METAKEY_POST_LINK);
        }
    }

    /**
     * @param array<array<string,mixed>> $mutationDataInArray
     */
    public function addMutationDataForFieldDataAccessor(array $mutationDataInArray): void
    {
        $componentprocessor_manager = ComponentProcessorManagerFacade::getInstance();

        [$mutationData] = $mutationDataInArray;
        $mutationData['link'] = $componentprocessor_manager->getComponentProcessor([PoP_AddPostLinks_Module_Processor_TextFormInputs::class, PoP_AddPostLinks_Module_Processor_TextFormInputs::COMPONENT_ADDPOSTLINKS_FORMINPUT_LINK])->getValue([PoP_AddPostLinks_Module_Processor_TextFormInputs::class, PoP_AddPostLinks_Module_Processor_TextFormInputs::COMPONENT_ADDPOSTLINKS_FORMINPUT_LINK]);
    }
}

/**
 * Initialize
 */
new PoP_AddPostLinks_DataLoad_ActionExecuter_Hook();
