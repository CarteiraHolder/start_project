<?php

namespace App\Jobs\Logs;

use App\Actions\Logs\LogUserAction as ActionsLogUserAction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class LogUserActionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     * 
     */
    public function __construct(
        private readonly string $event,
        private readonly string $table,
        private readonly mixed $newData,
        private readonly mixed $oldData,
        private readonly ?int $registerId,
        private readonly ?int $userId,
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        (new ActionsLogUserAction)
            ->setEvent($this->event)
            ->setTable($this->table)
            ->setOldData($this->oldData)
            ->setNewData($this->newData)
            ->setRegisterId($this->registerId)
            ->setUserId($this->userId)
            ->handle();
    }
}
