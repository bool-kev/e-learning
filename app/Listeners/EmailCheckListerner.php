<?php

namespace App\Listeners;

use App\Events\EmailCheckEvent;
use App\Mail\OTPMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EmailCheckListerner
{
    /**
     * Create the event listener.
     */
    public function __construct(private Mailer $mailer)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EmailCheckEvent $event): void
    {
        $token='';
            for($i=0;$i<6;$i++) $token.=rand(0,9);
            $event->user->eleve->update(['token'=>$token]);
            $this->mailer->to($event->user->email)->send(new OTPMail($event->user));
    }
}
