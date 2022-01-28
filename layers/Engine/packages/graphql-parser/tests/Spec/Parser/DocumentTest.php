<?php

declare(strict_types=1);

namespace PoP\GraphQLParser\Spec\Parser;

use PoP\GraphQLParser\Error\GraphQLErrorMessageProviderInterface;
use PoP\GraphQLParser\Exception\Parser\InvalidRequestException;
use PoP\Root\AbstractTestCase;

class DocumentTest extends AbstractTestCase
{
    protected function getParser(): ParserInterface
    {
        return $this->getService(ParserInterface::class);
    }

    protected function getGraphQLErrorMessageProvider(): GraphQLErrorMessageProviderInterface
    {
        return $this->getService(GraphQLErrorMessageProviderInterface::class);
    }

    public function testValidationWorks()
    {
        $parser = $this->getParser();

        // Validate that there are no errors <= no Exception is thrown
        $document = $parser->parse('
            query StarWarsAppHomeRoute($names_0:[String!]!, $query: String) {
              factions(names:$names_0, test: $query) {
                id,
                ...F2
              }
            }
            fragment F0 on Ship {
              id,
              name
            }
            fragment F1 on Faction {
              id,
              factionId
            }
            fragment F2 on Faction {
              id,
              factionId,
              name,
              _shipsDRnzJ:ships(first:10) {
                edges {
                  node {
                    id,
                    ...F0
                  },
                  cursor
                },
                pageInfo {
                  hasNextPage,
                  hasPreviousPage
                }
              },
              ...F1
            }
        ');
        $document->validate();
        $this->assertTrue(true);
    }

    public function testMissingFragmentReferencedByFragment()
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionMessage($this->getGraphQLErrorMessageProvider()->getFragmentNotDefinedInQueryErrorMessage('F1'));
        $parser = $this->getParser();
        $document = $parser->parse('
            query StarWarsAppHomeRoute($names_0:[String!]!, $query: String) {
              factions(names:$names_0, test: $query) {
                id,
                ...F2
              }
            }
            fragment F2 on Faction {
              ...F1
            }
        ');
        $document->validate();
    }

    /**
     * @dataProvider cyclicalFragmentQueryProvider
     */
    public function testNoCyclicalFragments(string $query)
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionMessage($this->getGraphQLErrorMessageProvider()->getCyclicalFragmentErrorMessage('UserProps'));
        $parser = $this->getParser();
        $document = $parser->parse($query);
        $document->validate();
    }

