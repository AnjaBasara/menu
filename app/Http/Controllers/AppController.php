<?php

namespace App\Http\Controllers;

use App\Repositories\CurrencyRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class AppController extends Controller
{
    private CurrencyRepository $currencyRepository;

    public function __construct(CurrencyRepository $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    public function index(): View
    {
        return view('pages.exchange', [
            'currencies' => Cache::remember('currencies', 86400, function () {
                return $this->currencyRepository->getCurrencies();
            }),
        ]);
    }
}
