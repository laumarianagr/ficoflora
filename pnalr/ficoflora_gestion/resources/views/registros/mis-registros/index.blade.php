
@extends('master')

@section('titulo-seccion')
    Registros del Usuario
@stop

@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>
    <li><a href="#"><span>Mis Registros</span></a></li>

@stop

@section('css_section')
    @parent



    <style>
        .tt-selectable{
            cursor: pointer;
        }
        a{
            display: block;
        }
    </style>

@stop

@section('content')


    <div class="row">

        <div class="col-md-12 col-xlg-10 col-xlg-offset-1">


            <div class="panel-group bl-primary" id="accordion">

               <div class="col-sm-6">
                   <div class="panel panel-accordion b-none">
                       <div class="panel-heading light">
                           <h4 class="panel-title">
                               <a class="accordion-toggle" data-toggle="collapse"  href="#catalogo">
                                   Catálogo
                               </a>
                           </h4>
                       </div>
                       <div id="catalogo" class="accordion-body collapse">
                           <div class="panel-body list">

                               <a href="{{route('usuario.reportes')}}"> Registros</a>
                           </div>
                       </div>
                   </div>
                   <div class="panel panel-accordion b-none ">
                       <div class="panel-heading light">
                           <h4 class="panel-title">
                               <a class="accordion-toggle" data-toggle="collapse" href="#collapse1">
                                   Especies
                               </a>
                           </h4>
                       </div>
                       <div id="collapse1" class="accordion-body collapse ">
                           <div class="panel-body list">
                               <a href="{{route('usuario.especies')}}">Especie</a>
                               <a href="{{route('usuario.sinonimias')}}"> Sinonimia</a>
                               <a href="{{route('usuario.autores')}}">Autoridad</a>
                               <a href="{{route('usuario.especificos')}}">Epíteto específico</a>
                               <a href="{{route('usuario.varietales')}}">Epíteto varietal</a>
                               <a href="{{route('usuario.formas')}}">Epíteto de forma</a>

                           </div>
                       </div>
                   </div>
                   <div class="panel panel-accordion b-none ">
                       <div class="panel-heading light">
                           <h4 class="panel-title">
                               <a class="accordion-toggle" data-toggle="collapse" href="#collapse1One">
                                   Taxonómicos
                               </a>
                           </h4>
                       </div>
                       <div id="collapse1One" class="accordion-body collapse ">
                           <div class="panel-body list">
                               <a href="{{route('usuario.phylums')}}">Phylum</a>
                               <a href="{{route('usuario.clases')}}">Clase</a>
                               <a href="{{route('usuario.subclases')}}">Subclase</a>
                               <a href="{{route('usuario.ordenes')}}">Orden</a>
                               <a href="{{route('usuario.familias')}}">Familia</a>
                               <a href="{{route('usuario.generos')}}">Género</a>

                           </div>
                       </div>
                   </div>
               </div>
               <div class="col-sm-6">
                   <div class="panel panel-accordion b-none">
                       <div class="panel-heading light">
                           <h4 class="panel-title">
                               <a class="accordion-toggle" data-toggle="collapse"  href="#collapse1Two">
                                   Bibliográficos
                               </a>
                           </h4>
                       </div>
                       <div id="collapse1Two" class="accordion-body collapse">
                           <div class="panel-body list">
                               <a href="{{route('usuario.libros')}}"> Libros</a>
                               <a href="{{route('usuario.revistas')}}"> Revistas</a>
                               <a href="{{route('usuario.trabajos')}}"> Trabajos Académicos</a>
                               <a href="{{route('usuario.enlaces')}}">Sitios Web</a>
                           </div>
                       </div>
                   </div>

                   <div class="panel panel-accordion b-none">
                       <div class="panel-heading light">
                           <h4 class="panel-title">
                               <a class="accordion-toggle" data-toggle="collapse"  href="#collapse1Three">
                                   Geográficos
                               </a>
                           </h4>
                       </div>
                       <div id="collapse1Three" class="accordion-body collapse">
                           <div class="panel-body list">
                               <a href="{{route('usuario.entidades')}}"> Entidades</a>
                               <a href="{{route('usuario.localidades')}}"> Localidades</a>
                               <a href="{{route('usuario.lugares')}}"> Lugares</a>
                               <a href="{{route('usuario.sitios')}}"> Sitios</a>
                               {{--<a href="{{route('usuario.ubicaciones')}}"> Ubicaciones</a>--}}
                           </div>
                       </div>
                   </div>
               </div>

            </div>
        </div>


    </div>


@stop

@section('script_section')
    @parent

    <script>
        localStorage.setItem("menu", "m-registros");
    </script>

@stop



