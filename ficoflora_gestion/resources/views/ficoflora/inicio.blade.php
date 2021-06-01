@extends('master')

@section('title')
    Inicio
@stop

@section('breadcrumbs')
    <li><a href="#"><span>Inicio</span></a></li>

@stop
@section('css_section')
    @parent

@stop

@section('content')
    <div class="col-xs-12">
        <h3 class="text-center mb-xlg pb-xlg">Módulos de Gestión de Datos y Generación de Estadísticas del</h3>

        <h2 class="text-center mt-xlg">Catálogo Taxonómico Digital de Macroalgas Bénticas Marinas</h2>

        <h2 class="text-center">Ficoflora - Venezuela</h2>
    </div>
@stop

@section('script_section')
    @parent
    <script>
        localStorage.setItem("menu", "m-inicio");
    </script>
@stop
