<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    // Request for Register a new user
    public function register(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:255',
        ]);

        $response = $this->authService->register($data);

        return response()->json($response, $response['status_code']);
    }

    // Request for login
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $response = $this->authService->login($data);

        return response()->json($response, $response['status_code']);
    }

    // Request for logout
    public function logout()
    {
        $response = $this->authService->logout();
        return response()->json($response, $response['status_code']);
    }
}
