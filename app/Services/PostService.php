<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Repositories\Eloquent\PostRepository;

class PostService
{
    private $post;
    
    public function __construct(PostRepository $post)
    {
        $this->post = $post;
    }
    
    public function getByUserId()
    {
        $user = Auth::user();
        
        return $this->post->getByUserId($user->id);
    }

    public function getByIdAndUserId(int $id)
    {
        $user = Auth::user();
        
        return $this->post->getByIdAndUserId(
            $id, 
            $user->id
        );
    }

    public function store(
        $id,
        string $title,
        string $content
    ) {
        $user = Auth::user();

        return $this->post->store(
            $id,
            $user->id,
            $title,
            $content
        );
    }

    public function delete(int $id)
    {
        $user = Auth::user();
        
        return $this->post->delete(
            $id,
            $user->id
        );
    }

    public function publish(int $id)
    {
        $user = Auth::user();
        
        return $this->post->publish(
            $id,
            $user->id
        );
    }

    public function unpublish(int $id)
    {
        $user = Auth::user();
        
        return $this->post->unpublish(
            $id,
            $user->id
        );
    }

    public function search(string $content)
    {
        return $this->post->search($content);
    }
}