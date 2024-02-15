<?php

namespace App\Actions\Setting;

use App\Enums\ApiGeolocationEnum;
use App\Models\Settings;

class UpdateSettingAction
{
    use \App\Actions\Brand\Trait\WhereContractorTrait;

    private ?string $apiGeolocation = null;
    private ?bool $clearAllCache = null;
    private ?int $clearLogUserActions = null;

    public function setApiGeolocation(?string $value): self
    {
        $this->apiGeolocation = $value;
        return $this;
    }
    public function setClearAllCache(?bool $value): self
    {
        $this->clearAllCache = $value;
        return $this;
    }
    public function setClearLogUserActions(?int $value): self
    {
        $this->clearLogUserActions = $value;
        return $this;
    }

    public function handle(): Settings
    {
        $Settings = Settings::first();

        $Settings->api_geolocation = $this->apiGeolocation ?? ApiGeolocationEnum::BrasilApi->value;
        $Settings->clear_log_user_actions = $this->clearLogUserActions ?? 90;
        $Settings->clear_all_cache = $this->clearAllCache ?? false;
        $Settings->save();

        return $Settings;
    }
}
