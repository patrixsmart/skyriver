<?php

namespace App\Http\Controllers\Skyriver\Passport;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\Skyriver\Passport\PasswordToken;

class PasswordTokenController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return PasswordToken::handle(
            $request,
            config('skyriver.passport.password_grant_client.id'),
            config('skyriver.passport.password_grant_client.secret')
        );
    }
}
