<?php

namespace App\Listeners;

use App\Events\ReleasedPayment;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyMerchantOfPaymentReleased
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
     * @param  ReleasedPayment  $event
     * @return void
     */
    public function handle(ReleasedPayment $event)
    {
        //
    }
}
