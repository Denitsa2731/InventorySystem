<?php


use App\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application();
$app->dispatch();