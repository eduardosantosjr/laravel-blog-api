<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface
{
    public function create(string $name, string $email, string $password)
    {
        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);
    }
}