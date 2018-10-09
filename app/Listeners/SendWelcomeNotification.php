<?php

namespace App\Listeners;

use App\Events\StoppedPayment;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomeNotification
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
     * @param  StoppedPayment  $event
     * @return void
     */
    public function handle(StoppedPayment $event)
    {
        //
    }
}
