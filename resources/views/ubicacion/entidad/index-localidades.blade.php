@extends('master')

@section('title')

@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins\DataTables-1.10.7\css\dataTables.bootstrap.css')}}">
@stop

@section('content')

        @section('ubicacion-tipo')
            Entidad
        @stop

        @section('ubicacion-nombre')
            {{$ubicacion['entidad']}}
        @stop


        @section('ubicacion-superior')
            <span class="text-muted">Pais:</span> <a class="text-primary" href="{{route('pais.entidades', 'venezuela')}}">{{$ubicacion['pais']}} </a>
        @stop


        @section('listar')
            Localidades
        @stop

        @section('pertenece')
            a la entidad
        @stop

        @section('ubicacion-listar')
            de la Localidad
        @stop


        @section('content-tabla')

            @foreach($localidades as $localidad)
                <tr>
                    <td ></td>

                    <td class="perfil">

                        <a href="{{route('localidad.lugares', [$localidad['id']])}}">
                             {{$localidad['nombre']}}

                        </a>
                    </td>

                    <td >
                        <a class="action" href="{{route('localidad.especies', [$localidad['id']])}}"><i class="fa fa-eye"></i></a>
                    </td>


                </tr>
            @endforeach
        @stop


        @include('resultados._index-resultados-ubicacion')


@stop

@section('script_section')
    @parent


    <script type='text/javascript' src='{{ asset('plugins\DataTables-1.10.7\js\jquery.dataTables.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins\DataTables-1.10.7\js\dataTables.bootstrap.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/busquedas/dataTable_resultados.js')}}'></script>
    <script>

    </script>
@stop
