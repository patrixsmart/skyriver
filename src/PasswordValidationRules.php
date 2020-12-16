<?php

namespace Patrixsmart\Skyriver;

use App\Rules\Skyriver\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array
     */
    protected function passwordRules(bool $confirmable = null)
    {
        return [
            'required',
            'string',
            new Password,
            $confirmable ?'confirmed': '',
            'min:8'
        ];
    }
}
