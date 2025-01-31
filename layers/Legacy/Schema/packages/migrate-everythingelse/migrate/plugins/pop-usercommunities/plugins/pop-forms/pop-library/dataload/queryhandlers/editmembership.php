<?php
use PoP\Root\Feedback\FeedbackItemResolution;
use PoP\ComponentModel\QueryInputOutputHandlers\ActionExecutionQueryInputOutputHandler;

class GD_DataLoad_QueryInputOutputHandler_EditMembership extends ActionExecutionQueryInputOutputHandler
{
    public function getQueryParams(array $data_properties, ?FeedbackItemResolution $dataaccess_checkpoint_validation, ?FeedbackItemResolution $actionexecution_checkpoint_validation, ?array $executed, string|int|array $objectIDOrIDs): array
    {
        $ret = parent::getQueryParams($data_properties, $dataaccess_checkpoint_validation, $actionexecution_checkpoint_validation, $executed, $objectIDOrIDs);

        $uid = \PoP\Root\App::query(\PoPCMSSchema\Users\Constants\InputNames::USER_ID);
        $ret[\PoPCMSSchema\Users\Constants\InputNames::USER_ID] = $uid;
        $ret[POP_INPUTNAME_NONCE] = gdCreateNonce(GD_NONCE_EDITMEMBERSHIPURL, $uid);

        return $ret;
    }
}

/**
 * Initialize
 */
new GD_DataLoad_QueryInputOutputHandler_EditMembership();
