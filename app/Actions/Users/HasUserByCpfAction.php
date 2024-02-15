<?php

namespace App\Actions\Users;

use App\Models\User;

class HasUserByCpfAction
{
    public function handle(?string $cpf = ''): null | User
    {
        return User::where('cpf', $cpf)
            ->first();
    }
}
