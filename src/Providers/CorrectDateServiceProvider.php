<?php
/**
 * Created by PhpStorm.
 * User: rustam
 * Date: 26.10.17
 * Time: 14:08
 */

namespace Providers;


use Pimple\Container;
use Pimple\ServiceProviderInterface;

class CorrectDateServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['validator.correctDate'] = function($app) {
            $validator = new \Validators\CorrectDateValidator();
            return $validator;
        };
    }

}