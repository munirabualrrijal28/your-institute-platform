<?php

namespace App\Providers;
//  Recommended for future event/listeners

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        // Example:
        // 'App\Events\YourEvent' => [
        //     'App\Listeners\YourListener',
        // ],
    ];

    public function boot(): void
    {
        //
    }
}
