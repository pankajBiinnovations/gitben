<?php

namespace App\Services;

use App\Models\User;

class UserService implements UserServiceInterface
{
    public function registerUser(string $name, string $email, string $password)
    {
       
        // Validation logic

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->save();

        // Other logic (e.g., sending emails, etc.)
    }
}
