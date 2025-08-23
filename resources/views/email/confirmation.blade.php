<div style="font-family: 'Segoe UI', Arial, sans-serif; background: #f8fafc; padding: 40px 0;">
    <div
        style="max-width: 480px; margin: 0 auto; background: #fff; border-radius: 12px; box-shadow: 0 2px 12px #0001; padding: 32px;">
        <div style="text-align: center; margin-bottom: 24px;">
            <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png" alt="Order Confirmed" width="64"
                style="margin-bottom: 12px;">
            <h2 style="color: #14b8a6; font-size: 1.7rem; margin: 0;">Order Confirmation</h2>
        </div>
        <p style="font-size: 1.1rem; color: #334155; margin-bottom: 18px;">
            Hi <strong>{{ $mailData['customer_name'] }}</strong>,
        </p>
        <p style="color: #475569; margin-bottom: 18px;">
            Thank you for your order! We have received your order and are processing it now.
        </p>
        <table style="width: 100%; margin-bottom: 24px;">
            <tr>
                <td style="color: #64748b; padding: 6px 0;">Order ID:</td>
                <td style="text-align: right; color: #0f172a; font-weight: 500;">{{ $mailData['order_id'] }}</td>
            </tr>
            <tr>
                <td style="color: #64748b; padding: 6px 0;">Order Date:</td>
                <td style="text-align: right; color: #0f172a;">{{ $mailData['order_date'] }}</td>
            </tr>
            <tr>
                <td style="color: #64748b; padding: 6px 0;">Customer Name:</td>
                <td style="text-align: right; color: #0f172a;">{{ $mailData['customer_name'] }}</td>
            </tr>
            <tr>
                <td style="color: #64748b; padding: 6px 0;">Order Total:</td>
                <td style="text-align: right; color: #14b8a6; font-weight: 600;">
                    ${{ number_format($mailData['order_total'], 2) }}</td>
            </tr>
        </table>
        <div style="text-align: center; margin-bottom: 18px;">
            <a href="{{ url('/') }}"
                style="display: inline-block; background: #14b8a6; color: #fff; text-decoration: none; padding: 12px 32px; border-radius: 6px; font-weight: 600; font-size: 1rem;">
                View Your Order
            </a>
        </div>
        <p style="color: #64748b; font-size: 0.97rem; text-align: center;">
            If you have any questions, just reply to this email. We're always happy to help!
        </p>
        <p style="color: #94a3b8; font-size: 0.9rem; text-align: center; margin-top: 24px;">
            &copy; {{ date('Y') }} Your Company. All rights reserved.
        </p>
    </div>
</div>
