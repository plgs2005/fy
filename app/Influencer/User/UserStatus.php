<?php

namespace App\Influencer\User;

use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    protected $table = 'user_status';
    protected $fillable = [
        'user_id', 'status'
    ];

}