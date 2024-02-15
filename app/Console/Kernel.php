<?php

namespace App\Console;

use App\Jobs\ClearCacheJob;
use App\Jobs\Logs\ClearLogUserActionsJob;
use App\Jobs\TesteJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('horizon:snapshot')->everyFiveMinutes();

        $schedule->job(new ClearLogUserActionsJob)->daily()->at('00:30');
        $schedule->job(new ClearCacheJob)->hourly()->at('01:00');
        $schedule->command('backup:run')->daily()->at('01:30');
        // $schedule->command('backup:run')->everyMinute();

        // $schedule->command('inspire')->hourly();
        // $schedule->job(new TesteJob)->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
