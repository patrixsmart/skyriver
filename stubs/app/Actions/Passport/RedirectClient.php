<?php

namespace App\Actions\Skyriver\Passport;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RedirectClient
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function handle(Request $request, $clientId, $clientRedirectUri, $scope = '*', $responseType = 'code')
    {
        $request->session()->put('state', $state = Str::random(40));

        $request->session()->put('code_verifier', $code_verifier = Str::random(128));

        $codeChallenge = strtr(rtrim(
            base64_encode(hash('sha256', $code_verifier, true))
        , '='), '+/', '-_');

        $query = http_build_query([
            'client_id' => $clientId,
            'redirect_uri' => $clientRedirectUri,
            'response_type' => $responseType,
            'scope' => $scope,
            'state' => $state,
            'code_challenge' => $codeChallenge,
            'code_challenge_method' => 'S256',
        ]);

        return redirect(config('skyriver.passport.authorization_endpoint').$query);
    }
}
