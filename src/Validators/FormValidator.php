<?php
/**
 * Created by PhpStorm.
 * User: rustam
 * Date: 18.06.17
 * Time: 11:59
 */

namespace Validators;


class FormValidator {

    static function validateRegForm()
    {
        $errors = [];
        if (!isset($_POST["email"]) || !isset($_POST["password"]) || !isset($_POST["confirmPass"])) {
            $errors[] = "some fields is not present";
        }
        if (empty($_POST["email"]) || empty($_POST["password"])) {
            $errors[] = "some fields is empty";

        }
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "email is not valid";
        }
        if (!($_POST["password"] === $_POST["confirmPass"])) {
            $errors[] = "passwords does not equals";
        }
        if (!(($_FILES['file']['type'] === "image/png") || ($_FILES['file']['type'] === "image/jpeg"))) {
            $errors[] = $_FILES['file']['type'];
            $errors[] = "error of type";
        }
        if ($_FILES['file']['error'] == 2) {
            $errors[] = "file is too big";
        }
        return $errors;
    }

    static function validateLogFrom($email, $password) {
        $errors = [];
        if (!isset($email) || !isset($password)) {
            $errors[] = "some fields is not present";
        }
        if (empty($email) || empty($password)) {
            $errors[] = "some fields is empty";
        }
        return $errors;
    }

    static function validatePostForm($title, $content) {
        $errors = [];
        if (!isset($title) || !isset($content)) {
            $errors[] = "some fields is not present";
        }
        if (empty($title) || empty($content)) {
            $errors[] = "some fields is empty";
        }
        return $errors;
    }
}