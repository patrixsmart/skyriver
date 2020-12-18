<?php

namespace App\Http\Controllers\Skyriver\Socialite;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use App\Actions\Skyriver\Passport\PersonalToken;
use App\Actions\Skyriver\Socialite\ProviderUser;

class ProviderController extends Controller
{
    /**
     * Redirect the user to the Provider authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider(Request $request, $provider)
    {
        return Socialite::driver($provider)
        ->with([])
        ->scopes($request->scopes)
        ->stateless()
        ->redirect();
    }

    /**
     * Obtain the user information from Provider.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request, $provider)
    {
        $providerUser = ProviderUser::handle($provider);

        $user = User::whereEmail($providerUser->getEmail())->firstOrFail();

        $socialAccount = $user->social_accounts()->where([
            'provider' => $provider,
            'provider_id' => $providerUser->getId()
        ])->first();

        if(!$socialAccount){

            $user->social_accounts()->create(
                $this->neededData($provider, $providerUser)
            );
        } else {

            $socialAccount->update(
                $this->neededData($provider, $providerUser)
            );
        }

        return  $this->authenticate($request, $user, $provider);
    }

    /**
     *  Get social media account informations.
     *
     * @param $providerUser
     * @return array
     */
    protected function neededData($provider, $providerUser)
    {
        return [
            "provider" => $provider,
            "provider_id" => $providerUser->getId(),
            "token" => $providerUser->token,
            "token_secret" => $provider == 'twitter' ? $providerUser->tokenSecret : null,
            "refresh_token" => $provider != 'twitter' ? $providerUser->refreshToken : null,
            "expires_in" => $provider != 'twitter' ? $providerUser->expiresIn : null,
            "name" => $providerUser->getName(),
            "nickname" => $providerUser->getNickname(),
            "email" => $providerUser->getEmail(),
            "avatar" => $providerUser->getAvatar(),
            "content" => json_encode($providerUser)
        ];
    }

    /**
     *
     */
    protected function authenticate(Request $request, User $user, $provider)
    {
        if($request->wantsJson())
        {
            // Generate Personal Token
            return PersonalToken::handle($user, 'Social authentication for'.$provider.'@'.time());
        }

        Auth::login($user);

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
