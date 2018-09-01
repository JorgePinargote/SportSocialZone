@extends('layouts.plantilla')
@section('titulo','Entrenador')
@section('content')
<div>
    <h1 id ="Titulo">Equipos</h1>
</div>
<a id="cr" class="btn btn-primary" href="/nuevo_equipo.html">CrearEquipo</a>
<div ng-repeat="equipo in equipos">
    <div class = "row deportes">
        <div class="col-lg-7">
            <div class ="datosDeporte" id= "">
                <div>
                    <p class="tit">Nombre: {{ $users }}</p>
                    <p></p>
                </div>
                <div>
                    <p class="tit">Deporte:</p>
                    <p></p>
                </div>
            </div>
        </div>
        <div class = "col-lg-5 botones">
            <button class="btn btn-primary">Editar Equipo</button>
            <button class="btn btn-primary" ng-click="eliminar(equipo.id_Equipo,equipo)">Eliminar Equipo</button>
            <button class="btn btn-primary">Ver noticias</button>
        </div>
    </div>
</div>
@endsection
