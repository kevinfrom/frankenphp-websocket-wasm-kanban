<?php

declare(strict_types=1);

namespace App\Http;

use FastRoute\Dispatcher;
use RuntimeException;

final readonly class Router
{
    public function __construct(protected Dispatcher $dispatcher)
    {
    }

    public function dispatch(): never
    {
        $method = mb_strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
        $uri    = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '/';

        $route = $this->dispatcher->dispatch($method, $uri);

        switch ($route[0]) {
            case Dispatcher::NOT_FOUND:
                http_response_code(404);
                echo '404 Not Found';
            break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                http_response_code(405);
                echo '405 Method Not Allowed';
            break;
            case Dispatcher::FOUND:
                $handler = $route[1];
                $params  = $route[2];

                if (!is_callable($handler)) {
                    throw new RuntimeException('Handler is not callable');
                }

                call_user_func($handler, $params);
        }

        exit;
    }
}
