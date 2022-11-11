<?php

namespace App\Repositories;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Collection;

class CurrencyRepository
{
    public function getCurrencies(): Collection
    {
        return Currency::all();
    }

    public function getCurrency(string $id): Currency
    {
        return Currency::find($id);
    }
}
