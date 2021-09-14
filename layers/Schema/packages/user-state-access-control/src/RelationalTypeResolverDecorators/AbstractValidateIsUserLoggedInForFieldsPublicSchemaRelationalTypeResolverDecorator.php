<?php

declare(strict_types=1);

namespace PoPSchema\UserStateAccessControl\RelationalTypeResolverDecorators;

use PoP\AccessControl\RelationalTypeResolverDecorators\AbstractPublicSchemaRelationalTypeResolverDecorator;
use PoP\ComponentModel\DirectiveResolvers\DirectiveResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\RelationalTypeResolverInterface;
use PoPSchema\UserStateAccessControl\DirectiveResolvers\ValidateIsUserLoggedInDirectiveResolver;

abstract class AbstractValidateIsUserLoggedInForFieldsPublicSchemaRelationalTypeResolverDecorator extends AbstractPublicSchemaRelationalTypeResolverDecorator
{
    /**
     * Verify that the user is logged in before checking the roles/capabilities
     */
    public function getPrecedingMandatoryDirectivesForDirectives(RelationalTypeResolverInterface $relationalTypeResolver): array
    {
        $mandatoryDirectivesForDirectives = [];
        if ($directiveResolverClasses = $this->getDirectiveResolverClasses()) {
            /** @var DirectiveResolverInterface */
            $validateIsUserLoggedInDirectiveResolver = $this->instanceManager->getInstance(ValidateIsUserLoggedInDirectiveResolver::class);
            // This is the required "validateIsUserLoggedIn" directive
            $validateIsUserLoggedInDirective = $this->fieldQueryInterpreter->getDirective(
                $validateIsUserLoggedInDirectiveResolver->getDirectiveName()
            );
            // Add the mapping
            foreach ($directiveResolverClasses as $needValidateIsUserLoggedInDirectiveResolverClass) {
                /** @var DirectiveResolverInterface */
                $needValidateIsUserLoggedInDirectiveResolver = $this->instanceManager->getInstance($needValidateIsUserLoggedInDirectiveResolverClass);
                $mandatoryDirectivesForDirectives[$needValidateIsUserLoggedInDirectiveResolver->getDirectiveName()] = [
                    $validateIsUserLoggedInDirective,
                ];
            }
        }
        return $mandatoryDirectivesForDirectives;
    }
    /**
     * Provide the classes for all the directiveResolverClasses that need the "validateIsUserLoggedIn" directive
     */
    protected function getDirectiveResolverClasses(): array
    {
        return [];
    }

    /**
     * Verify that the user is logged in before checking the roles/capabilities
     */
    public function getMandatoryDirectivesForFields(ObjectTypeResolverInterface $objectTypeResolver): array
    {
        $mandatoryDirectivesForFields = [];
        if ($fieldNames = $this->getFieldNames()) {
            /** @var DirectiveResolverInterface */
            $validateIsUserLoggedInDirectiveResolver = $this->instanceManager->getInstance(ValidateIsUserLoggedInDirectiveResolver::class);
            // This is the required "validateIsUserLoggedIn" directive
            $validateIsUserLoggedInDirective = $this->fieldQueryInterpreter->getDirective(
                $validateIsUserLoggedInDirectiveResolver->getDirectiveName()
            );
            // Add the mapping
            foreach ($fieldNames as $fieldName) {
                $mandatoryDirectivesForFields[$fieldName] = [
                    $validateIsUserLoggedInDirective,
                ];
            }
        }
        return $mandatoryDirectivesForFields;
    }
    /**
     * Provide the classes for all the directiveResolverClasses that need the "validateIsUserLoggedIn" directive
     */
    protected function getFieldNames(): array
    {
        return [];
    }
}