@extends('layouts.plantilla')
@section('titulo','Entrenador')
@section('content')
<div class="ingreso">
    {!! Form::model($noticia,['route'=>
    ['noticia.update',$noticia],'method'=>
    'PUT'])!!}
    <h1>Datos</h1>
    <div class="form-group row">
        {!! Form::label('name','Nombre',['class'=>
        'form-control-plaintext col-sm-3 col-form-label'])!!}
        <div class="col-sm-9">
            {!! Form::text('name_Equipo',null,['id'=>
            'nE','class' =>
            'form-control-plaintext ','required'=>
            ''] )!!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('deporte','Deporte',['class'=>
        'form-control-plaintext col-sm-3 col-form-label'])!!}
        <div class="col-sm-9">
            {!! Form::text('name_deporte',null,['class' =>
            'form-control-plaintext','required'=>
            ''] )!!}
        </div>
    </div>
    <div id="ad_bt">
        {!!Form::submit('Guardar',['class'=>
        'btn btn-primary'])!!}
        <a class="btn btn-primary" href='{{ url('/auth/equipo') }}'>Volver</a>
    </div>
    {!! Form::close()!!}
</div>
@endsection
