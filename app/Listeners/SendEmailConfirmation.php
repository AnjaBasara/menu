<?php

namespace App\Listeners;

use App\Events\GbpOrderCreated;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;

class SendEmailConfirmation
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
     * @param GbpOrderCreated $event
     * @return void
     */
    public function handle(GbpOrderCreated $event)
    {
        $recipients = config('mail.to');

        if (count($recipients) == 0) {
            return;
        }

        // use ->queue instead of ->send to create jobs
        Mail::to($recipients)->send(new OrderConfirmation($event->order));
    }
}
