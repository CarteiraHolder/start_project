<?php

namespace App\Actions\Users;

use App\Models\User;

class HasUserByEmailAction
{

    public function handle(?string $email = ''): null | User
    {
        return User::where('email', $email)->first();
    }
}
