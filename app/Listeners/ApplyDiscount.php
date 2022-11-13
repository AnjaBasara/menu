<?php

namespace App\Listeners;

use App\Events\EurOrderCreated;
use App\Repositories\OrderRepository;

class ApplyDiscount
{
    private OrderRepository $orderRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Handle the event.
     *
     * @param EurOrderCreated $event
     * @return void
     */
    public function handle(EurOrderCreated $event)
    {
        $order = $event->order;
        $total = $order->amount_paid;

        $order->amount_paid = $total * (1 - $order->currency->discount);
        $order->discount_percentage = $order->currency->discount;
        $order->discount_amount = $total - $order->amount_paid;

        if ($this->orderRepository->update($order)) {
            session()->flash('discount_applied', 'Successfully applied discount');
        } else {
            back()->withErrors(['discount_error' => 'An error occurred while applying discount!']);
        }
    }
}
