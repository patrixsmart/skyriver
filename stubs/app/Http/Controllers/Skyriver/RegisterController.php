<?php

namespace App\Http\Controllers\Skyriver;

use App\Models\User;
use Illuminate\Support\Str;
use Patrixsmart\Skyriver\RegistersUsers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Patrixsmart\Skyriver\PasswordValidationRules;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers, PasswordValidationRules;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [

            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(), //['required', 'string', 'min:8', 'confirmed'],
            'profession' => ['required','max:40'],
            'state' => ['required','string'],
            'town' => ['required','string'],
            'phone_number' => ['required','max:15', 'min:8']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'username' => Str::slug($data['name'],'-').'-'.Str::random(5),
            'profession' => $data['profession'],
            'state' => $data['state'],
            'town' => $data['town'],
            'phone_number' => $data['phone_number']
        ]);
    }
}
