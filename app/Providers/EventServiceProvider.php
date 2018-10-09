<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\TransactionStarted' => [
        'App\Listeners\NotifyMerchantOfTransactionStarted',
        'App\Listeners\SendStartTransactionNotification',
        'App\Listeners\BroadcastTransactionStared',
        ],
        'App\Events\ConfirmedTransaction' => [
        'App\Listeners\NotifyBuyerOfConfirmedTransaction',
        'App\Listeners\SendConfirmTransactionNotification',
        'App\Listeners\BroadcastTransactionConfirmed',
        ],
         'App\Events\AcceptedRefund' => [
        'App\Listeners\SendAcceptRefundNotification',
        'App\Listeners\NotifyBuyerOfRefundAccepted',
        'App\Listeners\BroadcastRefundAccepted',
        ],
        'App\Events\AcceptedRefund' => [
        'App\Listeners\SendRejectRefundNotification',
        'App\Listeners\NotifyBuyerOfRefundRejected',
        'App\Listeners\BroadcastRefundRejected',
        ],
        'App\Events\ReleasedPayment' => [
        'App\Listeners\SendReleasedPaymentNotification',
        'App\Listeners\NotifyMerchantOfPaymentReleased',
        'App\Listeners\BroadcastPaymentReleased',
        ],
        'App\Events\StoppedPayment' => [
        'App\Listeners\SendWelcomeNotification',
        'App\Listeners\NotifyMerchantOfStoppedPayment',
        'App\Listeners\BroadcastPaymentStopped',
        ],
         'App\Events\TransactionLinkCreated' => [
        'App\Listeners\SendCreateTransactionLinkNotification',
        'App\Listeners\NotifyBuyerOfTransactionLinkCreated',
        'App\Listeners\BroadcastTransactionLinkCreated',
        ],
        'App\Events\MakePayment' => [
        'App\Listeners\SendPaymentNotification',
        'App\Listeners\NotifyMerchantOfPaymentMade',
        'App\Listeners\BroadcastPaymentMade',
        ],
        'App\Events\UpdatedProfile' => [
        'App\Listeners\SendProfileUpdatedNotification',
        'App\Listeners\BroadcastProfileUpdated',
        ],
        'App\Events\Registered' => [
        'App\Listeners\SendRegistrationNotification',
        'App\Listeners\BroadcastUserRegistered',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
