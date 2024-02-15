<?php

namespace App\Jobs\Backup;

use App\Actions\Notification\RegisterNotificationAction;
use App\Models\User;
use App\Notifications\SendMessageAdmNotify;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use PhpParser\Node\Stmt\TryCatch;

class CreateBackupJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly ?User $User,
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Artisan::call('backup:run');

        (new RegisterNotificationAction)
            ->setUser($this->User)
            ->setIcon('CircleStackIcon')
            ->setIconBackground('bg-blue-500')
            ->setTitle('A rotina de backup foi executada, verifique no seu email o status desse backup')
            ->handle();
    }
}
