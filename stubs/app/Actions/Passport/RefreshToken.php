<?php

namespace App\Actions\Skyriver\Passport;

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
    public static function handle(Request $request, $clientId, $clientSecret, $scope = '')
    {
        return Http::asForm()->post(config('skyriver.passport.token_endpoint'),
        [
            'grant_type' => 'refresh_token',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'refresh_token' => $request->refresh_token,
            'scope' => $scope
        ])->throw()->json();
    }
}
