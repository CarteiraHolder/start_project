<?php

namespace App\Observers;

use App\Jobs\Logs\LogUserActionJob;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserObserver
{
    /**
     * Handle the User "retrieved" event.
     */
    public function retrieved(User $user): void
    {
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        LogUserActionJob::dispatch(
            event: 'create',
            table: 'users',
            oldData: null,
            newData: $user,
            registerId: $user->id,
            userId: Auth::user()->id ?? $user->id,
        );
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        LogUserActionJob::dispatch(
            event: 'update',
            table: 'users',
            oldData: $user->getRawOriginal(),
            newData: $user,
            registerId: $user->id,
            userId: Auth::user()->id ?? $user->id,
        );
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
