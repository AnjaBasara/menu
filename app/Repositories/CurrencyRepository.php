<?php

namespace App\Repositories;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class CurrencyRepository
{
    public function getCurrencies(): Collection
    {
        // TODO: seconds TTL should configure in env
        return Cache::remember('currencies', 86400, function () {
            return Currency::all();
        });
    }

    public function getCurrency(string $code): Currency
    {
        return Cache::remember($code, 86400, function () use ($code) {
            return Currency::find($code);
        });
    }
}
