<?php
/**
 * Created by PhpStorm.
 * User: rustam
 * Date: 16.06.17
 * Time: 19:02
 */

namespace Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Validators\FormValidator;


class LoginController {

    private $userService;

    function __construct($userService) {
        $this->userService=$userService;
    }

    public function index(Application $app) {
        return $app['twig']->render('login.html.twig',array("errors" => ''));
    }

    public function logout(Application $app) {
        $app['session']->remove('user');
        return $app->redirect('/');
    }

    public function login(Application $app, Request $request) {
        $email = $request->get('email');
        $password = $request->get('password');
        $errors = FormValidator::validateLogFrom($request->get('email'), $request->get('password'));
        $user = $this->userService->getUserByEmail($email);

        $hash=$user->getPassword();
        if ($user === null) {
            $errors[] = "User not found";
        } elseif(!password_verify($password,$hash)) {
            $errors[] = "Wrong password";
        }

        if (empty($errors)) {
            $session = $app["session"];
            $session->set("user", $user);
            return $app->redirect('/');
        }
        return $app["twig"]->render("login.html.twig", array(
            "errors" => $errors,
        ));
    }
}