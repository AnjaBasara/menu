<?php

namespace App\Repositories;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class CurrencyRepository
{
    public function getCurrencies(): Collection
    {
        return Cache::remember('currencies', config('ttl.currency'), function () {
            return Currency::all();
        });
    }

    public function getCurrency(string $code): Currency
    {
        return Cache::remember($code, config('ttl.currency'), function () use ($code) {
            return Currency::find($code);
        });
    }

    public function update(Currency $currency): bool
    {
        return $currency->save();
    }
}
