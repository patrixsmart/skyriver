<?php

namespace Patrixsmart\Skyriver\Actions\Passport;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RefreshToken
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function handle(Request $request, $clientId = null, $clientSecret = null)
    {
        $clientId = $clientId ?: config('passport.password_grant_client.id');
        $clientSecret =  $clientSecret ?: config('passport.password_grant_client.secret');

        return Http::post(config('passport.token_endpoint'),
        [
            'grant_type' => 'refresh_token',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'refresh_token' => $request->refresh_token,
            'scope' => '*'
        ])->throw()->json();
    }
}
