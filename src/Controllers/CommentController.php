<?php
/**
 * Created by PhpStorm.
 * User: rustam
 * Date: 20.06.17
 * Time: 17:27
 */

namespace Controllers;


use Models\Comment;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class CommentController
{
    private $commentService;

    function __construct($commentService) {
        $this->commentService = $commentService;
    }

    public function commentPost(Application $app, Request $request) {
        $comment = new Comment();
        $comment->setText($request->get('text'));
        $comment->setPostId($request->get('post_id'));
        $comment->setParentId($request->get('parent_id'));
        $comment->setUser($app['session']->get('user'));
        $result = $this->commentService->save($comment);
        return $app->redirect('/post/'.$request->get('post_id'));
    }
}