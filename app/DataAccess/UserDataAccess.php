<?php

namespace App\DataAccess;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserDataAccess
{
    public function createUser(string $email, string $hashedPassword)
    {
        return User::create([
            'email' => $email,
            'password' => $hashedPassword,
        ]);
    }

    public function getAuthenticatedUser()
    {
        return Auth::user();
    }
}

