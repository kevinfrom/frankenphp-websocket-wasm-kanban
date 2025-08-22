<?php

declare(strict_types=1);

/**
 * Front controller for the application.
 */

const DS = DIRECTORY_SEPARATOR;
define('ROOT', dirname(__DIR__));

require ROOT . DS . 'vendor' . DS . 'autoload.php';

use App\Application;
use Spatie\Ignition\Ignition;

Ignition::make()->register();

$app = new Application();
$app->run();
