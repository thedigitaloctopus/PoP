<?php

declare(strict_types=1);

namespace PoPAPI\API\ModuleProcessors;

use PoP\ComponentModel\App;
use PoP\ComponentModel\GraphQLEngine\Model\ComponentModelSpec\LeafModuleField;
use PoP\ComponentModel\GraphQLEngine\Model\ComponentModelSpec\RelationalModuleField;
use PoP\ComponentModel\ModuleProcessors\AbstractQueryDataModuleProcessor;
use PoP\GraphQLParser\ExtendedSpec\Execution\ExecutableDocument;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
use PoP\GraphQLParser\Spec\Parser\Ast\Fragment;
use PoP\GraphQLParser\Spec\Parser\Ast\FragmentReference;
use PoP\GraphQLParser\Spec\Parser\Ast\InlineFragment;
use PoP\GraphQLParser\Spec\Parser\Ast\LeafField;
use PoP\GraphQLParser\Spec\Parser\Ast\RelationalField;

abstract class AbstractRelationalFieldQueryDataModuleProcessor extends AbstractQueryDataModuleProcessor
{
    protected const MODULE_ATTS_FIELD_IDS = 'fieldIDs';

    /**
     * @return FieldInterface[]
     */
    protected function getFields(array $module, ?array $moduleAtts): array
    {
        /**
         * If it is a virtual module, the field IDs are coded
         * inside the virtual module atts.
         */
        if ($moduleAtts !== null) {
            return $this->retrieveAstFieldsFromAppState($moduleAtts[self::MODULE_ATTS_FIELD_IDS]);
        }

        /**
         * It is a normal module when calling the first time
         * (i.e. for the fields at the root level).
         */
        return $this->getQueryRootLevelFields();
    }

    /**
     * Extract the root fields from the requested GraphQL query.
     *
     * @return FieldInterface[]
     */
    protected function getQueryRootLevelFields(): array
    {
        // Make sure the GraphQL query exists and was parsed properly into an AST
        $executableDocument = App::getState('executable-document-ast');
        if ($executableDocument === null) {
            return [];
        }
        /** @var ExecutableDocument $executableDocument */

        /**
         * Because moduleAtts are serialized/unserialized,
         * cannot pass the Field object directly in them.
         *
         * Instead, first generate a dictionary with all the Fields
         * in the GraphQL query, and place them under a unique ID.
         * Then this "fieldID" will be passed in the moduleAtts
         */
        $this->maybeStoreAstFieldsInAppState($executableDocument);

        /**
         * Return the "fieldIDs" for the root level Fields
         */
        return $this->getAstFields($executableDocument, false);
    }

    /**
     * Retrieve the Fields stored in the AppState from the passed "fieldIDs".
     *
     * @param string[] $fieldIDs
     * @return FieldInterface[]
     */
    protected function retrieveAstFieldsFromAppState(array $fieldIDs): array
    {
        $appStateFields = App::getState('executable-document-ast-fields');
        $query = App::getState('query');
        $fields = [];
        foreach ($fieldIDs as $fieldID) {
            $fields[] = $appStateFields[$query][$fieldID];
        }
        return $fields;
    }

    /**
     * Generate a dictionary with all the Fields
     * in the GraphQL query, placed under their unique ID,
     * and set it in the AppState
     */
    protected function maybeStoreAstFieldsInAppState(
        ExecutableDocument $executableDocument,
    ): void {
        // Only do it the first time the query is parsed
        $appStateManager = App::getAppStateManager();
        $appStateFields = [];
        if ($appStateManager->has('executable-document-ast-fields')) {
            $appStateFields = $appStateManager->get('executable-document-ast-fields');
        }
        $query = App::getState('query');
        if (isset($appStateFields[$query])) {
            return;
        }
        
        $fields = $this->getAstFields($executableDocument, true);
        $appStateFields[$query] = [];
        foreach ($fields as $field) {
            $appStateFields[$query][$this->getFieldUniqueID($field)] = $field;
        }
        $appStateManager->override('executable-document-ast-fields', $appStateFields);
    }

    /**
     * @return FieldInterface[]
     */
    protected function getAstFields(
        ExecutableDocument $executableDocument,
        bool $recursive,
    ): array {
        $fragments = $executableDocument->getDocument()->getFragments();
        $fields = [];
        foreach ($executableDocument->getRequestedOperations() as $operation) {
            $fields = array_merge(
                $fields,
                $this->getAllFieldsFromFieldsOrFragmentBonds(
                    $operation->getFieldsOrFragmentBonds(),
                    $fragments,
                    $recursive
                )
            );
        }
        return $fields;
    }

