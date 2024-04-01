<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Services\Auth\AuthInterface;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(
        private AuthInterface $service
    ){}

    /**
     * Login attempt by user
     */
    public function login(UserLoginRequest $request): JsonResponse
    {
        return $this->service->login($request->validated());
    }
}
