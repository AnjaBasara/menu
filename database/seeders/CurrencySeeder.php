<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = json_decode(file_get_contents(storage_path() . '/data/currencies.json'), true);

        foreach ($currencies as $currency) {
            Currency::create([
                'code' => $currency['code'],
                'description' => $currency['description'],
                'exchange_rate' => $currency['exchange_rate'],
                'surcharge' => $currency['surcharge'],
                'discount' => $currency['discount'] ?? null,
            ]);
        }
    }
}
