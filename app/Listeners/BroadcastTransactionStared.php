<?php

namespace App\Listeners;

use App\Events\TransactionStarted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BroadcastTransactionStared
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
     * @param  TransactionStarted  $event
     * @return void
     */
    public function handle(TransactionStarted $event)
    {
        //
    }
}
