<?php

namespace App\Actions\Logs;

use App\Models\LogUserAction as ModelsLogUserAction;


class LogUserAction
{
    private ?string $event = null;
    private ?string $table = null;
    private mixed $oldData = null;
    private mixed $newData = null;
    private ?int $registerId = null;
    private ?int $userId = null;

    public function  setEvent(?string $value): self
    {
        $this->event = $value;
        return $this;
    }
    public function  setTable(?string $value): self
    {
        $this->table = $value;
        return $this;
    }
    public function  setOldData(mixed $value): self
    {
        $this->oldData = $value;
        return $this;
    }
    public function  setNewData(mixed $value): self
    {
        $this->newData = $value;
        return $this;
    }
    public function  setRegisterId(?int $value): self
    {
        $this->registerId = $value;
        return $this;
    }
    public function  setUserId(?int $value): self
    {
        $this->userId = $value;
        return $this;
    }

    public function handle(): ModelsLogUserAction
    {
        return ModelsLogUserAction::create([
            'event' => $this->event,
            'table' => $this->table,
            'old_data' => $this->oldData,
            'new_data' => $this->newData,
            'register_id' => $this->registerId,
            'user_id' => $this->userId,
        ]);
    }
}
