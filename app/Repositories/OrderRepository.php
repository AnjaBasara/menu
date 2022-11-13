<?php

namespace App\Repositories;

use App\Models\Currency;
use App\Models\Order;

class OrderRepository
{
    public function create(Currency $currency, float $amount, float $price): ?Order
    {
        $order = new Order();
        $order->currency_id = $currency->id;
        $order->exchange_rate = $currency->exchange_rate;
        $order->surcharge_percentage = $currency->surcharge;
        $order->surcharge_amount = $currency->surcharge * $amount;
        $order->amount_purchased = $amount;
        $order->amount_paid = $price;
        $order->discount_percentage = $currency->discount;
        $order->discount_amount = $currency->discount * $amount;

        if ($order->save()) {
            return $order;
        } else {
            return null;
        }
    }
}
