@extends('layouts.plantilla')
@section('titulo','Usuario')
@section('content')
<div>
    <h1 id ="Titulo">Publicaciones</h1>
</div>
<a id="cr" class="btn btn-primary" href="equipo/create">Ver Equipos</a>
<div>
    @foreach($todos as $equipo)
    <div class = "row deportes">
        <div class="col-lg-10">
            <div class ="datosDeporte">
                <div>
                    <p class="tit">Entrenador: {{ $equipo->name }}</p>
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
            <a class="btn btn-primary" href='{{ url('/auth/equipo') }}'>seguir</a>
            {!! Form::open(['route'=>
            ['follow.guardar'],'method'=>
            'POST']) !!}
            {!! Form::submit('Seguir Equipo',[ 'class'=>
            'btn btn-primary']) !!}
            {!!Form::hidden('idequipo',$equipo->
            id_Equipo)!!}
            {!! Form::close() !!}
        </div>
    </div>
    @endforeach
</div>
@endsection
