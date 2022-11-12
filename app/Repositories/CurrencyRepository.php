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

    public function getCurrency(string $id): Currency
    {
        return Cache::remember($id, 86400, function () use ($id) {
            return Currency::find($id);
        });
    }
}
