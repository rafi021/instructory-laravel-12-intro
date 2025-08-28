<?php

namespace App\Http\Controllers;

use App\Events\OrderPlacedEvent;
use App\Models\Order;
use App\Services\SMSService;
use Illuminate\Http\Request;
use App\Http\Requests\Order\OrderStoreRequest;
use App\Models\Admin;
use App\Models\User;
use App\Notifications\OrderPlacedNotification;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function orderStore(OrderStoreRequest $request)
    {
        // 1. Validate the request data
        // ds($request->all());

        // 2. Order Create
        $order = Order::create([
            'product_id' => $request->validated('product_id'),
            'order_qty' => $request->validated('order_qty'),
            'total_amount' => $request->validated('total_amount'),
            'customer_name' => $request->validated('customer_name'),
            'email' => $request->validated('email'),
            'phone' => $request->validated('phone'),
            'delivery_address' => $request->validated('delivery_address'),
        ]);


        // 2.1 Dispatch OrderPlacedEvent
        OrderPlacedEvent::dispatch($order);

        $admin  = User::first();
        $admin->notify(new OrderPlacedNotification($order));

        // 3. Redirect with success message
        Alert::success('Success', 'Order placed successfully!');
        return redirect()->route('products.index');
    }
}
