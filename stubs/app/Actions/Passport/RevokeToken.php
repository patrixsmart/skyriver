<?php

namespace App\Actions\Skyriver\Passport;

use Illuminate\Http\Request;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\RefreshTokenRepository;

class RevokeToken
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function handle(Request $request)
    {
        $tokenId = $request->user()->token()->id;

        // Revoke an access token...
        $tokenRepository = new TokenRepository;
        $tokenRepository->revokeAccessToken($tokenId);

        // Revoke all of the token's refresh tokens...
        $refreshTokenRepository = new RefreshTokenRepository;
        $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($tokenId);

        return 1;
    }
}
