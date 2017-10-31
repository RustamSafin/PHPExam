<?php
/**
 * Created by PhpStorm.
 * User: rustam
 * Date: 25.10.17
 * Time: 17:28
 */

namespace Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Repositories\CommentRepository;
use Repositories\PostRepository;
use Repositories\UserRepository;

class RepositoryProvider implements ServiceProviderInterface
{

    public function register(Container $app)
    {
        $app['repository.user'] = function ($app) {
            return new UserRepository($app['db']);
        };

        $app['repository.post'] = function ($app) {
            return new PostRepository($app['db']);
        };

        $app['repository.comment'] = function ($app) {
            return new CommentRepository($app['db']);
        };
    }
}