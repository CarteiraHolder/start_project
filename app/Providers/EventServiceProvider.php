<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Contractor;
use App\Models\Flag;
use App\Models\Industry;
use App\Models\Pdv;
use App\Models\Sku;
use App\Models\User;
use App\Observers\BrandObserver;
use App\Observers\ContractorObserver;
use App\Observers\FlagObserver;
use App\Observers\IndustryObserver;
use App\Observers\PdvObserver;
use App\Observers\SkuObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        // LoginEvent::class => [
        //     LogUserAccessListener::class
        // ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
