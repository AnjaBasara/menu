<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $code;
 * @property string $description;
 * @property float $exchange_rate;
 * @property float $surcharge;
 * @property float $discount;
 */
class Currency extends Model
{
    use HasFactory;

    protected $primaryKey = 'code';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    const GBP = 'GBP';
    const JPY = 'JPY';
    const EUR = 'EUR';

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
