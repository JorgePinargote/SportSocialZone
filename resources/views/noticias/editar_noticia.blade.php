@extends('layouts.plantilla')
@section('titulo','Editar Noticia')
@section('content')
<div class="ingreso">
    {!! Form::model($noticium,['route'=>
    ['noticia.update',$noticium],'method'=>
    'PUT'])!!}
    <h3>Editar Noticia</h3>
    <div class="form-group row">
        {!! Form::label('name','Nombre',['class'=>
        'form-control-plaintext col-sm-3 col-form-label'])!!}
        <div class="col-sm-9">
            {!! Form::text('titulo',null,['id'=>
            'nE','class' =>
            'form-control-plaintext ','required'=>
            ''] )!!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('deporte','Deporte',['class'=>
        'form-control-plaintext col-sm-3 col-form-label'])!!}
        <div class="col-sm-9">
            {!! Form::text('texto',null,['class' =>
            'form-control-plaintext','required'=>
            ''] )!!}
        </div>
    </div>
    <div id="ad_bt">
        {!!Form::submit('Guardar',['class'=>
        'btn btn-primary'])!!}
        <a class="btn btn-primary" href='/auth/noticias-equipo/{{ $noticium->id_Noticia }}'>
            Volver
        </a>
    </div>
    {!! Form::close()!!}
</div>
@endsection
