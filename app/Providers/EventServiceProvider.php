<?php

namespace App\Providers;

use App\Events\ChangeEmail;
use App\Events\ForgotPassword;
use App\Events\Registered;
use App\Listeners\SendCodeEmail;
use App\Listeners\SendNewPasswordEmail;
use App\Listeners\SendVerificationEmail;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendVerificationEmail::class,
        ],
        ForgotPassword::class => [
          SendNewPasswordEmail::class,
        ],
        ChangeEmail::class => [
            SendCodeEmail::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
