<?php

namespace App\Repositories\Contracts;

interface PostInterface
{
    public function list(int $user_id);
    public function find(int $id, int $user_id);
    public function store(
        $id,
        int $user_id,
        string $title,
        string $content
    );
    public function delete(int $id, int $user_id);
    public function publish(int $id, int $user_id);
    public function unpublish(int $id, int $user_id);
    public function search(string $content);
}