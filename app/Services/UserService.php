<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Eloquent\UserRepository;
use App\Exceptions\BlogException;

class UserService
{
    private $user;
    
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }
    
    public function register(
        string $name,
        string $email,
        string $password
    ) : array 
    {
        $user = $this->user->create(
            $name,
            $email,
            Hash::make($password)
        );
        
        $token = $user->createToken('Personal Access Token')->accessToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function login(
        string $email,
        string $password
    ) : array
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) { 
            $user = Auth::user(); 
            $token =  $user->createToken('Personal Access Token')->accessToken;
            
            return [
                'token' => $token,
                'user' => $user,
            ];
        }

        throw new BlogException('Unauthorized.');
    }

    public function logout() : void
    {
        Auth::user()->token()->revoke();
    }

    public function details() : Object
    {
        return Auth::user();
    }
}