<?php

declare(strict_types=1);

namespace PoP\ComponentModel\DirectiveResolvers;

use PoP\ComponentModel\DirectiveResolvers\DirectiveResolverInterface;
use PoP\ComponentModel\Feedback\EngineIterationFeedbackStore;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\RelationalTypeResolverInterface;
use PoP\GraphQLParser\ExtendedSpec\Parser\Ast\MetaDirective;
use PoP\GraphQLParser\Module;
use PoP\GraphQLParser\ModuleConfiguration;
use PoP\GraphQLParser\Spec\Parser\Ast\Directive;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
use PoP\Root\App;
use SplObjectStorage;

abstract class AbstractMetaDirectiveResolver extends AbstractDirectiveResolver implements MetaDirectiveResolverInterface
{
    /** @var SplObjectStorage<DirectiveResolverInterface,FieldInterface[]> */
    protected SplObjectStorage $nestedDirectivePipelineData;

    public function __construct()
    {
        parent::__construct();
        $this->nestedDirectivePipelineData = new SplObjectStorage();
    }

    public function isDirectiveEnabled(): bool
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        if (!$moduleConfiguration->enableComposableDirectives()) {
            return false;
        }

        return parent::isDirectiveEnabled();
    }

    /**
     * If it has nestedDirectives, extract them and validate them
     *
     * @param FieldInterface[] $fields
     */
    public function prepareDirective(
        RelationalTypeResolverInterface $relationalTypeResolver,
        array $fields,
        EngineIterationFeedbackStore $engineIterationFeedbackStore,
    ): void {
        parent::prepareDirective(
            $relationalTypeResolver,
            $fields,
            $engineIterationFeedbackStore,
        );
        if ($this->hasValidationErrors) {
            return;
        }

        /** @var MetaDirective */
        $metaDirective = $this->directive;
        $nestedDirectives = $metaDirective->getNestedDirectives();
        if ($nestedDirectives === []) {
            return;
        }

        /**
         * Each composed directive will deal with the same fields
         * as the current directive.
         *
         * @var SplObjectStorage<Directive,FieldInterface[]>
         */
        $nestedDirectiveFields = new SplObjectStorage();
        foreach ($nestedDirectives as $nestedDirective) {
            $nestedDirectiveFields[$nestedDirective] = $fields;
        }
        $separateEngineIterationFeedbackStore = new EngineIterationFeedbackStore();
        $this->nestedDirectivePipelineData = $relationalTypeResolver->resolveDirectivesIntoPipelineData(
            $nestedDirectives,
            $nestedDirectiveFields,
            $variables,
            $separateEngineIterationFeedbackStore,
        );
        $engineIterationFeedbackStore->incorporate($separateEngineIterationFeedbackStore);
        $this->setHasValidationErrors($separateEngineIterationFeedbackStore->hasErrors());
    }

    /**
     * Name for the directive arg to indicate which directives
     * are being nested, by indicating their relative position
     * to the meta-directive.
     *
     * Eg: @foreach(affectDirectivesUnderPos: [1]) @translate
     */
    public function getAffectDirectivesUnderPosArgumentName(): string
    {
        return 'affectDirectivesUnderPos';
    }

    /**
     * This array cannot be empty!
     *
     * @return int[]
     */
    public function getAffectDirectivesUnderPosArgumentDefaultValue(): array
    {
        return [1];
    }

    public function getDirectiveArgNameTypeResolvers(RelationalTypeResolverInterface $relationalTypeResolver): array
    {
        return array_merge(
            parent::getDirectiveArgNameTypeResolvers($relationalTypeResolver),
            [
                $this->getAffectDirectivesUnderPosArgumentName() => $this->getIntScalarTypeResolver(),
            ]
        );
    }
    /**
     * Do not allow the "multi-field directives" feature for this directive
     */
    public function getAffectAdditionalFieldsUnderPosArgumentName(): ?string
    {
        return null;
    }

    public function getDirectiveArgDescription(RelationalTypeResolverInterface $relationalTypeResolver, string $directiveArgName): ?string
    {
        return match ($directiveArgName) {
            $this->getAffectDirectivesUnderPosArgumentName() => $this->__('Positions of the directives to be affected, relative from this one (as an array of positive integers)', 'graphql-server'),
            default => parent::getDirectiveArgDescription($relationalTypeResolver, $directiveArgName),
        };
    }

    public function getDirectiveArgDefaultValue(RelationalTypeResolverInterface $relationalTypeResolver, string $directiveArgName): mixed
    {
        return match ($directiveArgName) {
            $this->getAffectDirectivesUnderPosArgumentName() => $this->getAffectDirectivesUnderPosArgumentDefaultValue(),
            default => parent::getDirectiveArgDefaultValue($relationalTypeResolver, $directiveArgName),
        };
    }

    public function getDirectiveArgTypeModifiers(RelationalTypeResolverInterface $relationalTypeResolver, string $directiveArgName): int
    {
        return match ($directiveArgName) {
            $this->getAffectDirectivesUnderPosArgumentName() => SchemaTypeModifiers::MANDATORY | SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY,
            default => parent::getDirectiveArgTypeModifiers($relationalTypeResolver, $directiveArgName),
        };
    }
}
