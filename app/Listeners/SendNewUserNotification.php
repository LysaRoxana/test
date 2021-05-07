<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewUserNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    public function __construct(User $user)
    {
         $this->user = $user;
       
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle()
    {
         $admins = User::whereHas('nom_role', function ($query) {
                $query->where('id', 3);
            })->get();

        Notification::send($admins, new NewUserNotification($event->user))
    }
       
}

