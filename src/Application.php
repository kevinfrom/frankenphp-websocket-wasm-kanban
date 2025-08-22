<?php

declare(strict_types=1);

namespace App;

use League\Container\Container;

final readonly class Application
{
    protected Container $container;

    public function __construct()
    {
        $this->container = new Container();

        $this->bootstrap();
    }

    protected function bootstrap(): void
    {
        // @TODO: Initialize container

        // @TODO: Initialize router
    }

    public function run(): never
    {
        exit;
    }
}
