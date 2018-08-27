<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Comment extends Eloquent
{
    protected $connection = 'mongodb';

    protected $fillable = ['userid','username', 'avatar','comentario'];
    
    public function publicacion()
    {
        return $this->belongsTo('App\Publicacion');
    }

}
