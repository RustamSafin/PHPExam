<?php
/**
 * Created by PhpStorm.
 * User: rustam
 * Date: 20.06.17
 * Time: 12:56
 */

namespace Repositories;

use Doctrine\DBAL\Connection;

class CommentRepository
{
    private $db;

    public function __construct(Connection $db) {
        $this->db = $db;
    }

    public function save($text, $pid, $uid, $parentId) {
        $sql = 'INSERT INTO comments(text,post_id,user_id,parent_id) VALUES(:text,:pid,:uid,:parentId)';

        $statement=$this->db->prepare($sql);
        $statement->bindValue(':text',$text);
        $statement->bindValue(':pid',$pid);
        $statement->bindValue(':uid',$uid);
        $statement->bindValue(':parentId',$parentId);
        $statement->execute();
        return $this->db->lastInsertId('posts_id_seq');
    }

    public function getCommentsByPostId($postId) {
        $sql = 'SELECT comments.id, text, post_id, user_id, created_at::timestamp(0), parent_id, users.email FROM comments INNER JOIN users ON posts.user_id = users.id WHERE post_id = :postId ORDER BY created_at DESC ';

        $statement=$this->db->prepare($sql);
        $statement->bindValue(':postId',$postId);
        $statement->execute();
        if ($statement->execute()) {
            return $statement->fetchAll();
        }else{
            return false;
        }
    }
}