<?php

namespace App\Listeners;

use App\Event\UserCreated;
use App\Models\Users;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmail
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
     * @param  \App\Event\UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $objUsers = new Users();
        $Users = $objUsers->send_user_login_mail($event->first_name,$event->last_name,$event->email,$event->random_pwd);
    }
}
