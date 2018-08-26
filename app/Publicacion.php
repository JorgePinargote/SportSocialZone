<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Publicacion extends Eloquent
{
    protected $connection = 'mongodb';

    //protected $fillable = ['noticia','equipo', 'user'];

}
