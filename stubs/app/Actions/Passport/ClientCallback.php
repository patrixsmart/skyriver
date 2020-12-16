<?php

namespace App\Actions\Skyriver\Passport;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ClientCallback
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function handle(Request $request, $clientId = null, $clientSecret = null, $clientRedirectUri = null)
    {

        $state = $request->session()->pull('state');

        $codeVerifier = $request->session()->pull('code_verifier');

        throw_unless(
            strlen($state) > 0 && $state === $request->state,
            InvalidArgumentException::class
        );

        return Http::asForm()->post(config('skyriver.passport.token_endpoint'), [
            'grant_type' => 'authorization_code',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'redirect_uri' => $clientRedirectUri,
            'code' => $request->code,
            'code_verifier' => $codeVerifier,
        ])->throw()->json();
    }
}
