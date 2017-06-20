<?php
/**
 * Created by PhpStorm.
 * User: rustam
 * Date: 16.06.17
 * Time: 11:02
 */


$app->get('/','main.controller:main');

$app->get('/login', 'login.controller:index');

$app->get('/logout', 'login.controller:logout');

$app->post('/login','login.controller:login');

$app->get('/registration', 'registration.controller:index');

$app->post('/registration', 'registration.controller:register');

$app->get('/post/{id}','post.controller:index')
    ->assert('id','\d+');

$app->get('/post/create', 'post.controller:createGet');

$app->post('/post/create','post.controller:createPost');

$app->get('/profile','profile.controller:profile');

$app->get('/user/{id}','profile.controller:userProfile')
    ->assert('id','\d+');

$app->post('/comment', 'comment.controller:commentPost');