@extends('layouts.plantilla')
@section('titulo','Entrenador')
@section('content')
<div>
    <h1 id ="Titulo">Equipos</h1>
</div>
<a id="cr" class="btn btn-primary" href="equipo/create">CrearEquipo</a>
<div>
    @foreach($equipos as $equipo)
    <div class = "row deportes">
        <div class="col-lg-7">
            <div class ="datosDeporte">
                <div>
                    <p class="tit">Nombre: {{ $equipo->name_Equipo }}</p>
                    <p></p>
                </div>
                <div>
                    <p class="tit">Deporte:{{ $equipo->name_deporte }}</p>
                    <p></p>
                </div>
            </div>
        </div>
        <div class = "col-lg-5 botones">
            <a class="btn btn-primary" href="equipo/{{ $equipo->id_Equipo }}/edit">
                Editar Equipo
            </a>
            <a class="btn btn-primary">Eliminar Equipo</a>
            <a class="btn btn-primary" href="noticias-equipo/{{ $equipo->id_Equipo }}">
                Ver noticias
            </a>
        </div>
    </div>
    @endforeach
</div>
@endsection
