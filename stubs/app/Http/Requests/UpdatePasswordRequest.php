<?php

namespace App\Http\Requests\Skyriver;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;
use Patrixsmart\Skyriver\PasswordValidationRules;

class UpdatePasswordRequest extends FormRequest
{
    use PasswordValidationRules;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'current_password' => ['required', 'string'],
            'password' => $this->passwordRules(),
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            if (! Hash::check($this->input('current_password'), $this->user()->password)) {

                $validator->errors()->add(
                    'current_password',
                     __('The provided password does not match your current password.')
                );
            }
        });
    }
}
