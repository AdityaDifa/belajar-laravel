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

    public function user()
    {
        // Asumsi di tabel moments ada kolom user_id
        return $this->belongsTo(Profile::class, 'user_id');
    }

    public function likes()
    {
        return $this->hasMany(LikesMoments::class,'moment_id');
    }

    public function dislikes()
    {
        return $this->hasMany(DislikesMoments::class,'moment_id');
    }

    public function comments(){
        return $this->hasMany(CommentsMoments::class, 'moment_id');
    }
}
