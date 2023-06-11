<?php

namespace App\Services;

interface UserServiceInterface 
{
    public function registerUser(string $name, string $email, string $password);
}
