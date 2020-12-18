<?php

namespace App\Traits\Skyriver\Socialite;

use App\Models\Skyriver\Socialite\SocialAccount;

trait HasSocialAccounts
{
    /**
     *
     */
    public function social_accounts()
    {
        return $this->hasMany(SocialAccount::class);
    }
}
