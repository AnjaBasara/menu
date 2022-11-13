<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id;
 * @property float $exchange_rate;
 * @property float $surcharge_percentage;
 * @property float $surcharge_amount;
 * @property float $amount_purchased;
 * @property float $amount_paid;
 * @property float $discount_percentage;
 * @property float $discount_amount;
 * @property string $currency_code;
 */
class Order extends Model
{
    use HasFactory;

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}
