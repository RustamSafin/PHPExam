<?php
/**
 * Created by PhpStorm.
 * User: rustam
 * Date: 16.06.17
 * Time: 19:02
 */

namespace Controllers;

use Doctrine\DBAL\Types\TextType;
use Silex\Application;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Validators\CorrectDate;

class LoginController {

    private $userService;

    function __construct($userService) {
        $this->userService=$userService;
    }

    public function index(Application $app) {

    }

    public function logout(Application $app) {
        $app['session']->remove('user');
        return $app->redirect('/');
    }

    public function login(Application $app, Request $request) {
        $errors = '';
        $data = array(
            'email' => '',
            'password' => '',
            'birth' => new \DateTime()
        );
        $form = $app['form.factory']->createBuilder(FormType::class, $data)
            ->add('email', EmailType::class, array(
                'constraints' => array(new Assert\NotBlank(), new Assert\Email(), new Assert\Required()),
                'attr' => array('class' => 'form-control', 'placeholder' => 'Your email')
            ))
            ->add('password',PasswordType::class, array(
                'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('min'=>5)), new Assert\Required()),
                'attr' => array('class' => 'form-control', 'placeholder' => 'Enter password')
            ))
            ->add('birth', DateType::class, array(
                'constraints' => array(new Assert\NotBlank(), new Assert\Required(), new Assert\DateTime(), new CorrectDate()),
                'attr' => array('class' => 'form-control', 'placeholder' => 'Enter your birth date')
            ))
            ->getForm();
        $form->handleRequest($request);
        if (isset($_POST)) {

            if ($form->isValid()) {
                $data = $form->getData();

                $email = $data['email'];
                $password = $data['password'];

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
            }

        }
        return $app['twig']->render('login.html.twig',array("errors" => $errors,'form' => $form->createView()));

    }
}