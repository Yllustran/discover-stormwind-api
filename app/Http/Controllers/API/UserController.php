<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function currentUser(): JsonResponse
    {
        $response = $this->userService->getCurrentUser();

        return response()->json($response, $response['status_code']);
    }
}
