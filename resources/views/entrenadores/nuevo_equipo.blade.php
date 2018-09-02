@extends('layouts.plantilla')
@section('titulo','Entrenador')
@section('content')
<div class="ingreso">
    {!! Form::open(['route'=>
    'equipo.store','method'=>
    'POST'])!!}
    <h1>Datos</h1>
    <div class="form-group row">
        {!! Form::label('nombre','Nombre',['class'=>
        'form-control-plaintext col-sm-3 col-form-label'])!!}
        <div class="col-sm-9">
            {!! Form::text('nombre',null,['id'=>
            'nE','placeholder'=>
            'Equipo','class' =>
            'form-control-plaintext ','required'=>
            ''] )!!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('deporte','Deporte',['class'=>
        'form-control-plaintext col-sm-3 col-form-label'])!!}
        <div class="col-sm-9">
            {!! Form::text('deporte',null,['placeholder'=>
            'Deporte','class' =>
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
