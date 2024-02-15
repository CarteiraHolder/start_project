<?php

namespace App\Jobs\Logs;

use App\Models\LogUserAction;
use App\Models\Settings;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ClearLogUserActionsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $Settings = Settings::query()->firstOrFail();

        $SubDays = Carbon::now()->subDays($Settings->clear_log_user_actions);

        $Logs = LogUserAction::query()->where('created_at', '<', $SubDays)->get();
        $Logs->delete();
    }
}
