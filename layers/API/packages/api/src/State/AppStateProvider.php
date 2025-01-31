<?php

declare(strict_types=1);

namespace PoPAPI\API\State;

use PoP\ComponentModel\App;
use PoP\ComponentModel\Constants\DatabasesOutputModes;
use PoP\ComponentModel\Constants\DataOutputItems;
use PoP\ComponentModel\Constants\DataOutputModes;
use PoP\ComponentModel\Constants\Outputs;
use PoP\ComponentModel\Feedback\DocumentFeedback;
use PoP\ComponentModel\Feedback\QueryFeedback;
use PoP\ComponentModel\Module as ComponentModelModule;
use PoP\ComponentModel\ModuleConfiguration as ComponentModelModuleConfiguration;
use PoP\GraphQLParser\Exception\AbstractQueryException;
use PoP\GraphQLParser\Exception\Parser\AbstractParserException;
use PoP\GraphQLParser\Exception\Parser\ASTNodeParserException;
use PoP\Root\State\AbstractAppStateProvider;
use PoPAPI\API\Configuration\EngineRequest;
use PoPAPI\API\Constants\Actions;
use PoPAPI\API\Response\Schemes as APISchemes;
use PoPAPI\API\StaticHelpers\GraphQLParserHelpers;

class AppStateProvider extends AbstractAppStateProvider
{
    /**
     * @param array<string,mixed> $state
     */
    public function initialize(array &$state): void
    {
        $state['executable-document-ast'] = null;
        $state['document-ast-node-ancestors'] = null;
        $state['document-object-resolved-field-value-referenced-fields'] = [];
        $state['does-api-query-have-errors'] = null;

        // Passing the query via URL param?
        /** @var ComponentModelModuleConfiguration */
        $componentModelModuleConfiguration = App::getModule(ComponentModelModule::class)->getConfiguration();
        $enableModifyingEngineBehaviorViaRequest = $componentModelModuleConfiguration->enableModifyingEngineBehaviorViaRequest();
        $state['query'] = EngineRequest::getQuery($enableModifyingEngineBehaviorViaRequest);
        $state['operation-name'] = EngineRequest::getOperationName($enableModifyingEngineBehaviorViaRequest);
    }

    /**
     * @param array<string,mixed> $state
     */
    public function consolidate(array &$state): void
    {
        if ($state['scheme'] !== APISchemes::API) {
            return;
        }

        // For the API, the response is always JSON
        $state['output'] = Outputs::JSON;

        // Fetch datasetcomponentsettings: needed to obtain the typeOutputKeyPath to know where to find the database entries
        $state['dataoutputitems'] = [
            DataOutputItems::DATASET_COMPONENT_SETTINGS,
            DataOutputItems::COMPONENT_DATA,
            DataOutputItems::DATABASES,
        ];

        // dataoutputmode => Combined: there is no need to split the sources, then already combined them
        $state['dataoutputmode'] = DataOutputModes::COMBINED;

        // dboutputmode => Combined: needed since we don't know under what database does the typeOutputKeyPath point to. Then simply integrate all of them
        // Also, needed for REST/GraphQL APIs since all their data comes bundled all together
        $state['dboutputmode'] = DatabasesOutputModes::COMBINED;

        // Do not print the entry component
        $state['actions'][] = Actions::REMOVE_ENTRYCOMPONENT_FROM_OUTPUT;

        // Entry to indicate if the query has errors (eg: some GraphQL variable not submitted)
        $state['does-api-query-have-errors'] = false;
    }

    /**
     * @param array<string,mixed> $state
     */
    public function execute(array &$state): void
    {
        if ($state['scheme'] !== APISchemes::API) {
            return;
        }

        $query = $state['query'];
        if ($query === null) {
            return;
        }

        $variableValues = $state['variables'];
        $operationName = $state['operation-name'];

        $executableDocument = null;
        try {
            $graphQLQueryParsingPayload = GraphQLParserHelpers::parseGraphQLQuery(
                $query,
                $variableValues,
                $operationName
            );
            $executableDocument = $graphQLQueryParsingPayload->executableDocument;
            $state['document-object-resolved-field-value-referenced-fields'] = $graphQLQueryParsingPayload->objectResolvedFieldValueReferencedFields;
        } catch (ASTNodeParserException $astNodeParserException) {
            App::getFeedbackStore()->documentFeedbackStore->addError(
                new QueryFeedback(
                    $astNodeParserException->getFeedbackItemResolution(),
                    $astNodeParserException->getAstNode(),
                )
            );
        } catch (AbstractParserException $parserException) {
            App::getFeedbackStore()->documentFeedbackStore->addError(
                new DocumentFeedback(
                    $parserException->getFeedbackItemResolution(),
                    $parserException->getLocation(),
                )
            );
        }

        if ($executableDocument !== null) {
            /**
             * Calculate now, as it's useful also if the validation
             * of the ExecutableDocument has errors.
             */
            $state['document-ast-node-ancestors'] = $executableDocument->getDocument()->getASTNodeAncestors();

            try {
                $executableDocument->validateAndInitialize();
            } catch (AbstractQueryException $queryException) {
                $executableDocument = null;
                App::getFeedbackStore()->documentFeedbackStore->addError(
                    new QueryFeedback(
                        $queryException->getFeedbackItemResolution(),
                        $queryException->getAstNode(),
                    )
                );
            }
        }

        $state['executable-document-ast'] = $executableDocument;
        if ($executableDocument === null) {
            $state['does-api-query-have-errors'] = true;
        }
    }
}
