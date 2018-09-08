@extends('layouts.plantilla')
@section('titulo','Entrenador')
@section('content')
<div class="ingreso2">
    {!! Form::open(['route'=>
    'mail.send','method'=>
    'POST'])!!}
    <h1 id="correo_titulo">Enviar correo</h1>
    {!!Form::hidden('nombre',$user->
    name)!!}
    {!!Form::hidden('email',$user->
    email)!!}
    <div class="form-group row">
        {!! Form::label('asunto','Asunto',['class'=>
        'form-control-plaintext col-sm-2 col-form-label'])!!}
        <div class="col-sm-10">
            {!! Form::text('asunto',null,['id'=>
            'nE','class' =>
            'form-control-plaintext nuevo2','required'=>
            ''] )!!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('mensaje','Mensaje',['class'=>
        'form-control-plaintext col-sm-2 col-form-label'])!!}
        <div class="col-sm-10">
            {!! Form::text('mensaje',null,['class' =>
            'form-control-plaintext nuevo','required'=>
            ''] )!!}
        </div>
    </div>
    <div id="ad_bt">
        {!!Form::submit('Enviar',['class'=>
        'btn btn-primary'])!!}
        <a class="btn btn-primary" href='{{ url('/auth/elegir') }}'>Volver</a>
    </div>
    {!! Form::close()!!}
</div>
@endsection
