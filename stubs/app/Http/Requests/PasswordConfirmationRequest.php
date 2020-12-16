<?php

namespace App\Http\Requests\Skyriver;

use Illuminate\Foundation\Http\FormRequest;
use Patrixsmart\Skyriver\PasswordValidationRules;

class PasswordConfirmationRequest extends FormRequest
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
            'password' => $this->passwordRules(),
        ];
    }
}
