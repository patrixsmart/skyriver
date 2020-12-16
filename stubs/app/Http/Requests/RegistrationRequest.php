<?php

namespace App\Http\Requests\Skyriver;

use Illuminate\Foundation\Http\FormRequest;
use Patrixsmart\Skyriver\PasswordValidationRules;

class RegistrationRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(true),

            // 'profession' => ['required','max:40'],
            // 'state' => ['required','string'],
            // 'town' => ['required','string'],
            // 'phone_number' => ['required','max:15', 'min:8']
        ];
    }
}
