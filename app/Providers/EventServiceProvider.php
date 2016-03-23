<?php

namespace App\Providers;

use App\Events\GrantPointsEvent;
use App\Events\LevelUpEvent;
use App\Listeners\GrantPointsListener;
use App\Listeners\LevelUpListener;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        
        GrantPointsEvent::class => [
            GrantPointsListener::class,
        ],

        LevelUpEvent::class => [
            LevelUpListener::class,
        ],

    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
