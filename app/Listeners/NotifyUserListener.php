<?php

namespace App\Listeners;

use App\Events\NotifyUser;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Notification;

use Illuminate\Support\Facades\Log;

class NotifyUserListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NotifyUser $event)
    {
        
        $notification = new Notification;
        $notification->user_id = $event->user_id;
        $notification->message = $event->message;
        $notification->link_url = $event->link_url;
        $notification->link_description = $event->link_description;
        $notification->image_path = $event->img_path;
        Log::info($notification);
        $notification->save();
    }
}
