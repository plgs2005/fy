<?php

namespace App\Influencer\Withdrawal;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $fillable = [
        'user_id','payout_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Influencer\User\User');
    }
}
