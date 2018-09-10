<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publicacion;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function raiz(){
        $publicaciones=Publicacion::select('idequipo','equipo','deporte','titulo','texto')->get();
        return view('welcome',compact('publicaciones'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        return view('home');
    }

}
