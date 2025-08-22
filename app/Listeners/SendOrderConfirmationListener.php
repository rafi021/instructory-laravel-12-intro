<?php

namespace App\Listeners;

use App\Events\OrderPlacedEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOrderConfirmationListener
{

    public function handle(OrderPlacedEvent $event): void
    {
        Log::error('Order confirmation email sent for order ID: ' . $event->order->id);
    }
}
