@extends('master')

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/magnific-popup/magnific-popup.css')}}">

@stop
@section('titulo-seccion')
    Información del Registro
@stop

@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>
    <li><a href="{{route('usuario.temporales')}}"><span>Enviados</span></a></li>
    <li><a href="#"><span>Registro</span></a></li>

@stop



@section('content')
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <div class="row">
        <div class="col-md-12 ">
            <section class="panel panel-featured-left panel-featured-primary">
                <div class="panel-body ">
                    <div class="widget-summary">

                        <div class="widget-summary-col">

                            <div class="summary mb-sm">

                                <div class="info">
                                    <strong class="amount">Información del Registro</strong>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </section>
        </div>


        <div class="col-xs-12">
            <div class="panel-group" id="accordion">
                <div class="panel panel-accordion tabla-mostrar-datos">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse0" aria-expanded="true">
                                Información del investigador que envía el registro:
                            </a>
                        </h4>
                    </div>
                    <div id="collapse0" class="accordion-body collapse in" aria-expanded="true" style="">
                        <div class="panel-body">

                            <table class="table table-striped">
                                <tr><td><h5><b>Nombre:</b> {{$usuario->nombre}}</h5> </td></tr>
                                <tr><td><h5><b>Apellido:</b> {{$usuario->apellido}}</h5> </td></tr>
                                <tr><td><h5><b>Correo-e:</b> {{$usuario->email}}</h5> </td></tr>




                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-accordion tabla-mostrar-datos">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse1One" aria-expanded="true">
                                Información de la Especie:
                            </a>
                        </h4>
                    </div>
                    <div id="collapse1One" class="accordion-body collapse in" aria-expanded="true" style="">
                        <div class="panel-body">

                            <h5 class="pb-sm">Especie: <b><em>{{$especie}}</em></b> {{$temporal->autor}}</h5>

                            <table class="table table-striped">
                                <tr><td><h5><b>Phylum:</b> {{$temporal->phylum}}</h5> </td></tr>
                                <tr><td><h5><b>Clase:</b> {{$temporal->clase}}</h5> </td></tr>

                                @if($temporal->subclase != null)
                                    <tr><td><h5><b>Sublclase:</b> {{$temporal->subclase}}</h5> </td></tr>
                                @endif

                                <tr><td><h5><b>Orden:</b> {{$temporal->orden}}</h5> </td></tr>


                                <tr><td><h5><b>Familia:</b> {{$temporal->familia}}</h5>  </td></tr>

                                <tr><td><h5><b>Género:</b> {{$temporal->genero}}</h5> </td></tr>
                                <tr><td><h5><b>Epíteto Específico:</b> {{$temporal->especifico}}</h5> </td></tr>

                                @if($temporal->varietal != null)
                                    <tr><td><h5><b>Epíteto Varietal:</b> {{$temporal->varietal}}</h5> </td></tr>
                                @endif

                                @if($temporal->forma != null)
                                    <tr><td><h5><b>Epíteto Forma:</b> {{$temporal->forma}}</h5>  </td></tr>
                                @endif

                                <tr><td><h5><b>Autoridad:</b> {{$temporal->autor}}</h5> </td></tr>


                            </table>
                        </div>
                    </div>
                </div>

                <div class="panel panel-accordion tabla-mostrar-datos">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse2One" aria-expanded="true">
                                Información de la Referencia:
                            </a>
                        </h4>
                    </div>
                    <div id="collapse2One" class="accordion-body collapse in" aria-expanded="true" style="">
                        <div class="panel-body">


                            <h6>Referencia:</h6>
                            <p class="text-md pb-sm">{!! $texto !!}</p>

                            @if($temporal->referencia_tipo == 'R')
                                <table class="table table-striped">
                                    <tr><td><h5><b>Tipo:</b></h5> REVISTA</td></tr>
                                    <tr><td><h5><b>Autores:</b></h5> {{$referencia->autores}}</td></tr>
                                    <tr><td><h5><b>Año:</b></h5> {{$referencia->fecha}}</td></tr>
                                    <tr><td><h5><b>Título:</b></h5> {{$referencia->titulo}}</td></tr>
                                    <tr><td><h5><b>Nombre:</b></h5> {{$referencia->nombre}}</td></tr>

                                    <tr><td><h5><b>Volumen:</b></h5> {{$referencia->volumen}}</td></tr>

                                    <tr><td><h5><b>Número:</b></h5> {{$referencia->numero}}</td></tr>
                                    <tr><td><h5><b>Páginas:</b></h5> {{$referencia->intervalo}}</td></tr>

                                    <tr><td><h5><b>ISBN:</b></h5> {{$referencia->isbn}}</td></tr>
                                    <tr><td><h5><b>ISSN:</b></h5> {{$referencia->issn}}</td></tr>
                                    <tr><td><h5><b>DOI:</b></h5> {{$referencia->enlace}}</td></tr>
                                    <tr><td><h5><b>Enlace:</b></h5> {{$referencia->archivo}}</td></tr>
                                    <tr><td><h5><b>Archivo:</b></h5> {{$referencia->archivo}}</td></tr>
                                    <tr><td><h5><b>Comentarios:</b></h5> {{$referencia->comentarios}}</td></tr>
                                </table>
                            @endif

                            @if($temporal->referencia_tipo == 'L')

                                <table class="table table-striped">
                                    <tr><td><h5><b>Tipo:</b></h5> LIBRO</td></tr>
                                    <tr><td><h5><b>Autores:</b></h5> {{$referencia->autores}}</td></tr>
                                    <tr><td><h5><b>Año:</b></h5> {{$referencia->fecha}}</td></tr>
                                    <tr><td><h5><b>Título:</b></h5> {{$referencia->titulo}}</td></tr>

                                    @if($referencia->editor != null)
                                        <tr><td><h5><b>Editor:</b></h5> {{$referencia->editor}}</td></tr>
                                        @if($referencia->capitulo != null)
                                            <tr><td><h5><b>Capítulo:</b></h5> {{$referencia->capitulo}}</td></tr>
                                            <tr><td><h5><b>Intervalo de páginas:</b></h5> {{$referencia->intervalo}}</td></tr>
                                        @endif
                                    @endif

                                    @if($referencia->edicion != null)
                                    <tr><td><h5><b>Edición:</b></h5> {{$referencia->editorial}}</td></tr>
                                    @endif

                                    @if($referencia->editorial != null)
                                    <tr><td><h5><b>Editorial:</b></h5> {{$referencia->editorial}}</td></tr>
                                    @endif

                                    <tr><td><h5><b>Lugar:</b></h5> {{$referencia->lugar}}</td></tr>
                                    <tr><td><h5><b>Páginas:</b></h5> {{$referencia->paginas}}</td></tr>
                                    <tr><td><h5><b>ISBN:</b></h5> {{$referencia->isbn}}</td></tr>
                                    <tr><td><h5><b>DOI:</b></h5> {{$referencia->enlace}}</td></tr>
                                    <tr><td><h5><b>Enlace:</b></h5> {{$referencia->archivo}}</td></tr>
                                    <tr><td><h5><b>Archivo:</b></h5> {{$referencia->archivo}}</td></tr>
                                    <tr><td><h5><b>Comentarios:</b></h5> {{$referencia->comentarios}}</td></tr>


                                </table>
                            @endif

                            @if($temporal->referencia_tipo == 'T')
                                <table class="table table-striped">
                                    <tr><td><h5><b>Tipo:</b></h5> TRABAJO ACADÉMICO</td></tr>

                                    <tr><td><h5><b>Trabajo:</b></h5> {{$referencia->tipo}}</td></tr>
                                    <tr><td><h5><b>Autores:</b></h5> {{$referencia->autores}}</td></tr>
                                    <tr><td><h5><b>Año:</b></h5> {{$referencia->fecha}}</td></tr>

                                    <tr><td><h5><b>Título:</b></h5> {{$referencia->titulo}}</td></tr>
                                    <tr><td><h5><b>Institución:</b></h5> {{$referencia->institucion}}</td></tr>
                                    <tr><td><h5><b>Lugar:</b></h5> {{$referencia->lugar}}</td></tr>
                                    <tr><td><h5><b>Páginas:</b></h5> {{$referencia->paginas}}</td></tr>

                                    <tr><td><h5><b>Enlace:</b></h5> {{$referencia->archivo}}</td></tr>
                                    <tr><td><h5><b>Archivo:</b></h5> {{$referencia->archivo}}</td></tr>
                                    <tr><td><h5><b>Comentarios:</b></h5> {{$referencia->comentarios}}</td></tr>
                                </table>
                            @endif

                        </div>
                    </div>
                </div>

            </div>

        </div>




        <div class="col-xs-12">

            <div class="panel">
                <div class="panel-body">

                    <div class=" mb-md tabla-mostrar-datos ">
                        <h4 class="">Sinonimias: </h4>
                    </div>

                    <table id="datatable"  class="table table-hover table-striped table-bordered listas-resultados" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="numeros-dataTabla">N°</th>
                            <th class="numeros-dataTabla">id</th>
                            <th class="th-dataTable ">Nombre Sinonimia</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($sinonimias as $sinonimia)

                            <tr>
                                <td></td>
                                <td></td>

                                <td class="perfil">
                                        <span>{{$sinonimia}}</span>
                                </td>



                            </tr>
                        @endforeach
                        </tbody>

                    </table>

                </div>

            </div>
        </div>


        <div class="col-xs-12">

            <div class="panel">
                <div class="panel-body">

                    <div class=" mb-md tabla-mostrar-datos ">
                        <h4 class="">Ubicaciones donde se reporto: </h4>
                    </div>
                    
                    <table id="datatable2"  class="table table-hover table-striped table-bordered listas-resultados" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="numeros-dataTabla">N°</th>
                            <th class="numeros-dataTabla">id</th>
                            <th class="th-dataTable ">Entidad Federal</th>
                            <th class="th-dataTable ">Localidad</th>
                            <th class="th-dataTable ">Lugar</th>
                            <th class="th-dataTable ">Sitio</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($ubicaciones as $ubicacion)

                            <tr>
                                <td></td>
                                <td></td>

                                <td>{{$ubicacion['entidad'][0]}} ({{$ubicacion['entidad'][1]}},{{$ubicacion['entidad'][2]}})</td>
                                <td>
                                    @if($ubicacion['localidad'] != null)
                                        {{$ubicacion['localidad'][0]}} ({{$ubicacion['localidad'][1]}},{{$ubicacion['localidad'][2]}})
                                        @endif
                                </td>
                                <td>

                                    @if($ubicacion['lugar'] != null)
                                        {{$ubicacion['lugar'][0]}} ({{$ubicacion['lugar'][1]}},{{$ubicacion['lugar'][2]}})
                                    @endif
                                </td>
                                <td>
                                     @if($ubicacion['sitio'] != null)
                                        {{$ubicacion['sitio'][0]}} ({{$ubicacion['sitio'][1]}},{{$ubicacion['sitio'][2]}})
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                        </tbody>

                    </table>

                </div>

            </div>
        </div>


    </div>




@stop

@section('script_section')
    @parent
    <script>


        //        console.log(localidades);

    </script>
    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-validation/jquery.validate.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-validation/additional-methods.min.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/jquery.dataTables.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/dataTables.bootstrap.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/datatable/config.datatable.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/examples.modals.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/registros/mis-registros/taxonomia/listados-taxonomia-usuario.js')}}'></script>

    <script>


        var table = $('#datatable2').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ filas por página",
                "search": "Buscar",
                "zeroRecords": "Disculpe, no se encontró ninguno.",
                "info": "Página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "paginate": {
                    "previous": "Anterior",
                    "next": "Siguiente"
                }
            },
            "pageLength": 15,
            "lengthMenu": [ 5,10,15, 25, 50, 75, 100 ],
            "columnDefs": [
                {
                    "visible":false,
                    "targets": 1
                },
                {
                    "searchable": false,
                    "orderable": false,
                    "targets":[0, -1]
                }

            ],
            "order": [[ 2, 'asc' ]]
        });

        //Esconde la columna de los ids
        //table.column(1).visible( false );

        //Numeracion de filas de la tabla
        table.on( 'order.dt search.dt', function () {
            table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        }).draw();


    </script>
@stop


