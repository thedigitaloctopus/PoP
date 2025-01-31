<?php
use PoP\ComponentModel\Checkpoints\AbstractCheckpoint;
use PoP\Root\Feedback\FeedbackItemResolution;

class PoPCore_Dataload_Checkpoint extends AbstractCheckpoint
{
    public final const CHECKPOINT_PROFILEACCESS = 'checkpoint-profileaccess';
    public final const CHECKPOINT_PROFILEACCESS_SUBMIT = 'checkpoint-profileaccess-submit';

    /**
     * @todo Migrate to not using $checkpoint
     */
    public function validateCheckpoint(): ?FeedbackItemResolution
    {
        switch ($checkpoint[1]) {
            case self::CHECKPOINT_PROFILEACCESS:
                // Check if the user has Profile Access: access to add/edit content
                if (!userHasProfileAccess()) {
                    return new FeedbackItemResolution('usernoprofileaccess', 'usernoprofileaccess');
                }
                break;

            case self::CHECKPOINT_PROFILEACCESS_SUBMIT:
                // Check if the user has Profile Access: access to add/edit content
                if (!doingPost()) {
                    return new FeedbackItemResolution('notdoingpost', 'notdoingpost');
                }

                if (!userHasProfileAccess()) {
                    return new FeedbackItemResolution('usernoprofileaccess', 'usernoprofileaccess');
                }
                break;
        }

        return parent::validateCheckpoint();
    }
}

