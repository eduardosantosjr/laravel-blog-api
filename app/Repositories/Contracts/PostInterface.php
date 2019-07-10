<?php

namespace App\Repositories\Contracts;

interface PostInterface
{
    public function getByUserId(int $userId);
    public function getByIdAndUserId(int $id, int $userId);
    public function store(
        $id,
        int $userId,
        string $title,
        string $content
    );
    public function delete(int $id, int $userId);
    public function publish(int $id, int $userId);
    public function unpublish(int $id, int $userId);
    public function search(string $content);
}