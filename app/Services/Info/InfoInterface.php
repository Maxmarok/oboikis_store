<?php

namespace App\Services\Info;

interface InfoInterface {

    /**
    * Return all information
    */
    public function getInfo(): \Illuminate\Http\JsonResponse;

    /**
    * Update information and information cache 
    */
    public function updateInfo(array $data): \Illuminate\Http\JsonResponse;

    /**
    * Upload file in storage
    */
    public function uploadFile(array $data): \Illuminate\Http\JsonResponse;
}