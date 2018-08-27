<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use App\Comment;

class Publicacion extends Eloquent
{
    protected $connection = 'mongodb';

    //protected $fillable = ['noticia','equipo', 'user'];

    public function comentarios()
    {
        return $this->hasMany('App\Comment');
    }

}
