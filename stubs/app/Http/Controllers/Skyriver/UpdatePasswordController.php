<?php

namespace App\Http\Controllers\Skyriver;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Patrixsmart\Skyriver\PasswordValidationRules;
use Illuminate\Support\Facades\Validator;

class UpdatePasswordController extends Controller
{
    use PasswordValidationRules;

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, User $user = null)
    {
        $user = User::findOrFail(auth()->id());

        Validator::make($request->toArray(), [
            'current_password' => ['required', 'string'],
            'password' => $this->passwordRules(),
        ])->after(function ($validator) use ($user, $request) {

            if (! Hash::check($request->input('current_password'), $user->password)) {

                $validator->errors()->add(
                    'current_password',
                     __('The provided password does not match your current password.')
                );
            }
        })->validate();


        $user->forceFill([
            'password' => Hash::make($request->input('password')),
        ])->save();

        return $user->fresh();
    }
}
