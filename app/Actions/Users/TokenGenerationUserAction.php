<?php

namespace App\Actions\Users;

use App\Models\User;

class TokenGenerationUserAction
{
    private string $tokenName = '';
    private bool $deleteToken = false;
    private User $user;

    public function __construct()
    {
        $this->tokenName = env("APP_NAME", 'Laravel');
    }

    public function setTokenName(string $value): self
    {
        $this->tokenName = $value;
        return $this;
    }
    public function setDeleteToken(bool $value): self
    {
        $this->deleteToken = $value;
        return $this;
    }
    public function setUser(User $value): self
    {
        $this->user = $value;
        return $this;
    }

    public function handle(): string
    {
        if ($this->deleteToken) $this->user->tokens()->delete();

        return $this->user->createToken($this->tokenName)->plainTextToken;
    }
}
