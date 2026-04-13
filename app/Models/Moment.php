<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Moment extends Model
{
    protected $fillable = [
        'user_id', 
        'title', 
        'streamer_name', 
        'stream_url', 
        'description'
    ];
}
