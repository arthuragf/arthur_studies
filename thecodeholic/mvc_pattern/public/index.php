<?php
require_once __DIR__ . '/../vendor/autoload.php';
use app\core\Application;

$oApp = new Application(dirname(__DIR__));

$oApp->clsRouter->get('/', 'home');

$oApp->clsRouter->get('/contact', 'contact');

$oApp->run();