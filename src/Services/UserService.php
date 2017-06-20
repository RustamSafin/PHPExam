<?php
/**
 * Created by PhpStorm.
 * User: rustam
 * Date: 17.06.17
 * Time: 17:08
 */

namespace Services;


use Models\User;

class UserService
{
    private $userRepository;

    public function __construct($userRepository) {
        $this->userRepository = $userRepository;
    }

    public function save($user) {
        $password = $user->getPassword();
        $password = password_hash($password, PASSWORD_BCRYPT);

        $filename = uniqid() . $user->getImage()->getClientOriginalName();
        if ($user->getImage()->move(__DIR__.'/../../web/images/avatars/', $filename )) $user->setImage($filename);


        return $this->userRepository->save($user->getEmail(), $password, $user->getImage());
    }

    public function getUserByEmail($email) {
        $res = $this->userRepository->getUserByEmail($email);
        if (empty($res)) {return null;}
        $user = new User();
        $user->setId($res["id"]);
        $user->setEmail($res["email"]);
        $user->setImage($res["image_url"]);
        $user->setPassword($res["password"]);
        return $user;
    }

    public function getUserById($id) {
        $res = $this->userRepository->getUserById($id);
        if (empty($res)) {return null;}
        $user = new User();
        $user->setId($res["id"]);
        $user->setEmail($res["email"]);
        $user->setImage($res["image_url"]);
        return $user;
    }
}