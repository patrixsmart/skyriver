<?php

namespace App\Http\Controllers\Skyriver\Socialite;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use App\Actions\Skyriver\Passport\PersonalToken;
use App\Actions\Skyriver\Socialite\ProviderAccount;

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
        $providerAccount = ProviderAccount::handle($provider);

        $user = User::whereEmail($providerAccount->getEmail())->firstOrFail();

        // $socialAccount = $user->social_accounts()->where([
        //     'provider' => $provider,
        //     'provider_id' => $providerAccount->getId()
        // ])->first();

        // if(!$socialAccount){

        //     $user->social_accounts()->create(
        //         $this->neededData($provider, $providerAccount)
        //     );
        // } else {

        //     $socialAccount->update(
        //         $this->neededData($provider, $providerAccount)
        //     );
        // }

        return  $this->authenticate($request, $user, $provider);
    }

    /**
     *  Get social media account informations.
     *
     * @param $providerAccount
     * @return array
     */
    protected function neededData($provider, $providerAccount)
    {
        return [
            "provider" => $provider,
            "provider_id" => $providerAccount->getId(),
            "token" => $providerAccount->token,
            "token_secret" => $provider == 'twitter' ? $providerAccount->tokenSecret : null,
            "refresh_token" => $provider != 'twitter' ? $providerAccount->refreshToken : null,
            "expires_in" => $provider != 'twitter' ? $providerAccount->expiresIn : null,
            "name" => $providerAccount->getName(),
            "nickname" => $providerAccount->getNickname(),
            "email" => $providerAccount->getEmail(),
            "avatar" => $providerAccount->getAvatar(),
            "content" => json_encode($providerAccount)
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
