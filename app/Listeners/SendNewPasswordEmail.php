<?php

namespace App\Listeners;

use App\Events\ForgotPassword;
use App\Mail\NewPassword;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNewPasswordEmail
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
     * @param  ForgotPassword  $event
     * @return void
     */
    public function handle(ForgotPassword $event)
    {
        $passwordReset = $event->passwordReset;

        Mail::to($passwordReset->email)->send(new NewPassword($passwordReset));
    }
}
