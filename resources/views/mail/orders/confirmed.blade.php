<x-mail::message>
    # Order Confirmation

    Hello **{{ $mailData['customer_name'] }}**,

    Thank you for your order! We have received your order and are processing it now.

    ---

    **Order Details:**

    - **Order ID:** {{ $mailData['order_id'] }}
    - **Order Date:** {{ $mailData['order_date'] }}
    - **Order Total:** ${{ number_format($mailData['order_total'], 2) }}

    <x-mail::button :url="url('/')">
        View Order
    </x-mail::button>

    If you have any questions, just reply to this email. We're always happy to help!

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
