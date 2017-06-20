<?php
/**
 * Created by PhpStorm.
 * User: rustam
 * Date: 16.06.17
 * Time: 10:42
 */

namespace Controllers;

use Silex\Application;

class WelcomeController
{
    public function welcome(Application $app) {
        return $app["twig"]->render("welcome.twig", array(
            'user' => $app['session']->get('user')
        ));
    }
}