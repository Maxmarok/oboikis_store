<?php

namespace App\Services\Info;

use Illuminate\Http\JsonResponse;

interface InfoInterface {

    /**
    * Return all information
    */
    public function getInfo(): JsonResponse;

    /**
    * Update information and information cache 
    */
    public function updateInfo(array $data): JsonResponse;

    /**
    * Upload file in storage
    */
    public function uploadFile(array $data): JsonResponse;
}