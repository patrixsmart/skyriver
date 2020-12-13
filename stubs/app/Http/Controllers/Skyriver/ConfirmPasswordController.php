<?php

namespace App\Http\Controllers\Skyriver;

use Illuminate\Http\Request;
use Patrixsmart\Skyriver\ConfirmsPasswords;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password confirmations and
    | uses a simple trait to include the behavior. You're free to explore
    | this trait and override any functions that require customization.
    |
    */

    use ConfirmsPasswords;

    /**
     * Where to redirect users when the intended url fails.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $request->wantsJson()
            ? $this->middleware('auth:api')
            : $this->middleware('auth');
    }
}
