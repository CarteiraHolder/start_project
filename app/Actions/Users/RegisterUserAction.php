<?php

namespace App\Actions\Users;

use App\Enums\RoleEnum;
use App\Helpers\Random;
use App\Models\Role;
use App\Models\User;
use App\Notifications\RegisterUserNotify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterUserAction
{
    private ?string $name = null;
    private ?string $cpf = null;
    private ?string $email = null;
    private ?string $role = null;
    private ?string $password = null;

    public function __construct()
    {
        $this->password = env('APP_ENV') == 'local'
            ? bcrypt('123123123')
            : bcrypt(Random::quickRandom(32));
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

    public function setPassword(?string $value): self
    {
        $this->password = bcrypt($value);
        return $this;
    }

    public function handle(): User
    {
        return DB::transaction(function () {

            $User = new User();
            $User->name = $this->name;
            $User->cpf = $this->cpf;
            $User->email = $this->email;
            $User->password = $this->password;

            $User->saveOrFail();

            if ($this->role != RoleEnum::admin) {
                $Role = new Role();
                $Role->user_id = $User->id;
                $Role->role = $this->role;

                $Role->saveOrFail();
            }

            $User->notify(new RegisterUserNotify);

            return $User;
        });
    }
}
