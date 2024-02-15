<?php

namespace App\Actions\Users;

use App\Models\User;

class FindUserByIdAction
{
    private int $id = 0;

    public function setID(int $value): self
    {
        $this->id = $value;
        return $this;
    }

    public function handle(): ?User
    {
        return User::where('id', $this->id)
            ->with('role')
            ->first();
    }
}
