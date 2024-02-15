<?php

namespace App\Actions\Users;

use App\Enums\RoleEnum;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdateUserAction
{
    use \App\Actions\Users\Trait\WhereContractorTrait;

    private ?int $id = null;
    private ?string $name = null;
    private ?string $cpf = null;
    private ?string $email = null;
    private ?string $role = null;
    private ?int $contractor = null;
    private ?int $flag = null;
    private ?int $industry = null;

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
    public function setContractor(?int $value): self
    {
        $this->contractor = isset(Auth::user()->contractor->id)
            ? Auth::user()->contractor->id
            : $value;

        return $this;
    }
    public function setFlag(?int $value): self
    {
        $this->flag = $value;
        return $this;
    }
    public function setIndustry(?int $value): self
    {
        $this->industry = $value;
        return $this;
    }

    public function handle(): User
    {
        return DB::transaction(
            function () {
                $User = User::where('id', $this->id)
                    ->when(fn ($query) => $this->whereContractor($query))
                    ->firstOrFail();

                $User->name = $this->name;
                $User->cpf = $this->cpf;
                $User->email = $this->email;
                $User->contractor_id = $this->contractor;
                $User->flag_id = $this->flag;
                $User->industry_id = $this->industry;

                $User->saveOrFail();

                $Role = Role::where('user_id', $User->id)
                    ->firstOrFail();

                if ($this->role == RoleEnum::admin) {
                    $Role->delete();
                    return $User;
                }

                $Role->user_id = $User->id;
                $Role->role = $this->role;

                $Role->saveOrFail();

                return $User;
            }
        );
    }
}
