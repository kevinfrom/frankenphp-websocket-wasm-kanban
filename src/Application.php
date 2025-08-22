<?php

declare(strict_types=1);

namespace App;

use App\Http\Controller\PageController;
use App\Http\Router;
use FastRoute\RouteCollector;
use League\Container\Container;
use function FastRoute\simpleDispatcher;

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
        $this->services();
        $this->routes();
    }

    protected function services(): void
    {

    }

    protected function routes(): void
    {
        $this->container->add(Router::class)->addArgument(simpleDispatcher(function (RouteCollector $routes) {
            $routes->get('/', fn() => new PageController()->index());
        }));
    }

    public function run(): never
    {
        /** @var Router $router */
        $router = $this->container->get(Router::class);
        $router->dispatch();
    }
}
