<?php

namespace App\Actions\Users;

use App\Models\User;
use App\Notifications\NewPasswordUserNotify;

class ChangePasswordUserAction
{
    private string $password;
    private bool $notify = false;
    private User $user;

    public function setUser(User $value): self
    {
        $this->user = $value;
        return $this;
    }
    public function setPassword(string $value): self
    {
        $this->password = bcrypt($value);
        return $this;
    }
    public function setNotify(bool $value): self
    {
        $this->notify = $value;
        return $this;
    }

    public function handle(): User
    {
        $this->user->password = $this->password;
        $this->user->email_verified_at = date("Y-m-d H:i:s");
        $this->user->saveOrFail();

        if ($this->notify) $this->user->notify(new NewPasswordUserNotify);

        return $this->user;
    }
}
