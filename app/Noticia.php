<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $primaryKey = 'id_Noticia';
    
    protected $fillable = ['titulo','idEquipo', 'texto','direccionImagen', 'created_at', 'updated_at'];
    
    public function equipo(){
        return $this->belongsTo('App\Equipo', 'idEquipo', 'id_Equipo');
    }


}
