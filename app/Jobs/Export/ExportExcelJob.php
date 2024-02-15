<?php

namespace App\Jobs\Export;

use App\Actions\Notification\RegisterNotificationAction;
use App\Events\RegisterNotificationEvent;
use App\Models\Notification;
use App\Models\User;
use App\Notifications\SendExportFilesNotify;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExportExcelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly mixed $Export,
        private readonly ?User $User,
        private readonly ?string $FileName,
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->User
            ->notify(
                new SendExportFilesNotify(
                    $this->FileName,
                    $this->User->name,
                    $this->Export->Export()
                )
            );


        (new RegisterNotificationAction)
            ->setUser($this->User)
            ->setIcon('InboxArrowDownIcon')
            ->setIconBackground('bg-blue-800')
            ->setTitle("Excel de {$this->FileName} foi gerado com sucesso e enviado para seu e-mail")
            ->handle();
    }
}
