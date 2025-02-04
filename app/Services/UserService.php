<?php

namespace App\Services;

use App\DataAccess\UserDataAccess;
use Illuminate\Support\Facades\Auth;

class UserService
{
    protected $userDataAccess;

    public function __construct(UserDataAccess $userDataAccess)
    {
        $this->userDataAccess = $userDataAccess;
    }

    public function getCurrentUser()
    {
        $user = $this->userDataAccess->getAuthenticatedUser();

        if (!$user) {
            return [
                'status' => 'error',
                'message' => 'Unauthorized',
                'status_code' => 401
            ];
        }

        return [
            'status' => 'success',
            'message' => 'User fetched successfully!',
            'user' => $user,
            'status_code' => 200
        ];
    }
}
