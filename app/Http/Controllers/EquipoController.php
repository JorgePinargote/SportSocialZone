<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Equipo::all();

        $user =Auth::user();
        $equipos=$user->equipos;
        return view('entrenadores.entrenador',compact('equipos'));
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

        // 

        $request->validate([
            'nombre' => 'required|string',
            'deporte' => 'required|string',
        ]);



        $equipo = Equipo::create(['name_Equipo' => $input['nombre'] , 'idUsers' => Auth::id(), 'name_deporte' => $input['deporte']]);

        return redirect()->action('EquipoController@index');
   
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function show(Equipo $equipo)
    {   
        return $equipo;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('entrenadores.nuevo_equipo');
    }

    public function edit(Equipo $equipo)
    {
        return View('entrenadores.editar_equipo',compact('equipo'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipo $equipo)
    {   
        $input = request()->all();
   // 
        $request->validate([
            'name_Equipo' => 'required|string',
            'name_deporte' => 'required|string',
        ]);


        //aqui se podria validar que el que actualice sea el mimso usuario que creo el recurso anteriormente, se puede ver por el id. 
        $equipo->fill(['name_Equipo' => $input['name_Equipo'] , 'idUsers' => $equipo->idUsers, 'name_deporte' => $input['name_deporte']])->save();
        
        return redirect()->action('EquipoController@index');

          
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipo $equipo)
    {
        $id = $equipo->name_Equipo;
        $equipo->delete();

        $message = "Se ha eliminado ". $id;
        return $message;      
    }


    public function equiposPorUsuario(){
        $user = Auth::user();
        $equipos=$user->equipos;
        return view('entrenadores.entrenador',compact('equipos')); 

        //return $user->equipos;
    }

    public function noticiasPorEquipo(Equipo $equipo){
        return $equipo->noticias;

    }

    public function cont(){
        $user =Auth::user();
        $equipos=$user->equipos;
        return view('entrenador',compact('equipos'));
    }


}
