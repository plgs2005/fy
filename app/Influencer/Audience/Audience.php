<?php

namespace App\Influencer\Audience;

use Illuminate\Database\Eloquent\Model;

class Audience extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand_id',
        'category_id',
        'influencer_size',
        'audience_gender',
        'audience_age',
        'audience_location',
        'audience_language',
        'audience_name',
    ];


    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    public function user()
    {
        return $this->belongsTo('App\Influencer\User\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Influencer\Category\Category');
    }
}