    /**
     * ID to uniquely identify the AST element
     */
    protected function getFieldUniqueID(FieldInterface $field): string
    {
        return sprintf(
            '%s([%s,%s])',
            $field->getAlias() ?? $field->getName(),
            $field->getLocation()->getLine(),
            $field->getLocation()->getColumn()
        );
    }

    /**
     * @return LeafModuleField[]
     */
    public function getDataFields(array $module, array &$props): array
    {
        return array_map(
            fn (LeafField $leafField) => LeafModuleField::fromLeafField($leafField),
            $this->getLeafFields($module)
        );
    }

    /**
     * @return LeafField[]
     */
    protected function getLeafFields(array $module): array
    {
        $moduleAtts = $module[2] ?? null;
        $fields = $this->getFields($module, $moduleAtts);
        return array_filter(
            $fields,
            fn (FieldInterface $field) => $field instanceof LeafField
        );
    }

    /**
     * @return RelationalModuleField[]
     */
    public function getDomainSwitchingSubmodules(array $module): array
    {
        $relationalFields = $this->getRelationalFields($module);
        
        $executableDocument = App::getState('executable-document-ast');
        if ($executableDocument === null) {
            return [];
        }

        /** @var ExecutableDocument $executableDocument */
        $fragments = $executableDocument->getDocument()->getFragments();
        $ret = [];

        /**
         * Create a "virtual" module with the fields
         * corresponding to the next level module.
         */
        foreach ($relationalFields as $relationalField) {
            $nestedFields = $this->getAllFieldsFromFieldsOrFragmentBonds(
                $relationalField->getFieldsOrFragmentBonds(),
                $fragments,
                false
            );
            $nestedFieldIDs = array_map(
                [$this, 'getFieldUniqueID'],
                $nestedFields
            );
            $nestedModule = [$module[0], $module[1], [self::MODULE_ATTS_FIELD_IDS => $nestedFieldIDs]];
            $ret[] = RelationalModuleField::fromRelationalField(
                $relationalField,
                [
                    $nestedModule,
                ]
            );
        }
        return $ret;
    }

    /**
     * @return RelationalField[]
     */
    protected function getRelationalFields(array $module): array
    {
        $moduleAtts = $module[2] ?? null;
        $fields = $this->getFields($module, $moduleAtts);
        return array_filter(
            $fields,
            fn (FieldInterface $field) => $field instanceof RelationalField
        );
    }

    /**
     * @param FieldInterface[]|FragmentBondInterface[] $fieldsOrFragmentBonds
     * @param Fragment[] $fragments
     * @return FieldInterface[]
     */
    protected function getAllFieldsFromFieldsOrFragmentBonds(
        array $fieldsOrFragmentBonds,
        array $fragments,
        bool $recursive
    ): array {
        $fields = [];
        foreach ($fieldsOrFragmentBonds as $fieldOrFragmentBond) {
            if ($fieldOrFragmentBond instanceof FragmentReference) {
                /** @var FragmentReference */
                $fragmentReference = $fieldOrFragmentBond;
                $fragment = $this->getFragment($fragmentReference->getName(), $fragments);
                if ($fragment === null) {
                    continue;
                }
                $fields = array_merge(
                    $fields,
                    $this->getAllFieldsFromFieldsOrFragmentBonds(
                        $fragment->getFieldsOrFragmentBonds(),
                        $fragments,
                        $recursive
                    )
                );
                continue;
            }
            if ($fieldOrFragmentBond instanceof InlineFragment) {
                /** @var InlineFragment */
                $inlineFragment = $fieldOrFragmentBond;
                $fields = array_merge(
                    $fields,
                    $this->getAllFieldsFromFieldsOrFragmentBonds(
                        $inlineFragment->getFieldsOrFragmentBonds(),
                        $fragments,
                        $recursive
                    )
                );
                continue;
            }
            /** @var FieldInterface */
            $field = $fieldOrFragmentBond;
            $fields[] = $field;
        }
        if (!$recursive) {
            return $fields;
        }

        /**
         * Recursive: also obtain the fields nested within the fields
         */
        $recursiveFields = [];
        foreach ($fields as $field) {
            $recursiveFields[] = $field;
            if ($field instanceof LeafField) {
                continue;
            }
            /** @var RelationalField */
            $relationalField = $field;
            $recursiveFields = array_merge(
                $recursiveFields,
                $this->getAllFieldsFromFieldsOrFragmentBonds(
                    $relationalField->getFieldsOrFragmentBonds(),
                    $fragments,
                    $recursive
                )
            );
        }
        return $recursiveFields;
    }

    /**
     * @param Fragment[] $fragments
     */
    protected function getFragment(
        string $fragmentName,
        array $fragments,
    ): ?Fragment {
        foreach ($fragments as $fragment) {
            if ($fragment->getName() === $fragmentName) {
                return $fragment;
            }
        }
        return null;
    }
}
