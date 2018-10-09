<?php

namespace App\Listeners;

use App\Events\ConfirmedTransaction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendConfirmTransactionNotification
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
     * @param  ConfirmedTransaction  $event
     * @return void
     */
    public function handle(ConfirmedTransaction $event)
    {
        //
    }
}
