<?php

namespace App\Jobs\Logs;

use App\Actions\Logs\LogAuthAction;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class LogAuthJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly ?string $ip,
        private readonly ?User $user,
        private readonly ?string $latitude,
        private readonly ?string $longitude,
        private readonly ?string $batteryLevel,
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        (new LogAuthAction)
            ->setIp($this->ip)
            ->setUser($this->user)
            ->setLatitude($this->latitude)
            ->setLongitude($this->longitude)
            ->setBatteryLevel($this->batteryLevel)
            ->handle();
    }
}
