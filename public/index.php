<?php declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use ArchFW\Application;

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$app = new Application();
$app->handle();
