<?php

declare(strict_types=1);

namespace PoP\ComponentModel\Engine;

class DataloadingEngine implements DataloadingEngineInterface
{
    /**
     * @var string[]
     */
    protected array $mandatoryRootDirectiveClasses = [];
    /**
     * @var string[]
     */
    protected array $mandatoryRootDirectives = [];

    public function getMandatoryDirectiveClasses(): array
    {
        return $this->mandatoryRootDirectiveClasses;
    }
    public function getMandatoryDirectives(): array
    {
        return $this->mandatoryRootDirectives;
    }

    public function addMandatoryDirectiveClass(string $directiveClass): void
    {
        $this->mandatoryRootDirectiveClasses[] = $directiveClass;
    }
    public function addMandatoryDirective(string $directive): void
    {
        $this->mandatoryRootDirectives[] = $directive;
    }
}
