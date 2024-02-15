<?php

namespace App\Actions\Users;

use App\Models\User;

class FindUserByHashAction
{
    private string $md5Id = '';
    private string $md5Email = '';
    private string $md5Password = '';

    public function setHash(string $value): self
    {
        if ($value == '') return $this;
        $base64Decode = base64_decode($value);
        $md5Array = explode('|', $base64Decode);

        if (count($md5Array) != 3) return $this;

        $this->md5Id = $md5Array[0];
        $this->md5Email = $md5Array[1];
        $this->md5Password = $md5Array[2];
        return $this;
    }

    public function handle(): ?User
    {
        $User = User::whereRaw('md5(id) = ?', $this->md5Id)
            ->whereRaw('md5(email) = ?', $this->md5Email)
            ->whereRaw('md5(password) = ?', $this->md5Password)
            ->first();

        return $User;
    }
}
