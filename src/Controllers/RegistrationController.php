<?php
/**
 * Created by PhpStorm.
 * User: rustam
 * Date: 17.06.17
 * Time: 16:12
 */

namespace Controllers;

use Models\User;
use Silex\Application;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Validators\FormValidator;

class RegistrationController
{
    private $userService;

    function __construct($userService) {
        $this->userService=$userService;
    }

    public function index(Application $app) {
        return $app['twig']->render('registration.html.twig',array("errors" => ""));
    }

    public function register(Application $app, Request $request) {
        $errors = FormValidator::validateRegForm();

        if ($this->userService->getUserByEmail($request->get('email'))) {
            $errors[]="User already exists";
        }

        if (empty($errors)) {
            $user= new User();
            $user->setEmail($request->get('email'));
            $user->setPassword($request->get('password'));
            $user->setImage($request->files->get("file"));
            $result = $this->userService->save($user);
            return $app->redirect('/login');
        } else {
            return $app['twig']->render('registration.html.twig',array(
                "errors" => $errors,
            ));
        }
    }
}