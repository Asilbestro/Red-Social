<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    //Relacion de Many To One
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    //Relacion de Many To One
    public function image()
    {
        return $this->belongsTo('App\Models\Image', 'image_id');
    }
}
