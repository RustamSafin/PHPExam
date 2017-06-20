<?php
/**
 * Created by PhpStorm.
 * User: rustam
 * Date: 20.06.17
 * Time: 12:57
 */

namespace Services;


class CommentService
{
    private $commentRepository;

    public function __construct($commentRepository) {
        $this->commentRepository = $commentRepository;
    }

    public function save($comment) {
        return $this->commentRepository->save($comment->getText(),$comment->getPostId(),$comment->getUser()->getId(),$comment->getParentId());
    }

    public function getCommentsByPostId($id) {
        $result = $this->commentRepository->getCommentsByPostId($id);
        foreach ($result as $comment) {
            
        }
    }
}