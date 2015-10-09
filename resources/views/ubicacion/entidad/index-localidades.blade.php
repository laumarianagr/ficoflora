@extends('master')

@section('title')

@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins\DataTables-1.10.7\css\dataTables.bootstrap.css')}}">
@stop

@section('content')

        @section('ubicacion-tipo')
            Entidad federal
        @stop


        @section('ruta-pdf')
            <a href="{{route('pdf.entidad.localidades', [$ubicacion['entidad_id']])}}">
        @stop


    @section('ubicacion-nombre')
            {{$ubicacion['entidad']}}
        @stop


        @section('ubicacion-superior')
            <span class="text-muted">Pais:</span> <a class="text-primary" href="{{route('pais.entidades', 'venezuela')}}">{{$ubicacion['pais']}} </a>
        @stop


        @section('listar')
            localidades
        @stop

        @section('pertenece')
            a la entidad federal
        @stop

        @section('ubicacion-listar')
            de la Localidad
        @stop


        @section('content-tabla')

            @foreach($localidades as $localidad)
                <tr>
                    <td ></td>

                    <td class="perfil">
                        @if($localidad['lugares'] > 0)
                            <a href="{{route('localidad.lugares', [$localidad['id']])}}">{{$localidad['nombre']}}</a>
                        @else
                            <a class="not-active">{{$localidad['nombre']}}</a>
                        @endif
                    </td>

                    <td >
                        @if($localidad['especies'] > 0)
                            <a class="action" href="{{route('localidad.especies', [$localidad['id']])}}">{{$localidad['especies']}} </a>
                        @else
                            <a class="action not-active">-</a>
                        @endif
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
