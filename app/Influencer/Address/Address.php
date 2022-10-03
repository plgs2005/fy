<?php

namespace App\Influencer\Address;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id', 'address', 'number', 'city', 'state', 'postal_code', 'country', 'po_box', 'apartment', 'apartment_unit', 'formatted_address', 'lat', 'lng'
    ];

    public function user()
    {
        return $this->belongsTo('App\Influencer\User\User');
    }
}
