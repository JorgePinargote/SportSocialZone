<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('grafico-userstoday','Graficosyreporte@usersToday');
Route::get('grafico-equipos-deporte','Graficosyreporte@equiposDeporte');
Route::post('helpmail','HelpMailController@sendHelpMail');




Route::group([
    'prefix' => 'auth'
], function () {
    
    //Route::get('testmongo','PublicacionController@index');
  
    Route::group([
      'middleware' => 'auth'
    ], function() {
        Route::get('user', 'AuthController@user');

        Route::resource('equipo','EquipoController'); 
        Route::resource('noticia','NoticiaController');

        Route::get('noticias-equipo/{equipo}','EquipoController@noticiasPorEquipo');
        Route::get('equipos-user','EquipoController@equiposPorUsuario');
        // rutas para el usuario general

        Route::post('follow','FollowController@store');
        Route::delete('follow/{follow}','FollowController@destroy');

        Route::get('follow/{equipo}','FollowController@isFollowed');

        Route::get('publicaciones','PublicacionController@PublicacionesByFollow');

        //Comentarios 
        Route::post('comment','CommentController@store');
        Route::delete('comment/{comment}','CommentController@destroy');
        Route::get('comment/{idpublicacion}','CommentController@commentByPublicacion');

        //graficos
        Route::get('grafico-noticias-equipo','Graficosyreporte@noticiasEquipo');
    });
});

