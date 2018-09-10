@extends('layouts.plantilla')
@section('titulo','Usuario')
@section('content')
<div>
    <h1 id ="Titulo">Publicaciones</h1>
</div>
<a id="cr" class="btn btn-primary" href="/auth/publicaciones">Volver</a>
<div>
    @foreach($todos as $equipo)
    <div class = "row deportes">
        <div class="col-lg-10">
            <div class ="datosDeporte">
                <div>
                    <p class="tit">Entrenador: {{ $equipo->name }}</p>
                    }
                </div>
                <div>
                    <p class="tit">Nombre del Equipo: {{ $equipo->name_Equipo }}</p>
                </div>
                <div>
                    <p class="tit">Deporte:{{ $equipo->name_deporte }}</p>
                </div>
            </div>
        </div>
        <div class = "col-lg-2 botones">
            <button class= 'seguir' onclick="seguir({{ $equipo->id_Equipo }})">
                Seguir
            </button>
            <button class= 'seguir' onclick="Noseguir({{ $equipo->id_Equipo }})">
                No Seguir
            </button>
        </div>
    </div>
    @endforeach
</div>
@endsection
