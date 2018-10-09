<?php

namespace App\Listeners;

use App\Events\AcceptedRefund;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BroadcastRefundRejected
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
     * @param  AcceptedRefund  $event
     * @return void
     */
    public function handle(AcceptedRefund $event)
    {
        //
    }
}