    public function cyclicalFragmentQueryProvider(): array
    {
        return [
            'direct' => ['
                query {
                    users {
                        id,
                        ...UserProps
                    }
                }

                fragment UserProps on User {
                    ...UserProps
                }
            '],
            'looping' => ['
                query {
                    users {
                        id,
                        ...UserProps
                    }
                }

                fragment UserProps on User {
                    ...MoreUserProps
                }

                fragment MoreUserProps on User {
                    ...UserProps
                }
            '],
        ];
    }

    public function testFragmentNotUsed()
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionMessage($this->getGraphQLErrorMessageProvider()->getFragmentNotDefinedInQueryErrorMessage('F0'));
        $parser = $this->getParser();
        $document = $parser->parse('
            query StarWarsAppHomeRoute($names_0:[String!]!, $query: String) {
              factions(names:$names_0, test: $query) {
                id,
                ...F2
              }
            }
            fragment F1 on Faction {
              id,
              factionId
            }
            fragment F2 on Faction {
              id,
              factionId,
              name,
              _shipsDRnzJ:ships(first:10) {
                edges {
                  node {
                    id,
                    ...F0
                  },
                  cursor
                },
                pageInfo {
                  hasNextPage,
                  hasPreviousPage
                }
              },
              ...F1
            }
        ');
        $document->validate();
    }

    public function testFragmentMissing()
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionMessage($this->getGraphQLErrorMessageProvider()->getFragmentNotDefinedInQueryErrorMessage('F2'));
        $parser = $this->getParser();
        $document = $parser->parse('
            query StarWarsAppHomeRoute($names_0:[String!]!, $query: String) {
              factions(names:$names_0, test: $query) {
                id,
                ...F2
              }
            }
        ');
        $document->validate();
    }

    public function testVariableNotUsed()
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionMessage($this->getGraphQLErrorMessageProvider()->getVariableNotUsedErrorMessage('notUsedVar'));
        $parser = $this->getParser();
        $document = $parser->parse('
            query StarWarsAppHomeRoute($names_0:[String!]!, $query: String, $notUsedVar: Boolean) {
              factions(names:$names_0, test: $query) {
                id
              }
            }
        ');
        $document->validate();
    }

    public function testVariableMissing()
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionMessage($this->getGraphQLErrorMessageProvider()->getVariableNotDefinedInOperationErrorMessage('missingVar'));
        $parser = $this->getParser();
        $document = $parser->parse('
            query StarWarsAppHomeRoute($names_0:[String!]!, $query: String) {
              factions(names:$names_0, test: $query, someOther: $missingVar) {
                id
              }
            }
        ');
        $document->validate();
    }

    public function testVariableMissingInDirective()
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionMessage($this->getGraphQLErrorMessageProvider()->getVariableNotDefinedInOperationErrorMessage('missingVar'));
        $parser = $this->getParser();
        $document = $parser->parse('
            query StarWarsAppHomeRoute($names_0:[String!]!, $query: String) {
              id
              factions(names:$names_0, test: $query) @include(if: $missingVar) {
                id
              }
            }
        ');
        $document->validate();
    }

    public function testVariableMissingInInputObject()
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionMessage($this->getGraphQLErrorMessageProvider()->getVariableNotDefinedInOperationErrorMessage('search'));
        $parser = $this->getParser();
        $document = $parser->parse('
            query {
              id
              posts(filter: { search: $search }) {
                id
              }
            }
        ');
        $document->validate();
    }

    public function testVariableMissingInInputList()
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionMessage($this->getGraphQLErrorMessageProvider()->getVariableNotDefinedInOperationErrorMessage('id'));
        $parser = $this->getParser();
        $document = $parser->parse('
            query {
              id
              posts(ids: [$id]) {
                id
              }
            }
        ');
        $document->validate();
    }

    public function testVariableInFragment()
    {
        $parser = $this->getParser();
        $document = $parser->parse('
            query StarWarsAppHomeRoute($includeName: Boolean) {
              id
              factions {
                ...F2
              }
            }

            fragment F2 on Faction {
              id
              name @include(if: $includeName)
            }
        ');
        $document->validate();
        $this->assertTrue(true);
    }

    public function testVariableMissingInFragment()
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionMessage($this->getGraphQLErrorMessageProvider()->getVariableNotDefinedInOperationErrorMessage('missingVar'));
        $parser = $this->getParser();
        $document = $parser->parse('
            query StarWarsAppHomeRoute {
              id
              factions {
                ...F2
              }
            }

            fragment F2 on Faction {
              id
              name @include(if: $missingVar)
            }
        ');
        $document->validate();
    }

    public function testNoOperationsDefined()
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionMessage($this->getGraphQLErrorMessageProvider()->getNoOperationsDefinedInQueryErrorMessage());
        $parser = $this->getParser();
        $document = $parser->parse('
            fragment F0 on Ship {
                id,
                name
            }
        ');
        $document->validate();
    }

    public function testUniqueOperationName()
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionMessage($this->getGraphQLErrorMessageProvider()->getDuplicateOperationNameErrorMessage('SomeQuery'));
        $parser = $this->getParser();
        $document = $parser->parse('
            query SomeQuery {
                users {
                    id
                }
            }

            query SomeQuery {
                posts {
                    title
                }
            }
        ');
        $document->validate();
    }

    public function testUniqueOperationNameAcrossOps()
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionMessage($this->getGraphQLErrorMessageProvider()->getDuplicateOperationNameErrorMessage('SomeQuery'));
        $parser = $this->getParser();
        $document = $parser->parse('
            query SomeQuery {
                users {
                    id
                }
            }

            mutation SomeQuery {
                posts {
                    title
                }
            }
        ');
        $document->validate();
    }

    public function testUniqueVariableName()
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionMessage($this->getGraphQLErrorMessageProvider()->getDuplicateVariableNameErrorMessage('someVar'));
        $parser = $this->getParser();
        $document = $parser->parse('
            query SomeQuery($someVar: String, $someVar: Boolean) {
                users {
                    id
                    name(format: $someVar)
                }
            }
        ');
        $document->validate();
    }

    public function testNonEmptyOperationName()
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionMessage($this->getGraphQLErrorMessageProvider()->getEmptyOperationNameErrorMessage());
        $parser = $this->getParser();
        $document = $parser->parse('
            query SomeQuery {
                users {
                    id
                }
            }

            mutation {
                posts {
                    title
                }
            }
        ');
        $document->validate();
    }

    /**
     * @dataProvider duplicateArgumentQueryProvider
     */
    public function testDuplicateArgument($query)
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionMessage($this->getGraphQLErrorMessageProvider()->getDuplicateArgumentErrorMessage('format'));
        $parser = $this->getParser();
        $document = $parser->parse($query);
        $document->validate();
    }

    public function duplicateArgumentQueryProvider(): array
    {
        return [
            ['
                {
                    posts {
                        id
                        date(format: "d/m/Y", format: "d, m, Y")
                    }
                }
            '],
            ['
                {
                    posts(format: 3, format: 5) {
                        id
                    }
                }
            '],
            ['
                {
                    posts {
                        ...Frag
                    }
                }

                fragment Frag on Post {
                    date(format: "d/m/Y", format: "d, m, Y")
                }
            '],
            ['
                {
                    posts {
                        ... on Post {
                            date(format: "d/m/Y", format: "d, m, Y")
                        }
                    }
                }
            '],
            ['
                {
                    posts {
                        ...Frag
                    }
                }

                fragment Frag on Post {
                    ... on Post {
                        date(format: "d/m/Y", format: "d, m, Y")
                    }
                }
            '],
            ['
                {
                    posts @caramelize(format: true, format: false) {
                        id
                    }
                }
            '],
        ];
    }
}