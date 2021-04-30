<?php

namespace App\Providers;

use App\Events\DoctorCreatedEvent;
use App\Events\PatientEmailVerificationEvent;
use App\Events\PostCreated;
use App\Listeners\DoctorCreatedListener;
use App\Listeners\PatientEmailVerificationListener;
use App\Listeners\PostCreated as ListenersPostCreated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        DoctorCreatedEvent::class =>[
            DoctorCreatedListener::class,
        ],
        PatientEmailVerificationEvent::class => [
            PatientEmailVerificationListener::class
        ],
        PostCreated::class => [
            ListenersPostCreated::class
        ]
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
}
