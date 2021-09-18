<?php

declare(strict_types=1);

namespace PoP\ComponentModel\CheckpointProcessors;

use PoP\ComponentModel\ItemProcessors\ItemProcessorManagerTrait;

class CheckpointProcessorManager implements CheckpointProcessorManagerInterface
{
    use ItemProcessorManagerTrait;

    public function getProcessor(array $item)
    {
        return $this->getItemProcessor($item);
    }
}
