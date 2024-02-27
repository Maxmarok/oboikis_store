<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Services\Auth\AuthInterface;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * Login attempt by user
     */
    public function login(AuthInterface $service, UserLoginRequest $request): JsonResponse
    {
        return $service->login($request->validated());
    }
}
