<?php

declare(strict_types=1);

namespace App\Http\Controllers;

abstract class AbstractController
{
    use JsonRpcController;

    protected function makeRequest(string $class): object
    {
        return app($class, ['params' => $this->getArrayRequest()]);
    }
}