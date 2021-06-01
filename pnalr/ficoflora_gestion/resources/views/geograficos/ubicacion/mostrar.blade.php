@extends('master')

@section('css_section')
    @parent

@stop


@section('content')

    <h1>Datos de la ubicacion:</h1>
    <br/>
    <h4> <b>Sitio:</b> </h4> <h4>{{$ubicacion->sitio}} </h4>
    <h4> <b>Lugar:</b> </h4> <h4>{{$ubicacion->lugar}} </h4>
    <h4> <b>Localidad:</b> </h4> <h4>{{$ubicacion->localidad}} </h4>
    <h4> <b>Entidad:</b> </h4> <h4>{{$ubicacion->entidad}} </h4>

@stop

@section('script_section')
    @parent



@stop


