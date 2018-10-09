<?php

namespace App\Listeners;

use App\Events\UpdatedProfile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendProfileUpdatedNotification
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
     * @param  UpdatedProfile  $event
     * @return void
     */
    public function handle(UpdatedProfile $event)
    {
        //
    }
}
