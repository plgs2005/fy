<?php

namespace App\Influencer\Payout;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Payout extends Model
{
    protected $table = 'payouts';

    protected $fillable = [
        'user_id',
        'stripe_payout_id',
        'balance',
        'amount',
        'stripe_created',
        'stripe_arrival_date',
    ];

    
}
