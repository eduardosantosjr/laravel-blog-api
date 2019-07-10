<?php

namespace App\Http\Controllers\v1;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Controllers\Controller;
use App\Exceptions\BlogException;
use App\Services\PostService;

class PostController extends Controller
{
    private $post;

    public function __construct(PostService $post)
    {
        $this->post = $post;
    }
    
    public function list()
    {
        try {
            return response()->json(
                [
                    'status' => 'success',
                    'data' => $this->post->getByUserId(),
                ],
                200
            );
        
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ],
                500
            );
        }
    }

    public function show($id)
    {
        try {
            return response()->json(
                [
                    'status' => 'success',
                    'data' => $this->post->getByIdAndUserId($id),
                ],
                200
            );
        
        } catch (BlogException $e) {
            return response()->json(
                [
                    'status' => 'fail',
                    'message' => $e->getMessage(),
                ],
                422
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ],
                500
            );
        }
    }

    public function store(StorePostRequest $request)
    {
        try {
            $this->post->store(
                $request->id,
                $request->title,
                $request->content
            );

            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Post stored successfully!',
                ],
                200
            );
        
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ],
                500
            );
        }
    }

    public function delete($id)
    {
        try {
            $this->post->delete($id);

            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Post deleted successfully!',
                ],
                200
            );
        
        } catch (BlogException $e) {
            return response()->json(
                [
                    'status' => 'fail',
                    'message' => $e->getMessage(),
                ],
                422
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ],
                500
            );
        }
    }

    public function publish($id)
    {
        try {
            $this->post->publish($id);

            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Post published successfully!',
                ],
                200
            );
        
        } catch (BlogException $e) {
            return response()->json(
                [
                    'status' => 'fail',
                    'message' => $e->getMessage(),
                ],
                422
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ],
                500
            );
        }
    }

    public function unpublish($id)
    {
        try {
            $this->post->unpublish($id);
            
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Post unpublished successfully!',
                ],
                200
            );
        
        } catch (BlogException $e) {
            return response()->json(
                [
                    'status' => 'fail',
                    'message' => $e->getMessage(),
                ],
                422
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ],
                500
            );
        }
    }

    public function search(SearchRequest $request)
    {
        try {
            return response()->json(
                [
                    'status' => 'success',
                    'data' => $this->post->search(
                        $request->content
                    ),
                ],
                200
            );
        
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ],
                500
            );
        }
    }
}
