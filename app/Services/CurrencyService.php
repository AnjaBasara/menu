<?php

namespace App\Services;

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

        $price = (1 / $currency->exchange_rate) * $amount * (1 - $currency->surcharge);

        if ($currency->discount) {
            $price = $price * $currency->discount;
        }

        return number_format($price, 2);
    }

    public function purchase(string $currencyID, string $amount): bool
    {
        $currency = $this->currencyRepository->getCurrency($currencyID);
        $price = $this->calculate($currencyID, $amount);

        return $this->orderRepository->create($currency, $amount, $price);
    }
}
