<?php

namespace App\Http\Controllers;

use App\Equipo;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Noticia;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class Graficosyreporte extends Controller
{
    
    public function noticiasEquipo(){
        $equipos = Auth::User()->equipos;
        //$equipos = json_decode($equipo);
        $datos = [];

    

        foreach($equipos as $equipo){
           $datos[] = 
            [
               'equipo' => $equipo->name_Equipo,
               'cantnoticias'=> $equipo->noticias()->count()
            ];
        }

        return response()->json($datos);

    }


    public function usersToday(){
        $users = User::all();
        $entrenadores = $users->where('tipo','=','entrenador');
        $generales = $users->where('tipo','=','general');

        $datos = 
        [["label"=>"entrenadores","value"=>$entrenadores->count()],["label"=>"generales","value"=>$generales->count()]];

        return response()->json($datos);
    }


    public function equiposDeporte(){
        $deportes = Equipo::groupBy('name_deporte')->select('name_deporte as deporte', DB::raw('count(*) as equipos'))->get();;
        return $deportes;
        
        foreach($deportes as $deporte){
            $datos[] = 
             [
                'deporte' => $deporte->Key,
                'cantequipos'=> $deporte->count()
             ];
         }

         return response()->json($datos);

    }


}
