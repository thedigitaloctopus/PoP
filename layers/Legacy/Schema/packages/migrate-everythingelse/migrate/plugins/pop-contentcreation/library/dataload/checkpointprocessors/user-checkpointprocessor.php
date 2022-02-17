<?php
use PoP\ComponentModel\Checkpoint\CheckpointError;
use PoP\ComponentModel\CheckpointProcessors\AbstractCheckpointProcessor;
use PoP\ComponentModel\Error\Error;
use PoP\Root\App;

class GD_ContentCreation_Dataload_UserCheckpointProcessor extends AbstractCheckpointProcessor
{
    public const CHECKPOINT_USERCANEDIT = 'checkpoint-usercanedit';
    public const CHECKPOINT_EDITPOSTNONCE = 'checkpoint-editpostnonce';

    public function getCheckpointsToProcess(): array
    {
        return array(
            [self::class, self::CHECKPOINT_USERCANEDIT],
            [self::class, self::CHECKPOINT_EDITPOSTNONCE],
        );
    }

    public function validateCheckpoint(array $checkpoint): ?CheckpointError
    {
        switch ($checkpoint[1]) {
            case self::CHECKPOINT_USERCANEDIT:
                // Check if the user can edit the specific post
                $post_id = App::query(\PoPCMSSchema\Posts\Constants\InputNames::POST_ID);
                if (!gdCurrentUserCanEdit($post_id)) {
                    return new Error('usercannotedit');
                }
                break;

            case self::CHECKPOINT_EDITPOSTNONCE:
                $post_id = App::query(\PoPCMSSchema\Posts\Constants\InputNames::POST_ID);
                $nonce = App::query(POP_INPUTNAME_NONCE);
                if (!gdVerifyNonce($nonce, GD_NONCE_EDITURL, $post_id)) {
                    return new Error('nonceinvalid');
                }
                break;
        }

        return parent::validateCheckpoint($checkpoint);
    }
}

