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
    
    public function list()
    {
        $user = Auth::user();
        
        return $this->post->list($user->id);
    }

    public function show(int $id)
    {
        $user = Auth::user();
        
        return $this->post->find(
            $id, 
            $user->id
        );
    }

    public function store(
        $id,
        string $title,
        string $content
    ) :string 
    {
        $user = Auth::user();

        $this->post->store(
            $id,
            $user->id,
            $title,
            $content
        );
        
        return 'Post stored successfully!';
    }

    public function delete(int $id)
    {
        $user = Auth::user();
        
        $this->post->delete(
            $id,
            $user->id
        );
        
        return 'Post deleted successfully!';
    }

    public function publish(int $id)
    {
        $user = Auth::user();
        
        $this->post->publish(
            $id,
            $user->id
        );
        
        return 'Post published successfully!';
    }

    public function unpublish(int $id)
    {
        $user = Auth::user();
        
        $this->post->unpublish(
            $id,
            $user->id
        );
        
        return 'Post unpublished successfully!';
    }

    public function search(string $content)
    {
        return 'search';
    }
}