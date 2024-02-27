<?php

namespace App\Services\Auth;

use Illuminate\Http\JsonResponse;

interface AuthInterface 
{
    /**
     * Login attempt by user
     */
    public function login(array $data): JsonResponse;
}