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
        return $this->currencyService->calculate($request->currency, $request->amount);
    }

    public function purchase(Request $request)
    {
        if ($this->currencyService->purchase($request->currency, $request->amount)) {
            session()->flash('purchase_success', 'Successfully purchased currency');
            return back();
        } else {
            return back()->withErrors(['purchase_error' => 'An error occurred while purchasing currency!']);
        }
    }
}
