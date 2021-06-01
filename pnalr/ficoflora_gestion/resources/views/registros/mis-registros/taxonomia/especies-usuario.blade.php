@extends('master')

@section('css_section')
    @parent

    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/magnific-popup/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/toastr/css/toastr.css')}}">

@stop


@section('titulo-seccion')
    Especies
@stop

@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>
    <li><a href="{{route('usuario.registros')}}"><span>Mis Registros</span></a></li>
    <li><a href="#"><span>Especies</span></a></li>
@stop
@stop

{{--modal eliminar--}}
@section('registro-eliminar')
    la especie?
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
                <h5 class="name" ><i class="fa fa-list-ol pr-xs pl-sm"></i> Especies registradas por el usuario</h5>
            </header>
            <div class="panel-body">


                <div class="row">
                    <div class="col-sm-8">
                        <h5 class="mt-xs mb-xs">Número de especies: <b>{{$total}}</b></h5>
                    </div>
                    <div class="col-sm-4 ">
                        <a class="btn btn-default pull-right" href="{{route('especie.crear')}}" id="crear-row" data-toggle="tooltip" title="Nuevo" ><i class="fa fa-plus text-primary"></i> Nueva Especie</a>
                    </div>
                </div>
                <hr class="dotted short">

                <table id="datatable"  class="table table-hover table-striped table-bordered listas-resultados" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="numeros">#</th>
                        <th class="perfil-col">id</th>
                        <th class="perfil-col">Género</th>
                        <th class="perfil-col">Específico</th>
                        <th class="perfil-col">Varietal</th>
                        <th class="perfil-col">Forma</th>
                        <th class="perfil-col">Autoridad</th>
                        <th class="perfil-col">Catálogo</th>
                        <th class="acciones-col">Acciones</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($especies as $especie)

                        <tr>
                            <td></td>
                            <td class="" data-type="text" >{{$especie->id}}</td>

                            <td class="" data-type="text" >{{$especie->genero}}</td>
                            <td class="" data-type="text" >{{$especie->especifico}}</td>

                             {{--@if($especie->varietal == null)--}}
                                {{--<td class="" data-type="text">-</td>--}}
                            {{--@else--}}
                                <td class="" data-type="text" >{{$especie->varietal}}</td>
                            {{--@endif--}}

                            {{--@if($especie->forma == null)--}}
                                {{--<td class="" data-type="text">-</td>--}}
                            {{--@else--}}
                                <td class="" data-type="text" >{{$especie->forma}}</td>
                            {{--@endif--}}
                            <td class="" data-type="text" >{{$especie->autor}}</td>

                            @if($especie->catalogo)
                            <td class="" data-type="text" >Si</td>
                            @else
                                <td class="" data-type="text" >No</td>
                            @endif

                            <td class="acciones-row">
                                <a href="{{route ('especie.editar' ,$especie->id )}}" class="editar-row" data-toggle="tooltip" title="Editar" ><i class="fa fa-pencil"></i></a>
                                <a class="eliminar-row  modal-with-zoom-anim" href="#modal-eliminar"  data-toggle="tooltip" title="Eliminar" ><i class="fa fa-trash-o"></i></a>
                                <a href="{{url ('/especies',$especie->id )}}" data-toggle="tooltip" title="Información" ><i class="fa fa-info-circle"></i></a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>

                </table>



            </div>
        </section>
    </div>


    {{--Modal Eliminar--}}
    @include('registros.mis-registros._parciales._modal-eliminar')



@stop

@section('script_section')
    @parent

    <script>
        var root_url = "<?php echo Request::root(); ?>/";
        console.log(root_url);
    </script>

     <!-- Plugin para tabla y paginacion -->
    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/jquery.dataTables.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/dataTables.bootstrap.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js')}}'></script>

    <!-- Plugin de Notificacions -->
    <script type='text/javascript' src='{{ asset('plugins/toastr/js/toastr.min.js')}}'></script>


    <script type='text/javascript' src='{{ asset('js/datatable/config.datatable.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/examples.modals.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/registros/mis-registros/taxonomia/especies-usuario.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/componentes.js')}}'></script>

    <script>
        localStorage.setItem("menu", "m-registros");
    </script>

@stop


