<?php
/**
 * Created by PhpStorm.
 * User: rustam
 * Date: 16.06.17
 * Time: 20:55
 */

namespace Models;


class User
{
    private $id;

    private $password;

    private $email;

    private $image_url;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($mail) {
        $this->email = $mail;
    }

    public function getImage() {
        return $this->image_url;
    }

    public function setImage($image_url) {
        $this->image_url = $image_url;
    }

}