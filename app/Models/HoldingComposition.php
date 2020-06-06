<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HoldingComposition extends Model
{

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
        'local_is',
        'local_cp',
        'local_pf',
        'local_ib',
        'local_id',
        'local_mf',
        'local_sc',
        'local_fd',
        'local_ot',
        'local_total',
        'foreign_is',
        'foreign_cp',
        'foreign_pf',
        'foreign_ib',
        'foreign_id',
        'foreign_mf',
        'foreign_sc',
        'foreign_fd',
        'foreign_ot',
        'foreign_total',
    ];
}
