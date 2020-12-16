<?php

namespace App\Actions\Skyriver\Passport;

use App\Models\User;

class PersonalToken
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function handle(User $user, $tokenName,array $tokenScopes = null)
    {
        // Token scopes...
        $tokenScopes = $tokenScopes?:[];

        // Creating a personal token...
        return $user->createToken($tokenName, $tokenScopes);
    }
}
