<?php
/**
 * Created by PhpStorm.
 * User: rustam
 * Date: 16.06.17
 * Time: 21:04
 */

namespace Repositories;

use Doctrine\DBAL\Connection;


class UserRepository
{
    private $db;

    public function __construct(Connection $db) {
        $this->db = $db;
    }

    public function save($email, $password, $uploadfile) {
        $sql = 'INSERT INTO users(password,email,image_url) VALUES(:password,:email,:file)';

        $statement=$this->db->prepare($sql);
        $statement->bindValue(':password',$password);
        $statement->bindValue(':email',$email);
        $statement->bindValue(':file',$uploadfile);

        return $statement->execute();
    }

    public function getUserByEmail($email)
    {
        $sql = 'SELECT * FROM users WHERE email = :email';
        $statement = $this->db->prepare($sql);
        $statement->bindValue(':email', $email);
        if ($statement->execute()) {
            return $statement->fetch();
        }else{
            return false;
        }
    }

    public function getUserById($id) {
        $sql = 'SELECT id,email,image_url FROM users WHERE id = :id';
        $statement = $this->db->prepare($sql);
        $statement->bindValue(':id', $id);
        if ($statement->execute()) {
            return $statement->fetch();
        }else{
            return false;
        }
    }
}