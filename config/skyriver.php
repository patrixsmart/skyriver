<?php

return [

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
    ]

];
