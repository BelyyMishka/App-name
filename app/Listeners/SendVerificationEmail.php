<?php

namespace App\Listeners;

use App\Events\Registered;
use App\Mail\VerifyUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendVerificationEmail
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
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $userVerify = $event->userVerify;
        $email = $userVerify->user->email;

        Mail::to($email)->send(new VerifyUser($userVerify));
    }
}
