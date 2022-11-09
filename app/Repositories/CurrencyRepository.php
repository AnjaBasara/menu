<?php

namespace App\Repositories;

use App\Models\Currency;

class CurrencyRepository
{
    public function getCurrencies()
    {
        return Currency::all();
    }
}
