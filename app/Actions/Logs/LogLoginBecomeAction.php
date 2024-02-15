<?php

namespace App\Actions\Logs;

use App\Models\LogLoginBecame;
use App\Models\User;

class LogLoginBecomeAction
{
    private ?User $user = null;
    private ?int $userBecomeId = null;

    public function  setUser(?User $value): self
    {
        $this->user = $value;
        return $this;
    }
    public function  setUserBecomeId(?int $value): self
    {
        $this->userBecomeId = $value;
        return $this;
    }

    public function handle(): LogLoginBecame
    {
        return LogLoginBecame::create([
            'user_id' => $this->user->id,
            'user_become_id' => $this->userBecomeId,
        ]);
    }
}
