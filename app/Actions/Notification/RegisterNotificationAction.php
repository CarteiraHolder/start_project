<?php

namespace App\Actions\Notification;

use App\Events\RegisterNotificationEvent;
use App\Models\Notification;
use App\Models\User;

class RegisterNotificationAction
{
    private ?User $user = null;
    private ?string $icon = 'ChatBubbleBottomCenterTextIcon';
    private ?string $iconBackground = 'bg-primary';
    private ?string $title = null;
    private ?string $label = null;


    public function setUser(?User $value): self
    {
        $this->user = $value;
        return $this;
    }

    public function setIcon(?string $value): self
    {
        $this->icon = $value;
        return $this;
    }

    public function setIconBackground(?string $value): self
    {
        $this->iconBackground = $value;
        return $this;
    }

    public function setTitle(?string $value): self
    {
        $this->title = $value;
        return $this;
    }

    public function setLabel(?string $value): self
    {
        $this->label = $value;
        return $this;
    }

    public function handle(): Notification
    {
        RegisterNotificationEvent::dispatch($this->user);

        $Notification = new Notification();
        $Notification->user_id = $this->user->id;
        $Notification->icon = $this->icon;
        $Notification->icon_background = $this->iconBackground;
        $Notification->title = $this->title;
        $Notification->label = $this->label;
        $Notification->save();

        return $Notification;
    }
}
