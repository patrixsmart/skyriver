<?php

namespace App\Http\Controllers\Skyriver\Passport;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\Skyriver\Passport\ClientToken;

class ClientTokenController extends Controller
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
        return ClientToken::handle(
            $request,
            $request->client_id, // CLIENT_ID,
            $request->client_secret // CLIENT_SECRET
        );
    }
}
