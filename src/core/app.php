<?php
/**
 * Created by PhpStorm.
 * User: rustam
 * Date: 16.06.17
 * Time: 11:02
 */

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../Views/'
));

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array (
        'driver'    => 'pdo_pgsql',
        'host'      => 'localhost',
        'port'      => '5432',
        'dbname'    => 'blog',
        'user'      => 'exam',
        'password'  => 'qwaszx',
    ),
));

$app->register(new Silex\Provider\SessionServiceProvider());

$app->register(new Silex\Provider\ServiceControllerServiceProvider());

$app->register(new Silex\Provider\AssetServiceProvider(), array(
    'assets.version' => 'v1',
));

$app['repository.user'] = function ($app) {
    return new Repositories\UserRepository($app['db']);
};

$app['repository.post'] = function ($app) {
    return new Repositories\PostRepository($app['db']);
};

$app['services.user'] = function ($app) {
    return new Services\UserService($app['repository.user']);
};

$app['services.post'] = function ($app) {
    return new Services\PostService($app['repository.post']);
};

$app['login.controller'] = function ($app) {
    return new Controllers\LoginController($app['services.user']);
};

$app['registration.controller'] = function ($app) {
    return new Controllers\RegistrationController($app['services.user']);
};

$app['post.controller'] = function ($app) {
    return new Controllers\PostController($app['services.post']);
};

$app['profile.controller'] = function ($app) {
    return new Controllers\ProfileController($app['services.post'],$app['services.user']);
};

$app['main.controller'] = function ($app) {
    return new Controllers\MainController($app['services.post']);
};

$app->before(function (Request $request, Application $app) {
    $path = $request->getPathInfo();
    if (preg_match("/\/(profile|post.*|user.*)/",$path) &&  $app['session']->get('user') === null) {
        return $app->redirect('/login');
    }
});

return $app;