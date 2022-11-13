<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class CurrencyLayerApiService
{
    public function getCurrencyRates(): Response
    {
        return Http::withOptions([
            'verify' => false,
        ])->withHeaders([
            'apikey' => config('services.currencylayer.key'),
        ])->get(config('services.currencylayer.url'), [
            'source' => 'USD',
            'currencies' => 'JPY,GBP,EUR',
        ]);
    }
}
