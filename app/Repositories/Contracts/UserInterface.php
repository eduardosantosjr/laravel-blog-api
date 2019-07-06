<?php

namespace App\Repositories\Contracts;

interface UserInterface
{
    public function create(string $name, string $email, string $password);
}