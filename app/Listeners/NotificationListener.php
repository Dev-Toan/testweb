<?php

namespace App\Listeners;

use App\Events\NotificationEvent;
use App\Models\User;
use App\Notifications\NotificationDatabase;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotificationListener
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
     * @param  NotificationEvent  $event
     * @return void
     */
    public function handle(NotificationEvent $event)
    {
        $user = User::find((int)config('contants.ID_SUPPER_ADMIN_DEFAULT'));
        $user->notify(new NotificationDatabase($event->dataMessage));
    }
}
