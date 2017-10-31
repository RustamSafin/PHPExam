<?php
/**
 * Created by PhpStorm.
 * User: rustam
 * Date: 16.06.17
 * Time: 11:02
 */

use Providers\RepositoryProvider;
use Silex\Application;
use Silex\Provider\FormServiceProvider;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Bridge\Twig\Form\TwigRenderer;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator;
use Symfony\Component\Security\Csrf\TokenStorage\NativeSessionTokenStorage;
use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Component\Translation\Translator;


$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => realpath(__DIR__ . '/../Views/')
));


$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver' => 'pdo_pgsql',
        'host' => 'localhost',
        'port' => '5432',
        'dbname' => 'blog',
        'user' => 'exam',
        'password' => 'qwaszx',
    ),
));
$app->register(new \Providers\CorrectDateServiceProvider());

$app->register(new Silex\Provider\ValidatorServiceProvider(), array(
    'validator.validator_service_ids' => array(
        'validator.correctDate' => 'validator.correctDate',
    )
));


$app->register(new Silex\Provider\LocaleServiceProvider());

$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'translator.domains' => array(),
    'locale' => 'sr_Latn',
    'translation.class_path' => __DIR__ . '/../vendor/symfony/src',
    'translator.messages' => array(),
));

$app->register(new FormServiceProvider());

$app->register(new Silex\Provider\SessionServiceProvider());

$app->register(new Silex\Provider\ServiceControllerServiceProvider());

$app->register(new Silex\Provider\AssetServiceProvider(), array(
    'assets.version' => 'v1',
));

$app->register(new RepositoryProvider());

$app->register(new \Providers\ControllersProvider(__DIR__ .'/../Controllers'));
$app['translator']->addLoader('xlf', new Symfony\Component\Translation\Loader\XliffFileLoader());
$app['translator']->addResource('xlf', __DIR__ . '/../vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.sr_Latn.xlf', 'sr_Latn', 'validators');


$app['services.user'] = function ($app) {
    return new Services\UserService($app['repository.user']);
};

$app['services.post'] = function ($app) {
    return new Services\PostService($app['repository.post']);
};

$app['services.comment'] = function ($app) {
    return new Services\CommentService($app['repository.comment']);
};




$app['login.controller'] = function ($app) {
    return new Controllers\LoginController($app['services.user']);
};

$app['registration.controller'] = function ($app) {
    return new Controllers\RegistrationController($app['services.user']);
};

$app['post.controller'] = function ($app) {
    return new Controllers\PostController($app['services.post'], $app['services.comment']);
};

$app['comment.controller'] = function ($app) {
    return new Controllers\CommentController($app['services.comment']);
};

$app['profile.controller'] = function ($app) {
    return new Controllers\ProfileController($app['services.post'], $app['services.user']);
};

$app['main.controller'] = function ($app) {
    return new Controllers\MainController($app['services.post']);
};

$app->before(function (Request $request, Application $app) {
    $path = $request->getPathInfo();
    if (preg_match("/\/(profile|post.*|user.*)/", $path) && $app['session']->get('user') === null) {
        return $app->redirect('/login');
    }
});

return $app;