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

//Route::get('idnoticia/{comment}','CommentController@idnoticia');


Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::get('testmongo','PublicacionController@index');

  
    Route::group([
      'middleware' => 'auth'
    ], function() {

        Route::get('user', 'AuthController@user');

        Route::resource('equipo','EquipoController'); 
        Route::resource('noticia','NoticiaController');

        Route::get('noticias-equipo/{equipo}','EquipoController@noticiasPorEquipo');
        Route::get('equipos-user','EquipoController@equiposPorUsuario');
        Route::get('noticia/crear/{equipo}','NoticiaController@crear')->name('noticia.crear');
        Route::post('noticia/actualizar','NoticiaController@actualizar')->name('noticia.actualizar');

        // rutas para el usuario general

        Route::post('follow','FollowController@store');
        Route::delete('follow/{follow}','FollowController@destroy');

        Route::get('follow/{equipo}','FollowController@isFollowed');

        Route::get('publicaciones','PublicacionController@PublicacionesByFollow');
        Route::get('publicacion/{publicacion}','PublicacionController@show');

        //Comentarios 
        Route::post('comment','CommentController@store');
        Route::delete('comment/{comment}','CommentController@destroy');

        Route::get('comment/{idpublicacion}','CommentController@commentByPublicacion'); //obtiene comentarios por id 

        //graficos
        Route::get('grafico-noticias-equipo','Graficosyreporte@noticiasEquipo');

        Route::get('prueba','EquipoController@cont');

        Route::get('pdf', 'ReportController@generar');

    });
});



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
