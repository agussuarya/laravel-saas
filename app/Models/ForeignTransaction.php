<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForeignTransaction extends Model
{

    const TYPE_VOLUME = 'volume';
    const TYPE_VALUE = 'value';

    protected $dates = [
        'transaction_date',
    ];

    protected $fillable = [
        'transaction_date',
        'stock_code',
        'last_price',
        'change_value',
        'change_percentage',
        'grid_fluctuation_ratio',
        'frequency',
        'volume',
        'value',
        'type',
        'foreign_buy',
        'foreign_sell',
        'net_buy',
        'net_sell',
    ];
}
