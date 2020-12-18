<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use App\Models\Skyriver\Passport\Token;
use Illuminate\Support\ServiceProvider;
use App\Models\Skyriver\Passport\Client;
use App\Models\Skyriver\Passport\AuthCode;
use App\Models\Skyriver\Passport\PersonalAccessClient;

class SkyriverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Passport::routes();

        // Passport::hashClientSecrets();

        Passport::enableImplicitGrant();

        // Passport::loadKeysFrom('/secret-keys/oauth');

        Passport::personalAccessTokensExpireIn(now()->addMonths(6));

        Passport::refreshTokensExpireIn(now()->addYear());

        Passport::tokensExpireIn(now()->addMonths(6));

        Passport::useTokenModel(Token::class);

        Passport::useClientModel(Client::class);

        Passport::useAuthCodeModel(AuthCode::class);

        Passport::usePersonalAccessClientModel(PersonalAccessClient::class);

        Passport::tokensCan(config('skyriver.passport.tokens_can'));

        Passport::setDefaultScope(config('skyriver.passport.default_scope'));

        Passport::cookie(config('skyriver.passport.cookie_name'));
    }
}
