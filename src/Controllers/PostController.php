<?php
/**
 * Created by PhpStorm.
 * User: rustam
 * Date: 19.06.17
 * Time: 10:17
 */

namespace Controllers;


use Models\Post;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Validators\FormValidator;

class PostController
{
    private $postService;

    function __construct($postService) {
        $this->postService = $postService;
    }

    public function createGet (Application $app) {
        return $app['twig']->render('createPost.html.twig',array(
            "errors" => "",
            "user" => $app['session']->get('user'),
        ));
    }

    public function createPost (Application $app, Request $request) {
        $errors = FormValidator::validatePostForm($request->get('title'),$request->get('content'));
        $purifier = new \HTMLPurifier();
        if (empty($errors)) {
            $post = new Post();
            $post->setTitle($request->get('title'));
            $post->setContent($purifier->purify($request->get('content')));
            $post->setUserId($app['session']->get('user')->getId());
            $id = $this->postService->save($post);
            return $app->redirect('/post/'.$id);
        } else {
            return $app['twig']->render('createPost.html.twig',array(
                "errors" => $errors,
                "user" => $app['session']->get('user'),
            ));
        }
    }

    public function index(Application $app, $id) {
        $post = $this->postService->getPostById($id);
        if (!empty($post)) {
            return $app['twig']->render('indexPost.html.twig',array(
                'post' => $post,
                'user' => $app['session']->get('user'),
            ));
        } else {
            return $app['twig']->render('404.html.twig');
        }
    }
}