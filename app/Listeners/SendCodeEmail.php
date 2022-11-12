<?php

namespace App\Listeners;

use App\Events\ChangeEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendCodeEmail
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
     * @param  ChangeEmail  $event
     * @return void
     */
    public function handle(ChangeEmail $event)
    {
        $user = $event->user;
        $token = $event->token;

        Mail::to($user->email)->send(new \App\Mail\ChangeEmail($user, $token));
    }
}
