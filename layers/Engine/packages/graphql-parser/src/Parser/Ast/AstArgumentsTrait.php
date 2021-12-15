<?php

/*
* This file is a part of GraphQL project.
*
* @author Alexandr Viniychuk <a@viniychuk.com>
* created: 2/5/17 11:31 AM
*/

namespace PoP\GraphQLParser\Parser\Ast;

trait AstArgumentsTrait
{
    /** @var array<string,Argument> */
    protected array $arguments;

    /** @var array<string,Argument>|null */
    private ?array $argumentsCache = null;


    public function hasArguments(): bool
    {
        return count($this->arguments) > 0;
    }

    public function hasArgument(string $name): bool
    {
        return array_key_exists($name, $this->arguments);
    }

    /**
     * @return Argument[]
     */
    public function getArguments(): array
    {
        return array_values($this->arguments);
    }

    public function getArgument(string $name): ?Argument
    {
        return $this->arguments[$name] ?? null;
    }

    public function getArgumentValue(string $name): mixed
    {
        if ($argument = $this->getArgument($name)) {
            return $argument->getValue()->getValue();
        }

        return null;
    }

    /**
     * @param Argument[] $arguments
     */
    public function setArguments(array $arguments): void
    {
        $this->arguments = [];
        $this->argumentsCache = null;

        foreach ($arguments as $argument) {
            $this->addArgument($argument);
        }
    }

    public function addArgument(Argument $argument): void
    {
        $this->arguments[$argument->getName()] = $argument;
    }

    /**
     * @return array<string,Argument>
     */
    public function getKeyValueArguments(): array
    {
        if ($this->argumentsCache !== null) {
            return $this->argumentsCache;
        }

        $this->argumentsCache = [];

        foreach ($this->getArguments() as $argument) {
            $this->argumentsCache[$argument->getName()] = $argument->getValue()->getValue();
        }

        return $this->argumentsCache;
    }
}
