<?php

namespace App\Actions\Users;

use App\Models\User;

class FindUserByCpfAction
{

    private string $cpf = '';

    public function setCpf(string $value): self
    {
        $this->cpf = $value;
        return $this;
    }

    public function handle(): ?User
    {
        return User::where('cpf', $this->cpf)->first();
    }
}
