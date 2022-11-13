<?php

namespace App\Repositories;

use App\Models\Currency;
use App\Models\Order;

class OrderRepository
{
    public function create(Currency $currency, float $amount, float $price): ?Order
    {
        $order = new Order();
        $order->currency_code = $currency->code;
        $order->exchange_rate = $currency->exchange_rate;
        $order->surcharge_percentage = $currency->surcharge;
        $order->surcharge_amount = $currency->surcharge * $amount;
        $order->amount_purchased = $amount;
        $order->amount_paid = $price;

        if ($order->save()) {
            return $order;
        } else {
            return null;
        }
    }

    public function update(Order $order): bool
    {
        return $order->save();
    }
}
