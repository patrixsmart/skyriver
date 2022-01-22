<?php

return [
    "frontend" => [
        "app" => [
            "name" => env('SKYRIVER_FRONTEND_APP_Name'),
            "url" => env('SKYRIVER_FRONTEND_APP_URL')
        ],
    ],

    "passport" => [

        /*
        |--------------------------------------------------------------------------
        | Password Grant Client
        |--------------------------------------------------------------------------
        |
        */

        'password_grant_client' => [
            'id' => env('SKYRIVER_PASSPORT_PASSWORD_GRANT_CLIENT_ID'),
            'secret' => env('SKYRIVER_PASSPORT_PASSWORD_GRANT_CLIENT_SECRET'),
        ],

        /*
        |-------------------------------------------------------------------------
        | Passport Authorization Code
        |------------------------------------------------------------------------
        | This endpoint will authorize the client's authorization code and grant the
        | client
        */

        'authorization_endpoint' => env('SKYRIVER_PASSPORT_AUTHORIZATION_ENDPOINT'),

        /*
        |-------------------------------------------------------------------------
        | Passport Token
        |------------------------------------------------------------------------
        |
        |
        */

        'token_endpoint' => env('SKYRIVER_PASSPORT_TOKEN_ENDPOINT'),


        /*
        |--------------------------------------------------------------------------
        | Cookie Name
        |--------------------------------------------------------------------------
        |
        */

        'cookie_name' => env('SKYRIVER_PASSPORT_COOKIE_NAME','laravel_token') ,

        /*
        |--------------------------------------------------------------------------
        | Default Scope
        |--------------------------------------------------------------------------
        |
        */

        'default_scope' => [
            'check-status',
            'place-orders',
        ] ,

        /*
        |--------------------------------------------------------------------------
        | Tokens Can
        |--------------------------------------------------------------------------
        |
        */

        'tokens_can' => [
            'place-orders' => 'Place orders',
            'check-status' => 'Check order status',
        ],
    ]

];
