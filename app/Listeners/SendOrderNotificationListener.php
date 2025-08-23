<?php

namespace App\Listeners;

use App\Events\OrderPlacedEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOrderNotificationListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(OrderPlacedEvent $event): void
    {
        Log::info('Order notification sent for order ID: ' . $event->order->id);
    }
}
