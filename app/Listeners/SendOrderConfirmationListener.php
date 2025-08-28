<?php

namespace App\Listeners;

use App\Mail\OrderConfirmed;
use App\Services\SMSService;
use App\Events\OrderPlacedEvent;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOrderConfirmationListener implements ShouldQueue
{
    use InteractsWithQueue;
    public function handle(OrderPlacedEvent $event): void
    {
        $order = $event->order;
        $mailData = [
            'customer_name' => $order->customer_name,
            'order_id' => $order->id,
            'order_total' => $order->total_amount,
            'order_date' => $order->created_at->format('Y-m-d H:i:s'),
        ];
        Mail::to($order->email)
            ->send(
                new OrderConfirmationMail($mailData)
            );
        Mail::to($order->email)
            ->send(
                new OrderConfirmed($mailData)
            );

        // 2.2 Send SMS Notification
        (new SMSService())->send($order->phone, 'Your order has been placed successfully!');
    }
}
