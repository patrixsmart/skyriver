<?php

namespace App\Http\Controllers\Skyriver\Passport;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\Skyriver\Passport\PersonalToken;

class PersonalTokenController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // Personal token name
        $tokenName = $request->token_name?: Str::random(10).'@'.time();

        // Personal token scopes
        $tokenScopes = $request->token_scopes?:[];

        return PersonalToken::handle($request->user(), $tokenName, $tokenScopes);
    }
}
