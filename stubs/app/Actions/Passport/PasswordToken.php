<?php

namespace App\Actions\Skyriver\Passport;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PasswordToken
{
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public static function username()
    {
        return 'email';
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function handle(Request $request, $clientId, $clientSecret, $scope = '*')
    {
        return Http::asForm()->post(config('skyriver.passport.token_endpoint'),
        [
            'grant_type' => 'password',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'username' => $request->input(static::username()),
            'password' =>  $request->password,
            'scope' => $scope
        ])->throw()->json();
    }
}
