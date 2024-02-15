<?php

namespace App\Actions\Users;

use App\Models\User;

class ChangeStatusUserAction
{
    private ?string $id = null;

    public function  setId(?string $value): self
    {
        $this->id = $value;
        return $this;
    }

    public function handle(): User
    {
        $User = User::where('id', $this->id)
            ->first();

        $User->active = !$User->active;
        $User->save();
        return $User;
    }
}
