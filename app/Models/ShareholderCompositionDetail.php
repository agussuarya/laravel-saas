<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShareholderCompositionDetail extends Model
{
    //
    const INVESTOR_STATUS_DOMESTIC = 'Domestic';
    const INVESTOR_STATUS_FOREIGN = 'Foreign';
    const INVESTOR_STATUS_CONTROLLER = 'Controller';

    const INVESTOR_TYPE_IS = 'Insurance IS';
    const INVESTOR_TYPE_CP = 'Company CP';
    const INVESTOR_TYPE_PF = 'Pension Fund PF';
    const INVESTOR_TYPE_IB = 'Bank IB';
    const INVESTOR_TYPE_ID = 'Individual ID';
    const INVESTOR_TYPE_MF = 'Mutual Fund MF';
    const INVESTOR_TYPE_SC = 'Securities Company SC';
    const INVESTOR_TYPE_FD = 'Foundation FD';
    const INVESTOR_TYPE_OT = 'Other OT';
    const INVESTOR_TYPE_CONTROLLER = 'Controller';

    protected $fillable = [
        'shareholder_composition_id',
        'investor_status',
        'investor_type',
        'number_of_shares',
    ];
}
