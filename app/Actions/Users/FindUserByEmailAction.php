<?php

namespace App\Actions\Users;

use App\Models\User;

class FindUserByEmailAction
{

    private string $email = '';

    public function setEmail(string $value): self
    {
        $this->email = $value;
        return $this;
    }

    public function handle(): ?User
    {
        return User::where('email', $this->email)->first();
    }
}
