<?php

namespace App\Jobs\Logs;

use App\Actions\Logs\LogLoginBecomeAction;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class LogLoginBecomeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private readonly User $user, private readonly int $userBecomeId)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        (new LogLoginBecomeAction)
            ->setUser($this->user)
            ->setUserBecomeId($this->userBecomeId)
            ->handle();
    }
}
