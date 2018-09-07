@extends('layouts.plantilla')
@section('titulo','Usuario')
@section('content')
<div>
    <h1 id ="Titulo">Publicaciones</h1>
</div>
<a id="cr" class="btn btn-primary" href="ver_equipos">Ver Equipos</a>
<div>
    @foreach($publicaciones as $publicacion)
    <div class = "row deportes">
        <div class="col-lg-10">
            <div class ="datosDeporte">
                <div>
                    <p class="tit">Equipo: {{ $publicacion->equipo }}</p>
                </div>
                <div>
                    <p class="tit">Deporte:{{ $publicacion->deporte }}</p>
                </div>
                <div>
                    <p class="tit">Nombre: {{ $publicacion->titulo }}</p>
                </div>
                <div>
                    <p class="tit">Publicacion:{{ $publicacion->texto }}</p>
                </div>
            </div>
        </div>
        <div class = "col-lg-2 botones">
            <a class="btn btn-primary" href="">Ver publicacion</a>
        </div>
    </div>
    @endforeach
</div>
@endsection
