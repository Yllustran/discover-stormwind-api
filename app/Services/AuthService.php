<?php

namespace App\Services;

use App\DataAccess\UserDataAccess;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthService
{
    protected $userDataAccess;

    public function __construct(UserDataAccess $userDataAccess)
    {
        $this->userDataAccess = $userDataAccess;
    }

    // Register a new user
    public function register(array $data)
    {
        $user = $this->userDataAccess->createUser($data['email'], Hash::make($data['password']));
        $token = JWTAuth::fromUser($user);

        return [
            'status' => 'success',
            'message' => 'User registered successfully!',
            'user' => $user,
            'access_token' => [
                'token' => $token,
                'type' => 'Bearer',
                'expires_in' => JWTAuth::factory()->getTTL() * 60,
            ],
            'status_code' => 201
        ];
    }

    // Login user and return token
    public function login(array $credentials)
    {
        if (!$token = Auth::attempt($credentials)) {
            return [
                'status' => 'error',
                'message' => 'Invalid credentials',
                'status_code' => 401
            ];
        }

        return [
            'status' => 'success',
            'message' => 'User logged in successfully',
            'user' => Auth::user(),
            'access_token' => [
                'token' => $token,
                'type' => 'Bearer',
                'expires_in' => JWTAuth::factory()->getTTL() * 60,
            ],
            'status_code' => 200
        ];
    }

    // Logout user (Invalidate the token)
    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return [
                'status' => 'success',
                'message' => 'Successfully logged out',
                'status_code' => 200
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Failed to logout, please try again',
                'status_code' => 500
            ];
        }
    }
}
