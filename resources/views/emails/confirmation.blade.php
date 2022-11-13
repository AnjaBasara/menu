<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order Confirmation</title>
</head>
<body>
<div class="d-flex justify-content-center">
    <p>Greetings,</p>
    <p>This is a confirmation email for order #{{ $order->id }}.</p>
    <hr>

    <p>Foreign currency purchased: <b>{{ $order->currency->code }}</b></p>
    <p>Exchange rate for foreign currency: {{ $order->exchange_rate }}</p>
    <p>Surcharge percentage: {{ $order->surcharge_percentage * 100 }}%</p>
    <p>Amount of surcharge: {{ $order->surcharge_amount }} USD</p>
    <p>Amount of foreign currency purchased: <b>{{ $order->amount_purchased }} {{$order->currency->code}}</b></p>
    <hr>

    <p>Amount paid in USD: <b>{{ $order->amount_paid }} USD</b></p>
    <p>Discount percentage: {{ $order->discount_percentage ?: 0 }}%</p>
    <p>Discount amount: {{ $order->discount_amount ?:0 }} USD</p>

    <hr>
    <p>Date created: {{ date('d/m/y H:i', strtotime($order->created_at)) }}</p>
</div>
</body>
</html>
