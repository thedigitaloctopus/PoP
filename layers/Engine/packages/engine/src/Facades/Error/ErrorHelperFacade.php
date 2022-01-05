<?php

declare(strict_types=1);

namespace PoP\Engine\Facades\Error;

use PoP\Engine\App;
use PoP\Engine\Error\ErrorHelperInterface;

class ErrorHelperFacade
{
    public static function getInstance(): ErrorHelperInterface
    {
        /**
         * @var ErrorHelperInterface
         */
        $service = App::getContainer()->get(ErrorHelperInterface::class);
        return $service;
    }
}
