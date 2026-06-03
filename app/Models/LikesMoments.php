<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class LikesMoments extends Model
{
    protected $table = 'likes_moments';
    public $timestamps = false;
    
    protected $fillable = [
        'user_id', 
        'moment_id', 
    ];

}
