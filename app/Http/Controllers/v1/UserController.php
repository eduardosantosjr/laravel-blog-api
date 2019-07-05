<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request['password'] = Hash::make($request['password']);
            $user = User::create($request->toArray());
            $token = $user->createToken('Personal Access Token')->accessToken;
            
            return response()->json([
                'status' => 'success',
                'data' => [
                    'token' => $token,
                    'user' => $user,
                ],
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    
    public function login(Request $request)
    {
        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) { 
                $user = Auth::user(); 
                $token =  $user->createToken('Personal Access Token')->accessToken; 
                
                return response()->json([
                    'status' => 'success',
                    'data' => [
                        'token' => $token,
                        'user' => $user,
                    ],
                ], 200);
            } 
            
            return response()->json([
                'status' => 'fail',
                'message' => 'Unauthorized.',
            ], 422);

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
                'data' => Auth::user(),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
