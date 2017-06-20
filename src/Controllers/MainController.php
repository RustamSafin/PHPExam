<?php
/**
 * Created by PhpStorm.
 * User: rustam
 * Date: 19.06.17
 * Time: 10:10
 */

namespace Controllers;


use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class MainController
{
    private $postService;

    function __construct($postService) {
        $this->postService = $postService;
    }

    public function main(Application $app, Request $request) {
        $size = $this->postService->getAllPostsSize();
        $numPages = ceil($size["count"] / $this->postService::LIMIT_POSTS );
        $curPage = $request->get('page');
        $posts = $this->postService->getAllPosts($curPage);
        return $app['twig']->render('main.html.twig', array(
            'posts' => $posts,
            'user' => $app['session']->get('user'),
            'size' => $size,
            'numPages' => $numPages,
            'curPage' => $curPage,
            'here' => $request->getPathInfo()
        ));
    }
}