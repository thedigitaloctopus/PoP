<?php

declare(strict_types=1);

namespace PoPSitesWassup\HighlightMutations\MutationResolverBridges;

use PoP\GraphQLParser\Spec\Parser\Ast\WithArgumentsInterface;
use PoP_Module_Processor_TextareaFormInputs;
use PoP_AddHighlights_Module_Processor_PostTriggerLayoutFormComponentValues;
use PoP\Root\App;
use PoPCMSSchema\CustomPostMeta\Utils;
use PoPCMSSchema\CustomPosts\Enums\CustomPostStatus;
use PoPSitesWassup\CustomPostMutations\MutationResolverBridges\AbstractCreateUpdateCustomPostMutationResolverBridge;

abstract class AbstractCreateUpdateHighlightMutationResolverBridge extends AbstractCreateUpdateCustomPostMutationResolverBridge
{
    protected function supportsTitle()
    {
        return false;
    }

    protected function moderate()
    {
        return false;
    }

    /**
     * Watch out! This functions is called from nowhere!
     * Lost during the migration!
     * @todo: Restore calling this function
     */
    protected function getSuccessTitle($referenced = null)
    {
        if ($referenced) {
            return sprintf(
                $this->__('Highlight from “%s”', 'poptheme-wassup'),
                $this->getCustomPostTypeAPI()->getTitle($referenced)
            );
        }

        return $this->__('Highlight', 'poptheme-wassup');
    }

    public function getSuccessString(string | int $result_id): ?string
    {
        $status = $this->getCustomPostTypeAPI()->getStatus($result_id);
        if ($status == CustomPostStatus::PUBLISH) {
            // Give a link to the referenced post to the stance, and force it to get it from the server again
            $highlighted = Utils::getCustomPostMeta($result_id, GD_METAKEY_POST_HIGHLIGHTEDPOST, true);
            $success_string = sprintf(
                $this->__('<a href="%s" %s>Click here to view it</a>.', 'poptheme-wassup'),
                $this->getCustomPostTypeAPI()->getPermalink($highlighted),
                getReloadurlLinkattrs()
            );

            return App::applyFilters('gd-createupdate-uniquereference:execute:successstring', $success_string, $result_id, $status);
        }

        return parent::getSuccessString($result_id);
    }

    protected function getEditorInput()
    {
        return [PoP_Module_Processor_TextareaFormInputs::class, PoP_Module_Processor_TextareaFormInputs::COMPONENT_FORMINPUT_TEXTAREAEDITOR];
    }

    public function addArgumentsForMutation(WithArgumentsInterface $withArgumentsAST): void
    {
        parent::addArgumentsForMutation($withArgumentsAST);

        $withArgumentsAST->addArgument(new \PoP\GraphQLParser\Spec\Parser\Ast\Argument('highlightedpost', $this->getComponentProcessorManager()->getComponentProcessor([PoP_AddHighlights_Module_Processor_PostTriggerLayoutFormComponentValues::class, PoP_AddHighlights_Module_Processor_PostTriggerLayoutFormComponentValues::COMPONENT_FORMCOMPONENT_CARD_HIGHLIGHTEDPOST])->getValue([PoP_AddHighlights_Module_Processor_PostTriggerLayoutFormComponentValues::class, PoP_AddHighlights_Module_Processor_PostTriggerLayoutFormComponentValues::COMPONENT_FORMCOMPONENT_CARD_HIGHLIGHTEDPOST]), \PoP\GraphQLParser\StaticHelpers\LocationHelper::getNonSpecificLocation()));

        // Highlights have no title input by the user. Instead, produce the title from the referenced post
        $referenced = $this->getCustomPostTypeAPI()->getCustomPost($form_data['highlightedpost']);
        $withArgumentsAST->addArgument(new \PoP\GraphQLParser\Spec\Parser\Ast\Argument('title', $this->getCustomPostTypeAPI()->getTitle($referenced), \PoP\GraphQLParser\StaticHelpers\LocationHelper::getNonSpecificLocation()));
    }
}
