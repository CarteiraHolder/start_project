<?php

namespace App\Actions\Users;

use Illuminate\Support\Facades\Auth;

class AuthUserAction
{

    private ?string $email;
    private ?string $password;

    public function setEmail(string $value): self
    {
        $this->email = $value;
        return $this;
    }
    public function setPassword(string $value): self
    {
        $this->password = $value;
        return $this;
    }

    public function handle(): Bool
    {
        $credentials = [
            'email' => $this->email ?? '',
            'password' => $this->password ?? '',
            // 'active' => true
        ];

        if (!Auth::attempt($credentials)) {
            return false;
        }

        return true;
    }
}
