<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Publicacion;

class ReportController extends Controller
{
    public function _construct(){
    	$this->middleware('guest');
    }
    public function generar(){
    	$equipos =\DB::table('equipos')
    	->select(['id_Equipo','name_Equipo', 'name_deporte'])
    	->get();
    	// $publicaciones =DB::connection('mongodb')->collection('publicacions')->where('titulo','texto')->get();

    	$publicaciones=Publicacion::select('idequipo','equipo','deporte','titulo','texto')->get(); 
    	//return $publicaciones;
    	//return view('reporte');
    	$view = \View::make('reporte', compact('equipos','publicaciones'))->render();
    	$pdf = \App::make('dompdf.wrapper');
    	$pdf->loadHTML($view);
    	return $pdf->stream('informe', '.pdf' );
    }
    public function descargar(){
    	$equipos =\DB::table('equipos')
    	->select(['id_Equipo','name_Equipo', 'name_deporte'])
    	->get();
    	// $publicaciones =DB::connection('mongodb')->collection('publicacions')->where('titulo','texto')->get();

    	$publicaciones=Publicacion::select('idequipo','equipo','deporte','titulo','texto')->get(); 
    	//return $publicaciones;
    	//return view('reporte');
    	$view = \View::make('reporte', compact('equipos','publicaciones'))->render();
    	$pdf = \App::make('dompdf.wrapper');
    	$pdf->loadHTML($view);
    	return $pdf->download('informe', '.pdf' );
    }
}
