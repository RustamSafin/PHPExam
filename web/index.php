<?php
/**
 * Created by PhpStorm.
 * User: rustam
 * Date: 16.06.17
 * Time: 10:40
 */
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__.'/../vendor/ezyang/htmlpurifier/library/HTMLPurifier.auto.php';

$app = new Silex\Application();

require __DIR__ . '/../src/core/app.php';
require __DIR__ . '/../src/core/routes.php';

$app['debug'] = true;

$app->run();