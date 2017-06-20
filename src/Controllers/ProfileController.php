<?php
/**
 * Created by PhpStorm.
 * User: rustam
 * Date: 19.06.17
 * Time: 15:22
 */

namespace Controllers;


use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class ProfileController
{
    private $postService;
    private $userService;

    function __construct($postService, $userService) {
        $this->postService = $postService;
        $this->userService = $userService;
    }

    public function profile(Application $app, Request $request) {
        $size = $this->postService->getPostsSizeByUserId($app['session']->get('user')->getId());
        $numPages = ceil($size["count"] / $this->postService::LIMIT_POSTS );
        $curPage = $request->get('page');
        $posts = $this->postService->getPostsByUserId($app['session']->get('user')->getId(),$curPage);


        return $app['twig']->render('profile.html.twig',array(
            'user' => $app['session']->get('user'),
            'posts' => $posts,
            'size' => $size,
            'numPages' => $numPages,
            'curPage' => $curPage,
            'here' => $request->getPathInfo()
        ));
    }

    public function userProfile(Application $app, Request $request, $id) {
        $size = $this->postService->getPostsSizeByUserId($id);
        $numPages = ceil($size["count"] / $this->postService::LIMIT_POSTS );
        $curPage = $request->get('page');
        $user= $this->userService->getUserById($id);
        $posts = $this->postService->getPostsByUserId($id,$curPage);


        if (!empty($user)) {
            return $app['twig']->render('userProfile.html.twig', array(
                'user' => $user,
                'posts' => $posts,
                'size' => $size,
                'numPages' => $numPages,
                'curPage' => $curPage,
                'here' => $request->getPathInfo()
            ));
        } else {
            return $app['twig']->render('404.html.twig');
        }
    }
}