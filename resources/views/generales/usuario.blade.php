@extends('layouts.plantilla')
@section('titulo','Usuario')
@section('content')
<div>
    <h1 id ="Titulo">Publicaciones</h1>
</div>
<a id="cr" class="btn btn-primary" href="equipo/create">CrearEquipo</a>
<div>
    @foreach($publicaciones as $publicacion)
    <div class = "row deportes">
        <div class="col-lg-5">
            <div class ="datosDeporte">
                <div>
                    <p class="tit">Nombre: {{ $publicacion->titulo }}</p>
                    <p></p>
                </div>
                <div>
                    <p class="tit">Deporte:{{ $publicacion->texto }}</p>
                    <p></p>
                </div>
            </div>
        </div>
        <div class = "col-lg-7 botones">
            <a class="btn btn-primary" href="">Editar Equipo</a>
            <a class="btn btn-primary" href="">Ver noticias</a>
        </div>
    </div>
    @endforeach
</div>
@endsection
