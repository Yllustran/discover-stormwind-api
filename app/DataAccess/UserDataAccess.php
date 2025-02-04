<?php

namespace App\DataAccess;

use App\Models\User;

class UserDataAccess
{
    public function createUser(string $email, string $hashedPassword)
    {
        return User::create([
            'email' => $email,
            'password' => $hashedPassword,
        ]);
    }
}
