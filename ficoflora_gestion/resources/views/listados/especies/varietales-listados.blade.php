@extends('master')

@section('css_section')
    @parent

    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">

@stop


@section('titulo-seccion')
    Epítetos Varietales
@stop

@section('breadcrumbs')
    <li><a href="{{route('listados.index')}}"><span>Listados</span></a></li>
    <li><a href="#"><span>Epítetos Varietales</span></a></li>
@stop

@section('content')
    @include('errors._listar')


    <input type="hidden" name="_token" value="{{ csrf_token() }}" />



    <div class="col-md-12 col-xl-10 col-xl-push-1">
        <section class="panel">
            <header class="panel-heading  p-xs">
                <div class="panel-actions">
                    <a href="#" class="fa fa-caret-up"></a>
                </div>
                <h5 class="name" ><i class="fa fa-list-ol pr-xs pl-sm"></i> Epítetos Varietales</h5>
            </header>
            <div class="panel-body">



                <div class="row">
                    <div class="col-sm-8">
                        <h5 class="mt-xs mb-xs">Número de epítetos varietales: <b>{{$total}}</b></h5>
                    </div>
                    <div class="col-sm-4 ">
                        @if($usuario->perfil_id <=3)
                            <a class="btn btn-default pull-right" href="{{route('varietal.crear')}}" id="crear-row" data-toggle="tooltip" title="Nuevo" ><i class="fa fa-plus text-primary"></i> Nuevo epíteto</a>
                        @endif

                    </div>
                </div>
                <hr class="dotted short">

                <table id="datatable"  class="table table-hover table-striped table-bordered listas-resultados" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="numeros">#</th>
                        <th class="perfil-col">id</th>
                        <th class="perfil-col">Nombre del Epiteto Varietal</th>
                        <th class="acciones-col">Acciones</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($varietales as $varietal)

                        <tr>
                            <td></td>
                            <td class="" data-type="text" >{{$varietal->id}}</td>
                            <td class="" data-type="text" ><a href="{{route ('varietal.mostrar' ,$varietal->id )}}" >{{$varietal->nombre}}</a></td>

                            <td class="acciones-row">
                                <a href="{{url ('/varietales',$varietal->id )}}" data-toggle="tooltip" title="Información" ><i class="fa fa-info-circle"></i></a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>

                </table>



            </div>
        </section>
    </div>




@stop

@section('script_section')
    @parent


    <!-- Plugin para tabla y paginacion -->
    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/jquery.dataTables.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/dataTables.bootstrap.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/datatable/config.datatable.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/componentes.js')}}'></script>
    <script>
        localStorage.setItem("menu", "m-listados");
    </script>

@stop


