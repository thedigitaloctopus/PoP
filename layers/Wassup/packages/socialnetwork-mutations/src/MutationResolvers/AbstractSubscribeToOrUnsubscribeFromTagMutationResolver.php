<?php

declare(strict_types=1);

namespace PoPSitesWassup\SocialNetworkMutations\MutationResolvers;

use PoP\ComponentModel\Mutation\FieldDataAccessorInterface;
use PoP\Root\App;
use PoPCMSSchema\PostTags\TypeAPIs\PostTagTypeAPIInterface;

abstract class AbstractSubscribeToOrUnsubscribeFromTagMutationResolver extends AbstractUpdateUserMetaValueMutationResolver
{
    private ?PostTagTypeAPIInterface $postTagTypeAPI = null;

    final public function setPostTagTypeAPI(PostTagTypeAPIInterface $postTagTypeAPI): void
    {
        $this->postTagTypeAPI = $postTagTypeAPI;
    }
    final protected function getPostTagTypeAPI(): PostTagTypeAPIInterface
    {
        return $this->postTagTypeAPI ??= $this->instanceManager->getInstance(PostTagTypeAPIInterface::class);
    }

    public function validateErrors(FieldDataAccessorInterface $fieldDataProvider): array
    {
        $errors = parent::validateErrors($fieldDataProvider);
        if (!$errors) {
            $target_id = $fieldDataProvider->get('target_id');

            // Make sure the post exists
            $target = $this->getPostTagTypeAPI()->getTag($target_id);
            if (!$target) {
                // @todo Migrate from string to FeedbackItemProvider
                // $errors[] = new FeedbackItemResolution(
                //     MutationErrorFeedbackItemProvider::class,
                //     MutationErrorFeedbackItemProvider::E1,
                // );
                $errors[] = $this->__('The requested topic/tag does not exist.', 'pop-coreprocessors');
            }
        }
        return $errors;
    }

    protected function additionals($target_id, FieldDataAccessorInterface $fieldDataProvider): void
    {
        App::doAction('gd_subscritetounsubscribefrom_tag', $target_id, $fieldDataProvider);
        parent::additionals($target_id, $fieldDataProvider);
    }
}
