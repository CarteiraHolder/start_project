<?php

namespace App\Actions\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UpdateProfileUserAction
{
    private ?string $name = null;
    private ?string $profilePicture = null;

    public function setName(?string $value): self
    {
        $this->name = $value;
        return $this;
    }
    public function setProfilePicture(?string $value): self
    {
        $this->profilePicture = $value;
        return $this;
    }

    public function handle(): User
    {
        $User = User::query()
            ->where('id', Auth::user()->id)
            ->first();

        if (isset($this->name))
            $User->name = $this->name;

        if (isset($this->profilePicture))
            $User->profile_photo = $this->profilePicture;

        $User->saveOrFail();

        return $User;
    }
}
