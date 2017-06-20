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
        $comments = $this->commentRepository->getCommentsByPostId($id);
        $thread = array();
        $comment_refs = array();
        while ( count($comments)> 0 ) {
            foreach($comments as $i=>$comment){
                $parent_id = $comment['parent_id'];
                $comment_id = $comment['id'];
                if (!$parent_id) {
                    $thread[] = $comment;
                    $tmp_key = count($thread) - 1;
                    $thread[$tmp_key]['replies'] = array();
                    $comment_refs[$comment_id] = &$thread[count($thread)-1];
                    unset($comments[$i]);
                } elseif (isset($comment_refs[$parent_id])) {
                    $comment_refs[$parent_id]['replies'][] = $comment;
                    $replies = &$comment_refs[$parent_id]['replies'];
                    $comment_refs[$comment_id] = &$replies[count($replies)-1];
                    unset($comments[$i]);
                }
            }
        }
        unset($comment_refs);
        return $thread;
    }
}