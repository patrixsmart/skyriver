<?php

namespace Patrixsmart\Skyriver;

use Patrixsmart\Skyriver\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array
     */
    protected function passwordRules()
    {
        return ['required', 'string', new Password, 'confirmed', 'min:8'];
    }
}
