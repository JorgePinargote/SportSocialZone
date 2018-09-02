@extends('layouts.plantilla')
@section('titulo','Entrenador')
@section('content')
<div>
    <h1 id ="Titulo">Equipos</h1>
</div>
<a id="cr" class="btn btn-primary" href="#">CrearEquipo</a>
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
            <button class="btn btn-primary">Editar Equipo</button>
            <button class="btn btn-primary">Eliminar Equipo</button>
            <button class="btn btn-primary">Ver noticias</button>
        </div>
    </div>
    @endforeach
</div>
@endsection
