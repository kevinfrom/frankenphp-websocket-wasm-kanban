<?php

declare(strict_types=1);

namespace App\Http\Controller;

final readonly class PageController
{
    public function index(): void
    {
        echo 'Welcome to the homepage!';
    }
}
