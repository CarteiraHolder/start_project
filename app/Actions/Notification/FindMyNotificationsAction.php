<?php

namespace App\Actions\Notification;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class FindMyNotificationsAction
{
    private ?bool $hasOpen;

    public function setHasOpen(?bool $value): self
    {
        $this->hasOpen = $value;
        return $this;
    }

    public function handle(): Collection
    {
        return Notification::select(
            'id',
            'icon',
            'icon_background',
            'title',
            'label',
            'has_open',
            'created_at'
        )
            ->where('user_id', Auth::user()->id)
            ->where('created_at', '>', now()->subDays(30)->endOfDay())
            ->when(fn ($query) => $this->whereHasOpen($query))
            ->orderBy('created_at', 'desc')
            ->get();
    }

    protected function whereHasOpen($query)
    {
        return isset($this->hasOpen)
            ? $query->where('has_open', $this->hasOpen)
            : $query;
    }
}
