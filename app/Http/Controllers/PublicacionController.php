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

        $follows = Follow::where('idusuario','=', Auth::user()->id)->get();
        $follows = json_decode($follows);
        $array["publicaciones"] = array();

        foreach($follows as $follow){
            $publicaciones = Publicacion::where('idequipo','=', $follow->equipo)->get();
            foreach($publicaciones as $publicacion){
                array_push($array["publicaciones"], $publicacion);
            }
        }
        $publicaciones= $array['publicaciones'];
        return view('generales.usuario',compact('publicaciones'));
    }

}
