<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\PostInterface;
use App\Exceptions\BlogException;
use App\Models\Post;
use Carbon\Carbon;

class PostRepository implements PostInterface
{
    public function getByUserId(int $userId)
    {
        return Post::query()
            ->where('user_id', $userId)
            ->paginate(10);
    }
    
    public function getByIdAndUserId(int $id, int $userId)
    {
        $post = Post::query()
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();
        
        if (!$post) {
            throw new BlogException('Post not found!');
        }

        return $post;
    }
    
    public function store(
        $id,
        int $userId,
        string $title,
        string $content
    ) : void {
        $post = Post::firstOrNew(['id' => $id]);
        $post->user_id = $userId;
        $post->title = $title;
        $post->content = $content;
        $post->save();
    }

    public function delete(int $id, int $userId) : void
    {
        $post = $this->getByIdAndUserId($id, $userId);
        $post->delete();
    }
    
    public function publish(int $id, int $userId) : void
    {
        $post = $this->getByIdAndUserId($id, $userId);
        $post->update([
            'published' => true,
            'published_at' => Carbon::now()->toDateTimeString()
        ]);
    }

    public function unpublish(int $id, int $userId) : void
    {
        $post = $this->getByIdAndUserId($id, $userId);
        $post->update([
            'published' => false,
            'published_at' => null
        ]);
    }

    public function search(string $content)
    {
        $post = Post::query()
            ->select(
                'title',
                'content'
            )
            ->search($content)
            ->where('published', true)
            ->paginate(10);
        
        return $post;
    }
}