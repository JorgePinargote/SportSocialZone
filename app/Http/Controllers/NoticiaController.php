<?php

namespace App\Http\Controllers;

use App\Noticia;
use App\Publicacion;
use App\User;
use App\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Noticia::all();

    }

    public function crear(Equipo $equipo)
    {
        $equip = $equipo;
        return View('noticias.nueva_noticia',compact('equip'));
    }

    public function actualizar(Request $request,Equipo $equipo)
    {
        return $Request;
        $input = request()->all();
        $request->validate([
            'titulo' => 'required|string',
            'texto' => 'required|string',
        ]);

        $noticia = Noticia::create(['titulo' => $input['titulo'] , 'idEquipo' =>  $equipo->id_Equipo, 'texto' => $input['texto'], 'direccionImagen' => 'defaultsportimg.jpg']);
        return $noticia;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = request()->all();

        $request->validate([
            'titulo' => 'required|string',
            'texto' => 'required|string',
            'idequipo'=> 'required|string',
        ]);

        //Hay que actualizar para que soporte imagen
        $noticia = Noticia::create(['titulo' => $input['titulo'] , 'idEquipo' =>  $input['idequipo'], 'texto' => $input['texto'], 'direccionImagen' => 'defaultsportimg.jpg']);
        $equipo = $noticia->equipo;
        $user = Auth::user(); 

        // CREACION DE PUBLICACION
        $publicacion = new Publicacion;
        $publicacion->user = $user->name;
        $publicacion->userid = $user->id;
        $publicacion->avatar = $user->avatar;
        $publicacion->equipo = $equipo->name_Equipo;
        $publicacion->idequipo = $equipo->id_Equipo;
        $publicacion->deporte = $equipo->name_deporte;
        $publicacion->titulo = $noticia->titulo;
        $publicacion->texto = $noticia->texto;
        $publicacion->imgnoticia = $noticia->direccionImagen;
        $publicacion->idnoticia = $noticia->id_Noticia;
        $publicacion->save();

        $message = 'Noticia almacenado con exito';
        return $message;     

    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function show(Noticia $noticium)
    {
        return $noticium;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Noticia  $noticia
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Noticia $noticium)
    {
             $input = request()->all();

             $request->validate([
                'titulo' => 'required|string',
                'texto' => 'required|string',
             ]);
                  
             //aqui se podria validar que el que actualice sea el mimso usuario que creo el recurso anteriormente, se puede ver por el id. 
             $noticium->fill(['titulo' => $input['titulo'] , 'texto' => $input['texto']])->save();
             
             $publicacion = Publicacion::where('idnoticia', '=', $noticium->id_Noticia)->get()->first();
             $publicacion->titulo = $input['titulo'];
             $publicacion->texto = $input['texto'];
             $publicacion->save();

             
             $message = 'noticia actualizada con exito';
             return $message;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Noticia $noticium)
    {
        $titulo = $noticium->titulo;

        $publicacion = Publicacion::where('idnoticia', '=', $noticium->id_Noticia)->get()->first();
        $publicacion->delete();

        $noticium->delete();

        $message = "Se ha eliminado ". $titulo;
        return $message;      
     

    }
}
