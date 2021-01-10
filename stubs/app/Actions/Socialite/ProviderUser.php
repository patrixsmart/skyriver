<?php

namespace App\Actions\Skyriver\Socialite;

use Laravel\Socialite\Facades\Socialite;

class ProviderUser
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function handle($provider, $providerToken = null, $providerSecret = null)
    {

        $socialiteProvider = $provider == 'twitter'?
                                Socialite::driver($provider):
                                Socialite::driver($provider)->stateless();

        if($providerToken && $providerSecret){

            return $socialiteProvider->userFromTokenAndSecret($providerToken, $providerSecret);
        }

        if($providerToken){

            return $socialiteProvider->userFromToken($providerToken);
        }

       return $socialiteProvider->user();
    }
}
