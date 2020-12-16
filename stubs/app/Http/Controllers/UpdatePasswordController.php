<?php

namespace App\Http\Controllers\Skyriver;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Skyriver\UpdatePasswordRequest;

class UpdatePasswordController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $request->bearerToken()?
        $this->middleware('auth:api'):
        $this->middleware('auth');
    }

    /**
     * Display the update password view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return view('auth.update-password');
    }

    /**
     * Handle an incoming update password request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(UpdatePasswordRequest $request)
    {
        $request->user()->forceFill([
            'password' => Hash::make($request->input('password')),
        ])->save();

        return $request->user()->fresh();
    }
}
