<?php

namespace App\Http\Controllers;

use App\Services\CurrencyService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use TypeError;

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
            'currencies' => Cache::remember('currencies', config('ttl.currency'), function () {
                return $this->currencyService->getCurrencies();
            }),
        ]);
    }

    public function calculate(Request $request): JsonResponse
    {
        try {
            return response()->json([
                'price' => $this->currencyService->calculate($request->currency, $request->amount),
            ], 200);
        } catch (TypeError) {
            return response()->json([
                'error' => 'Amount must be a number!',
            ], 400);
        } catch (Exception) {
            return response()->json([
                'error' => 'An error occurred while calculating price!',
            ], 500);
        }
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
