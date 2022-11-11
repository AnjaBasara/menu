<?php

namespace App\Services;

use App\Repositories\CurrencyRepository;
use Illuminate\Database\Eloquent\Collection;

class CurrencyService
{

    private CurrencyRepository $currencyRepository;

    public function __construct(CurrencyRepository $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    public function getCurrencies(): Collection
    {
        return $this->currencyRepository->getCurrencies();
    }

    public function calculate(string $currencyID, string $amount): float
    {
        // TODO: cache
        $currency = $this->currencyRepository->getCurrency($currencyID);

        $price = (1 / $currency->exchange_rate) * $amount * (1 - $currency->surcharge);

        if ($currency->discount) {
            $price = $price * $currency->discount;
        }

        return number_format($price, 2);
    }
}
