<?php

namespace App\Actions\Notification;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class DeleteByIdNotifyAction
{

    public function handle(?int $id): void
    {
        Notification::where('user_id', Auth::user()->id)
            ->where('id', $id)
            ->delete();
    }
}
