<?php

return [
    'app_client_id' => env('SBIS_APP_CLIENT_ID'),

    'login' => env('SBIS_LOGIN'),

    'password' => env('SBIS_PASSWORD'),

    'url' => [
        'token' => env('SBIS_URL_TOKEN'),
        'point' => env('SBIS_URL_POINT'),
        'price' => env('SBIS_URL_PRICE'),
        'items' => env('SBIS_URL_ITEMS'),
        'image' => env('SBIS_URL_IMAGE'),
        'order' => env('SBIS_URL_ORDER'),
        'shop' => env('SBIS_URL_SHOP'),
        'success' => env('SBIS_URL_SUCCESS'),
        'error' => env('SBIS_URL_ERROR'),
    ],
];