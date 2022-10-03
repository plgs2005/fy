<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clothing extends Model
{
    protected $fillable = [
        'user_id', 'gender', 'tshirt', 'shoes', 'pants', 'unit', 'dress',
    ];

    public function user()
    {
        return $this->belongsTo('App\Influencer\User\User');
    }
}
