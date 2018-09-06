<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function elegir(){
    	$user =Auth::user();
    	$id =$user->role_id;
    	if($id == 3){
    		return redirect()->action('EquipoController@equiposPorUsuario');
    	}
    	else{
    		return redirect()->action('PublicacionController@PublicacionesByFollow');
    	}
    }
}
