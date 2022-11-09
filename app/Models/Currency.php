<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id;
 * @property string $code;
 * @property string $description;
 * @property double $exchangeRate;
 * @property double $surcharge;
 * @property double $discount;
 */
class Currency extends Model
{
    use HasFactory;

    public $timestamps = false;
}
