@extends('layouts.plantilla')
@section('titulo','Entrenador')
@section('content')
	<div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <svg id='barGraph2' width = "1000" height = "400"></svg>
        </div>
    </div>
    @section('scripts')
    <script type="text/javascript" src="/js/grafico_equipo.js"></script>
    @endsection
@endsection