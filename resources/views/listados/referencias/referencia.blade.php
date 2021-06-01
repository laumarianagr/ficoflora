@extends('master')

@section('title')

@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">
@stop

@section('content')

    @section('referencia-tipo')
        Referencia Bibliográfica
    @stop

    @section('ruta-pdf')
      <!--  <a href="route('pdf.listado.referencias')}}"> -->
    @stop

    @section('listar')
        <h5 class="">
            Tipo: <b>{{$tipo}}</b>
        </h5>
    @stop

    @section('content-tabla')
        <!-- se construye la referencia bibliográfica según formato de Revista -->
        @include('listados.referencias._parciales._referencia')

        <h5>Localidades Reportadas</h5>
        <!--<h1>{{$totalReg}}</h1>-->
        

        @foreach($entidad as $entidades)

            @if(isset($entidades->nombre_sitio))

                <li>{{$entidades->nombre_entidad}}, {{$entidades->nombre_localidad}} ( {{$entidades->nombre_lugar}} ) [{{$entidades->nombre_sitio}}]</li>

            @elseif(isset($entidades->nombre_lugar))  

                <li>{{$entidades->nombre_entidad}}, {{$entidades->nombre_localidad}} ( {{$entidades->nombre_lugar}} )  </li>

            @elseif(isset($entidades->nombre_localidad)) 

                <li>{{$entidades->nombre_entidad}}, {{$entidades->nombre_localidad}} </li>   
                
            @elseif(isset($entidades->nombre_entidad))

                <li>{{$entidades->nombre_entidad}}</li> 

            @endif  

<!-- 
        <li>{{$entidades->entidad_id}}</li> -->

        @endforeach



    @stop

    @include('listados.referencias._index_referencia')
@stop

@section('script_section')
    @parent

    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/jquery.dataTables.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/dataTables.bootstrap.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/busquedas/dataTable_resultados.js')}}'></script>
    <script type="text/javascript">
        var referencias = <?php echo $referencia;?>;
        var registros = <?php echo $registros; ?>;
        var entidad = <?php echo $entidad; ?>;

        // let entidad = new Array();
        // entidad = <?php //echo $entidad[1]; ?>;
       
        // <?php 
        //     $entidades = array();
        //     foreach($entidad as $entidadOj){
        //         echo array_push($entidades, $entidadOj);
        //     }
        // ?>

        console.log(referencias);
        console.log(registros);

        console.log(entidad);
    </script>

@stop
