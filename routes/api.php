<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/




Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::get('testmongo','PublicacionController@index');
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {

        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');

        Route::resource('equipo','EquipoController'); 

        Route::resource('noticia','NoticiaController');

        Route::get('noticias-equipo/{equipo}','EquipoController@noticiasPorEquipo');

        Route::get('equipos-user','EquipoController@equiposPorUsuario');
        
        

        
        //Route::get('storenoticia/{equipo}','NoticiaController@storeNoticia');
        
        // rutas para el usuario general

        Route::post('follow','FollowController@store');
        Route::delete('follow/{follow}','FollowController@destroy');
        Route::get('follow/{equipo}','FollowController@isFollowed');

        Route::get('publicaciones','PublicacionController@PublicacionesByFollow');


    });
});





 /*
        Route::get('ver', function (Request $request) {
            return "Puedes ver";
        })->middleware('scope:ver');;

        Route::get('crear', function (Request $request) {
            return "Puedes crear";
        })->middleware('scope:crear');*/