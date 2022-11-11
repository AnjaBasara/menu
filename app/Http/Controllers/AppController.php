<?php

namespace App\Http\Controllers;

use App\Services\CurrencyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class AppController extends Controller
{
    private CurrencyService $currencyService;

    public function __construct(CurrencyService $currencyRepository)
    {
        $this->currencyService = $currencyRepository;
    }

    public function index(): View
    {
        return view('pages.exchange', [
            'currencies' => Cache::remember('currencies', 86400, function () {
                return $this->currencyService->getCurrencies();
            }),
        ]);
    }

    public function calculate(Request $request): float
    {
        return $this->currencyService->calculate($request->currencyID, $request->amount);
    }
}
