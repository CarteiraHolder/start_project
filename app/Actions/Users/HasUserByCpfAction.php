<?php

namespace App\Actions\Users;

use App\Models\User;

class HasUserByCpfAction
{

    use \App\Actions\Users\Trait\WhereContractorTrait;

    public function handle(?string $cpf = ''): null | User
    {
        return User::where('cpf', $cpf)
            ->when(fn ($query) => $this->whereContractor($query))
            ->first();
    }
}
