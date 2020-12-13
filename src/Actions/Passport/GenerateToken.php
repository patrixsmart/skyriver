<?php

namespace Patrixsmart\Skyriver\Actions\Passport;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Generatetoken
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
    public static function handle(Request $request)
    {
        return Http::post(config('passport.token_endpoint'),
        [
            'grant_type' => 'password',
            'client_id' => config('passport.password_grant_client.id'),
            'client_secret' => config('passport.password_grant_client.secret'),
            'username' => $request->input(static::username()),
            'password' =>  $request->password,
            'scope' => '*'
        ])->throw()->json();
    }
}
