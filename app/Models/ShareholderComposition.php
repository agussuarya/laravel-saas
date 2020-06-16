<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShareholderComposition extends Model
{
    //
    const TYPE_EQUITY = 'EQUITY';

    protected $dates = [
        'date',
    ];

    protected $fillable = [
        'date',
        'code',
        'type',
        'number_of_securities',
        'price',
        'domestic_total',
        'foreign_total',
    ];
}
