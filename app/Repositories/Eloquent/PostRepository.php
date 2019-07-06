<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\PostInterface;
use App\Exceptions\BlogException;
use App\Models\Post;
use Carbon\Carbon;

class PostRepository implements PostInterface
{
    public function list(int $user_id)
    {
        return Post::query()
            ->where('user_id', $user_id)
            ->paginate(10);
    }
    
    public function find(int $id, int $user_id)
    {
        $post = Post::query()
            ->where('id', $id)
            ->where('user_id', $user_id)
            ->first();
        
        if (!$post) {
            throw new BlogException('Post not found!');
        }

        return $post;
    }
    
    public function store(
        $id,
        int $user_id,
        string $title,
        string $content
    ) : void
    {
        $post = Post::firstOrNew(['id' => $id]);
        $post->user_id = $user_id;
        $post->title = $title;
        $post->content = $content;
        $post->save();
    }

    public function delete(int $id, int $user_id) : void
    {
        $post = $this->find($id, $user_id);
        $post->delete();
    }
    
    public function publish(int $id, int $user_id) : void
    {
        $post = $this->find($id, $user_id);
        $post->update([
            'published' => true,
            'published_at' => Carbon::now()->toDateTimeString()
        ]);
    }

    public function unpublish(int $id, int $user_id) : void
    {
        $post = $this->find($id, $user_id);
        $post->update([
            'published' => false,
            'published_at' => null
        ]);
    }

    public function search(string $content)
    {
        return 'search';
    }
}