<?php

namespace App\Models\Skyriver\Passport;

use Laravel\Passport\Client as PassportClient;

class Client extends PassportClient
{
    /**
     * Determine if the client should skip the authorization prompt.
     *
     * @return bool
     */
    // public function skipsAuthorization()
    // {
    //     return $this->firstParty();
    // }
}
