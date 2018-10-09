<?php

namespace App\Listeners;

use App\Events\MakePayment;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyMerchantOfPaymentMade
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
     * @param  MakePayment  $event
     * @return void
     */
    public function handle(MakePayment $event)
    {
        //
    }
}
