<?php

namespace App\Actions\Logs;

use App\Models\LogAccess;
use App\Models\User;

class LogAuthAction
{
    private ?string $ip = null;
    private ?User $user = null;
    private ?string $latitude = null;
    private ?string $longitude = null;
    private ?string $batteryLevel = null;

    public function  setIp(?string $value): self
    {
        $this->ip = $value;
        return $this;
    }
    public function  setUser(?User $value): self
    {
        $this->user = $value;
        return $this;
    }
    public function  setLatitude(?string $value): self
    {
        $this->latitude = $value;
        return $this;
    }
    public function  setLongitude(?string $value): self
    {
        $this->longitude = $value;
        return $this;
    }
    public function  setBatteryLevel(?string $value): self
    {
        $this->batteryLevel = $value;
        return $this;
    }

    public function handle(): LogAccess
    {
        $location = geoip()->getLocation($this->ip)->toArray();

        return LogAccess::create([
            'user_id' => $this->user->id,
            'latitude' => $this->latitude ?? $location['lat'],
            'longitude' => $this->longitude ?? $location['lon'],
            'battery' => $this->batteryLevel ?? 0,
        ]);
    }
}
