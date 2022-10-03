<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Events\NewCampaign;
use App\Events\NotifyUser;

use App\Listeners\ChooseInfluencer;
use App\Listeners\VerifyEmailListener;
use App\Listeners\NotifyUserListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            //SendEmailVerificationNotification::class,
            VerifyEmailListener::class,
        ],
        NewCampaign::class => [
            ChooseInfluencer::class,
        ],
        NotifyUser::class => [
            NotifyUserListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
