<?php

namespace App\Console\Commands;

use App\Repositories\CurrencyRepository;
use App\Services\CurrencyLayerApiService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use PDOException;

class UpdateExchangeRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exchange:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for updating exchange rates in the database';

    private CurrencyLayerApiService $apiService;
    private CurrencyRepository $currencyRepository;

    const SUCCESS_MESSAGE = 'Successfully updated exchange rates.';
    const PDO_ERROR = 'An error occurred while updating currencies in the database!';
    const API_ERROR = 'An error occurred while fetching the new exchange rates!';

    public function __construct(CurrencyLayerApiService $apiService, CurrencyRepository $currencyRepository)
    {
        parent::__construct();
        $this->apiService = $apiService;
        $this->currencyRepository = $currencyRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $currencies = $this->apiService->getCurrencyRates();

        if ($currencies->successful() && $currencies->json('success')) {
            try {
                DB::beginTransaction();

                foreach ($currencies->json('quotes') as $key => $quote) {
                    $currency = $this->currencyRepository->getCurrency(substr($key, 3));
                    $currency->exchange_rate = $quote;
                    $this->currencyRepository->update($currency);
                }

                DB::commit();
            } catch (PDOException $e) {
                DB::rollBack();
                $this->error(self::PDO_ERROR);
                return Command::FAILURE;
            }

            $this->info(self::SUCCESS_MESSAGE);
            return Command::SUCCESS;
        } else {
            $this->error(self::API_ERROR);
            return Command::FAILURE;
        }
    }
}
