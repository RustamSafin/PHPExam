<?php
/**
 * Created by PhpStorm.
 * User: rustam
 * Date: 19.06.17
 * Time: 10:13
 */

namespace Repositories;


use Doctrine\DBAL\Connection;

class PostRepository
{
    private $db;

    public function __construct(Connection $db) {
        $this->db = $db;
    }

    public function save($title, $content, $uid) {
        $sql = 'INSERT INTO posts(title,content,user_id) VALUES(:title,:content,:uid)';

        $statement=$this->db->prepare($sql);
        $statement->bindValue(':title',$title);
        $statement->bindValue(':content',$content);
        $statement->bindValue(':uid',$uid);
        $statement->execute();
        return $this->db->lastInsertId('posts_id_seq');
    }

    public function getPostById($id) {
        $sql = 'SELECT created_at::timestamp(0),user_id,title,content,posts.id as postId,users.email FROM posts INNER JOIN users ON posts.user_id = users.id WHERE posts.id = :id;';
        $statement=$this->db->prepare($sql);
        $statement->bindValue(':id',$id);
        if ($statement->execute()) {
            return $statement->fetch();
        }else{
            return false;
        }
    }

    public function getPostsByUserId($id, $offset, $limit) {
        $sql = 'SELECT created_at::timestamp(0),user_id,title,content,id FROM posts WHERE user_id = :id ORDER BY created_at DESC LIMIT :limit OFFSET :offset';
        $statement=$this->db->prepare($sql);
        $statement->bindValue(':id',$id);
        $statement->bindValue(':limit', $limit);
        $statement->bindValue(':offset', $offset);
        if ($statement->execute()) {
            return $statement->fetchAll();
        }else{
            return false;
        }
    }

    public function getPostsSizeByUserId($id) {
        $sql = 'SELECT count(*) FROM posts WHERE user_id = :id';
        $statement=$this->db->prepare($sql);
        $statement->bindValue(':id',$id);
        if ($statement->execute()) {
            return $statement->fetch();
        }else{
            return false;
        }
    }

    public function getAllPosts($offset, $limit) {
        $sql = 'SELECT created_at::timestamp(0), user_id, title, posts.id as post_id, content, users.id as user_id, users.email FROM posts INNER JOIN users ON posts.user_id = users.id ORDER BY created_at DESC LIMIT :limit OFFSET :offset';
        $statement=$this->db->prepare($sql);
        $statement->bindValue(':limit', $limit);
        $statement->bindValue(':offset', $offset);
        if ($statement->execute()) {
            return $statement->fetchAll();
        }else{
            return false;
        }
    }

    public function getAllPostsSize() {
        $sql = 'SELECT count(*) FROM posts';
        $statement=$this->db->prepare($sql);
        if ($statement->execute()) {
            return $statement->fetch();
        }else{
            return false;
        }
    }

    public function getPostId() {
        return $this->db->lastInsertId('posts_id_seq');
    }
}