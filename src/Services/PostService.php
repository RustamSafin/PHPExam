<?php
/**
 * Created by PhpStorm.
 * User: rustam
 * Date: 17.06.17
 * Time: 17:08
 */

namespace Services;


use Models\Post;

class PostService
{
    const LIMIT_POSTS = 2;
    private $postRepository;

    public function __construct($postRepository) {
        $this->postRepository = $postRepository;
    }

    public function save($post) {
        return $this->postRepository->save($post->getTitle(),$post->getContent(),$post->getUserId());
    }

    public function getPostById($id) {
        return $this->postRepository->getPostById($id);
    }

    public function getPostsByUserId($id, $page = 0) {
        if ($page < 1 ) $page = 1;

        $offset = ($page - 1) * self::LIMIT_POSTS;

        return $this->postRepository->getPostsByUserId($id, $offset, self::LIMIT_POSTS);
    }

    public function getPostsSizeByUserId($id) {
        return $this->postRepository->getPostsSizeByUserId($id);
    }

    public function getAllPosts($page = 0) {
        if ($page < 1 ) $page = 1;

        $offset = ($page - 1) * self::LIMIT_POSTS;

        return $this->postRepository->getAllPosts($offset, self::LIMIT_POSTS);
    }

    public function getAllPostsSize() {
        return $this->postRepository->getAllPostsSize();
    }

    public function getPostId() {
        return $this->postRepository->getPostId();
    }
}