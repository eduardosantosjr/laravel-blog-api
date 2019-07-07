<?php

namespace App\Http\Controllers\v1;

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
            return response()->json([
                'status' => 'success',
                'data' => $this->post->list(),
            ], 200);
        
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => $this->post->show($id),
            ], 200);
        
        } catch (BlogException $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(StorePostRequest $request)
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => $this->post->store(
                    $request->id,
                    $request->title,
                    $request->content
                ),
            ], 200);
        
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function delete($id)
    {
        try {
            return response()->json([
                'status' => 'success',
                'message' => $this->post->delete($id),
            ], 200);
        
        } catch (BlogException $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function publish($id)
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => $this->post->publish($id),
            ], 200);
        
        } catch (BlogException $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function unpublish($id)
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => $this->post->unpublish($id),
            ], 200);
        
        } catch (BlogException $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /*public function search()
    {

    }*/
}
