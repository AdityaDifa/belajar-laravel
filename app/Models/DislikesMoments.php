<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class DislikesMoments extends Model
{
    protected $table = 'dislikes_moments';
    public $timestamps = false;
    
    protected $fillable = [
        'user_id', 
        'moment_id', 
    ];

}
