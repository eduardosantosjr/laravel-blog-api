<?php

namespace App\Http\Controllers\v1;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Exceptions\BlogException;

class UserController extends Controller
{
    private $user;
    
    public function __construct(UserService $user)
    {
        $this->user = $user;
    }
    
    public function register(RegisterUserRequest $request)
    {
        try {
            $result = $this->user->register(
                $request->name,
                $request->email,
                $request->password
            );

            return response()->json([
                'status' => 'success',
                'data' => $result,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    
    public function login(LoginRequest $request)
    {
        try {
            
            $result = $this->user->login(
                $request->email,
                $request->password
            );

            return response()->json([
                'status' => 'success',
                'data' => $result,
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

    public function logout()
    {
        try {
            $this->user->logout();

            return response()->json([
                'status' => 'success',
                'data' => null,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function details()
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => $this->user->show(),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
