<?php

namespace App\Services;

use App\Events\EurOrderCreated;
use App\Events\GbpOrderCreated;
use App\Models\Currency;
use App\Repositories\CurrencyRepository;
use App\Repositories\OrderRepository;
use Illuminate\Database\Eloquent\Collection;

class CurrencyService
{

    private CurrencyRepository $currencyRepository;
    private OrderRepository $orderRepository;

    public function __construct(CurrencyRepository $currencyRepository, OrderRepository $orderRepository)
    {
        $this->currencyRepository = $currencyRepository;
        $this->orderRepository = $orderRepository;
    }

    public function getCurrencies(): Collection
    {
        return $this->currencyRepository->getCurrencies();
    }

    public function calculate(string $currencyID, string $amount): float
    {
        $currency = $this->currencyRepository->getCurrency($currencyID);

        return round((1 / $currency->exchange_rate) * $amount * (1 + $currency->surcharge), 2);
    }

    public function purchase(string $currencyID, string $amount): bool
    {
        $currency = $this->currencyRepository->getCurrency($currencyID);
        $price = $this->calculate($currencyID, $amount);

        $order = $this->orderRepository->create($currency, $amount, $price);

        if (!$order) {
            return false;
        }

        switch ($currency->code) {
            case Currency::GBP:
                GbpOrderCreated::dispatch($order);
                break;
            case Currency::EUR:
                EurOrderCreated::dispatch($order);
                break;
        }

        return true;
    }
}
