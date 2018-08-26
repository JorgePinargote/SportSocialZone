<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    //

    protected $fillable = ['name_Equipo','idUsers', 'name_deporte'];

    public $timestamps = false;

    protected $primaryKey = 'id_Equipo';

    public function user(){
        return $this->belongsTo('App\User', 'idUsers');
    }


    public function noticias()
    {
        return $this->hasMany('App\Noticia', 'idEquipo');
    }


}
