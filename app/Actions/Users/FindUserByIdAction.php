<?php

namespace App\Actions\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FindUserByIdAction
{
    use \App\Actions\Users\Trait\WhereContractorTrait;

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
            ->with('flag')
            ->with('industry')
            ->with('contractor')
            ->when(fn ($query) => $this->whereContractor($query))
            ->first();
    }
}
