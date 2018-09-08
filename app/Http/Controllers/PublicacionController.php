<?php

namespace App\Http\Controllers;

use App\Publicacion;
use App\Follow;
use Illuminate\Http\Request;
use App\Equipo;
use Illuminate\Support\Facades\Auth;

class PublicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Publicacion::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Publicacion  $publicacion
     * @return \Illuminate\Http\Response
     */
    public function show(Publicacion $publicacion)
    {
        return view('Publicacion.comments',compact('publicacion'));
    }

    /* Esta funcion obtiene las publicaciones por los equipos seguidos del usuario actual */
    public function PublicacionesByFollow(){

        $follows = Follow::select('equipo')->where('idusuario','=', Auth::user()->id)->get();
        $follows = json_decode($follows);
        $ids= array();
        foreach ($follows as $follow) {
            array_push($ids,$follow->equipo);

        }
        $publicaciones= Publicacion::wherein('idequipo',$ids)->orderBy('created_at','desc')->get();

        /*$array["publicaciones"] = array();
        $publicaciones = Publicacion::where('idequipo',$follow->equipo)->orderBy('created_at','desc')->get();
        return $publicaciones;
        foreach($follows as $follow){
            $publicaciones = Publicacion::where('idequipo','in', $follow->equipo)->orderBy('created_at','desc')->get();
            foreach($publicaciones as $publicacion){
                array_push($array["publicaciones"], $publicacion);
            }
        }
        $publicaciones= $array['publicaciones'];*/

        return view('generales.usuario',compact('publicaciones'));
    }

}
