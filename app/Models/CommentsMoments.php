<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class CommentsMoments extends Model
{
    protected $table = 'comments_moments';
    
    protected $fillable = [
        'moment_id', 
        'user_id',
        'comment'
    ];

    public function user(){
        return $this->belongsTo(Profile::class, 'user_id');
    }
}
