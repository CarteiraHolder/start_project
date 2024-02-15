<?php

namespace App\Actions\Users;

use App\Models\User;

class LogoutUserAction
{

    public function handle(?User $user = null): void
    {
        $user->tokens()->delete();
    }
}
