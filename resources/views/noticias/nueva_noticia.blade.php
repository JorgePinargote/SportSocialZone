@extends('layouts.plantilla')
@section('titulo','Nueva noticia')
@section('content')
<div class="ingreso">
    {!! Form::open(['route'=>
    [
    'noticia.actualizar'],'method'=>
    'POST'])!!}
    <h1>Datos</h1>
    <div class="form-group row">
        {!! Form::label('titulo','Titulo',['class'=>
        'form-control-plaintext col-sm-3 col-form-label'])!!}
        <div class="col-sm-9">
            {!! Form::text('titulo',null,['id'=>
            'nE','placeholder'=>
            'Titulo','class' =>
            'form-control-plaintext ','required'=>
            ''] )!!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('noticia','Noticia',['class'=>
        'form-control-plaintext col-sm-3 col-form-label'])!!}
        <div class="col-sm-9">
            {!! Form::text('texto',null,['placeholder'=>
            'Noticia','class' =>
            'form-control-plaintext','required'=>
            ''] )!!}
        </div>
    </div>
    <div id="ad_bt">
        {!!Form::submit('Guardar',['class'=>
        'btn btn-primary'])!!}
        <a class="btn btn-primary" href='{{ url('/auth/equipo') }}'>Volver</a>
    </div>
    {!!Form::hidden('idEquipo','$id')!!}
    {!! Form::close()!!}
</div>
@endsection
