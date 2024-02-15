<?php

namespace App\Actions\Users;

use App\Enums\RoleEnum;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdateUserAction
{
    private ?int $id = null;
    private ?string $name = null;
    private ?string $cpf = null;
    private ?string $email = null;
    private ?string $role = null;

    public function setId(?int $value): self
    {
        $this->id = $value;
        return $this;
    }
    public function setName(?string $value): self
    {
        $this->name = $value;
        return $this;
    }
    public function setCpf(?string $value): self
    {
        $this->cpf = $value;
        return $this;
    }
    public function setEmail(?string $value): self
    {
        $this->email = $value;
        return $this;
    }
    public function setRole(?string $value): self
    {
        $this->role = $value;
        return $this;
    }

    public function handle(): User
    {
        return DB::transaction(
            function () {
                $User = User::where('id', $this->id)
                    ->firstOrFail();

                $User->name = $this->name;
                $User->cpf = $this->cpf;
                $User->email = $this->email;

                $User->saveOrFail();

                $Role = Role::where('user_id', $User->id)
                    ->firstOrFail();

                $Role->user_id = $User->id;
                $Role->role = $this->role;

                $Role->saveOrFail();

                return $User;
            }
        );
    }
}
