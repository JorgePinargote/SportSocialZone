@extends('layouts.plantilla')
@section('titulo','Noticias')
@section('content')
<div>
    <h1 id = "Titulo">Noticias</h1>
</div>
<div class="botones " id="cr">
    {!! Form::open(['route'=>
    ['noticia.crear',$id],'method'=>
    'GET']) !!}
    {!! Form::submit('Crear Noticia',[ 'class'=>
    'btn btn-primary']) !!}
    {!! Form::close() !!}
    <a  class="btn btn-primary" href="/auth/equipo">Volver</a>
</div>
<div>
    @foreach($noti as $noticia)
    <div class = "row deportes">
        <div class="col-lg-6">
            <div class ="datosDeporte">
                <div>
                    <p>Titulo:</p>
                    <p>{{ $noticia->titulo }}</p>
                </div>
                <div>
                    <p>Noticia:</p>
                    <p>{{ $noticia->texto }}</p>
                </div>
            </div>
        </div>
        <div class = "col-lg-6">
            <div class="botones">
                <a class="btn btn-primary" href="/auth/noticia/{{ $noticia->id_Noticia }}/edit">
                    Editar Noticia
                </a>
                {!! Form::open(['route'=>
                ['noticia.destroy',$noticia],'method'=>
                'DELETE']) !!}
                {!! Form::submit('Eliminar Noticia',[ 'class'=>
                'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
