<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    //Indico que la tabla se llama images, porque si no la va a buscar por el nombre del modelo(Image)
    protected $table = 'images';

    //Relacion One To Many
    //Retorna todos los registros de comentarios que coincidan con el id indicado
    public function comments()
    {
        return $this->hasMany('App\Models\Comment')->orderBy('id', 'desc');
    }

    //Relacion One To Many
    //Retorna todos los registros de likes que coincidan con el id indicado
    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }

    //Relacion de Many To One
    //Retorna usuario relacionado con el id de image
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
