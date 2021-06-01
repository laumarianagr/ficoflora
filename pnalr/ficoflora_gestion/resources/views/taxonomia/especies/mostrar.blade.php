@extends('master')

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/magnific-popup/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/fancybox/jquery.fancybox.css')}}">
@stop
@section('titulo-seccion')
    Información de la Especie
@stop

@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>
    <li><a href="#"><span>Especies</span></a></li>

@stop

@section('registro-quitar')
    la sinonimia?
@stop

@section('content')
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />


    <div class="row">
        <div class="col-md-12 mostrar-cabecera">
            <section class="panel panel-featured-left panel-featured-primary">
                <div class="panel-body">
                    <div class="widget-summary">

                        <div class="widget-summary-col">


                            <div class="summary mb-sm">

                                <div class="info">
                                    <span class="muted">Especie:</span> <strong class="amount"><em>{{$especie['genero']}} {{$especie['especifico']}}</em></strong>

                                    <strong class="amount">
                                        @if($especie['varietal'] != null)
                                            <em>var. {{$especie['varietal']}}</em>
                                        @endif
                                    </strong>

                                    <strong class="amount">
                                        @if($especie['forma'] != null)
                                            <em> f. {{$especie['forma']}}</em>
                                        @endif
                                    </strong>

                                    <a href="{{route('autor.mostrar', [$especie['autor_id']])}}" class="text-primary">{{$especie['autor']}}</a>


                                </div>
                            </div>
                            @if($usuario->perfil_id <=3)

                            <div class="summary-footer">
                                <a class="" href="{{route('usuario.especies')}}"><i class="fa fa-user pr-xs"></i>Mis especies</a>

                                @if($especie['creador_id'] == $usuario->id || $usuario->perfil_id <=2)
                               | <a href="{{route('especie.editar', [$especie['id']])}}"><i class="fa fa-pencil pr-xs"></i>Editar </a>
                                @endif

                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </section>
        </div>


    </div>




    <div class="panel-group" id="accordion">
        <div class="panel panel-accordion tabla-mostrar-datos">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse1One" aria-expanded="true">
                        Elementos del Nombre:
                    </a>
                </h4>
            </div>
            <div id="collapse1One" class="accordion-body collapse in" aria-expanded="true" style="">
                {{--<div class="panel-body">--}}

                    {{--<section class="panel tabla-mostrar-datos ">--}}
                        <div class="panel-body">
                            {{--<h4 class="">Elementos del Nombre:</h4>--}}

                            <table class="table table-striped">
                                <tr><td><h5><b>Género:</b></h5> <a class="text-muted" href="{{route('genero.mostrar', [$especie['genero_id']])}}">{{$especie['genero']}}</a></td></tr>
                                <tr><td><h5><b>Epíteto Específico:</b></h5> <a class="text-muted" href="{{route('especifico.mostrar', [$especie['especifico_id']])}}"class="text-muted">{{$especie['especifico']}}</a></td></tr>

                                @if($especie['varietal'] != null)
                                    <tr><td><h5><b>Epíteto Varietal:</b></h5> <a class="text-muted" href="{{route('varietal.mostrar', [$especie['varietal_id']])}}">{{$especie['varietal']}}</a></td></tr>
                                @endif

                                @if($especie['forma'] != null)
                                    <tr><td><h5><b>Epíteto de Forma:</b></h5> <a class="text-muted" href="{{route('forma.mostrar', [$especie['forma_id']])}}">{{$especie['forma']}} </a> </td></tr>
                                @endif

                                <tr><td><h5><b>Autoridad:</b></h5> <a class="text-muted" href="{{route('autor.mostrar', [$especie['autor_id']])}}">{{$especie['autor']}}</a></td></tr>


                            </table>
                        </div>
                    {{--</section>--}}

                {{--</div>--}}
            </div>
        </div>
        <div class="panel panel-accordion tabla-mostrar-datos">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse2One" aria-expanded="true">
                        Árbol Taxonómico:
                    </a>
                </h4>
            </div>
            <div id="collapse2One" class="accordion-body collapse in" aria-expanded="true" style="">
                <div class="panel-body">


                    <table class="table table-striped">
                        <tr><td><h5><b>Phylum:</b></h5> <a class="text-muted" href="{{route('phylum.mostrar', [$especie['phylum_id']])}}">{{$especie['phylum']}} </a></td></tr>
                        <tr><td><h5><b>Clase:</b></h5> <a class="text-muted" href="{{route('clase.mostrar', [$especie['clase_id']])}}">{{$especie['clase']}} </a></td></tr>

                        @if($especie['subclase'] != null)
                            <tr><td><h5><b>Sublclase:</b></h5> <a class="text-muted" href="{{route('subclase.mostrar', [$especie['subclase_id']])}}">{{$especie['subclase']}} </a></td></tr>
                        @endif

                        <tr><td><h5><b>Orden:</b></h5> <a class="text-muted" href="{{route('orden.mostrar', [$especie['orden_id']])}}">{{$especie['orden']}}  </a></td></tr>


                        <tr><td><h5><b>Familia:</b></h5> <a class="text-muted" href="{{route('familia.mostrar', [$especie['familia_id']])}}">{{$especie['familia']}}</a> </td></tr>


                    </table>
                </div>
            </div>
        </div>

    </div>

   <div class="row">
       <div class="col-xs-12">

           <div class="panel">
               <div class="panel-body">

                   <div class=" mb-md tabla-mostrar-datos ">
                       <h4 class="">Sinonimias de la Especie: </h4>
                   </div>
                   {{--<a class="agregar-sinonimia modal-with-form btn btn-default" href="#modal-agregar-sinonimia"  id="crear-row" data-toggle="tooltip" title="Agregar" ><i class="fa fa-plus-circle"></i> Agregar Sinonimia</a>--}}
                   {{--<hr class="dotted short">--}}

                   <table id="datatable"  class="table table-hover table-striped table-bordered listas-resultados" cellspacing="0" width="100%">
                       <thead>
                       <tr>
                           <th class="numeros-dataTabla">N°</th>
                           <th class="numeros-dataTabla">id</th>
                           <th class="th-dataTable ">Nombre de la especie</th>
                           {{--<th class="th-dataTable acciones-col">Acciones</th>--}}
                       </tr>
                       </thead>

                       <tbody>
                       @foreach($sinonimias as $sinonimia)

                           <tr>
                               <td></td>
                               <td>{{$sinonimia['id']}}</td>

                               <td class="perfil">
                                   <a href="{{route('sinonimia.mostrar', [$sinonimia['id']])}}">
                                       <em>{{$sinonimia['nombre']}}</em> <span class="autores">{{$sinonimia['autor']}}</span>
                                   </a>
                               </td>

{{--                               <td id="{{$sinonimia['id']}}" class="acciones-row"><a class="quitar-sinonimia modal-basic modal-with-zoom-anim" href="#modal-quitar" ><i class="fa fa-close " data-toggle="tooltip" title="Quitar sinonimia"></i></a></td>--}}

                           </tr>
                       @endforeach
                       </tbody>

                   </table>

                   {{--<a class="-sinonimia modal-basic modal-with-zoom-anim" href="#modal-agregar-sinonimia"  id="crear-row" data-toggle="tooltip" title="Agregar" ><i class="fa fa-plus-circle"></i> Agregar Sinonimia</a>--}}


                   {{--{!! Form::open(['rout' => 'especie.sinonimia.agregar',  'id'=>'jv_sinonimia_select', 'class' => 'form  form-bordered']) !!}--}}

                   {{--<div class="col-sm-9 form-group">--}}
                       {{--<label class=" control-label" for="select_sinonimia">Agregar Sinonimia</label>--}}
                       {{--{!! Form::select('select_sinonimia', $lista_sinonimias, null, ['id'=>'select_sinonimia', 'class' => 'form-control select', 'style'=>'width: 100%' ]) !!}--}}
                   {{--</div>--}}

                   {{--<div class="col-sm-3 form-group">--}}
                       {{--<div class="col-sm-12 pt-xlg">--}}
                           {{--<button id='agregar_sinonimia' class="btn btn-primary form-control">Agregar</button>--}}
                       {{--</div>--}}
                   {{--</div>--}}
                   {{--{!! Form::close() !!}--}}
               </div>

           </div>
       </div>
   </div>


    <div class="row">
        <div class="col-xs-12">

            <div class="panel">
                <div class="panel-body">

                    <div class=" mb-md tabla-mostrar-datos ">
                        <h4 class="">Registros de la Especie: </h4>
                    </div>
                    {{--<a class="agregar-sinonimia modal-with-form btn btn-default" href="#modal-agregar-sinonimia"  id="crear-row" data-toggle="tooltip" title="Agregar" ><i class="fa fa-plus-circle"></i> Agregar Sinonimia</a>--}}
                    {{--<hr class="dotted short">--}}

                    <table id="datatable_2"  class="table table-hover table-striped table-bordered listas-resultados" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="numeros-dataTabla">N°</th>
                            <th class="numeros-dataTabla">id</th>
                            <th class="th-dataTable ">Cita</th>
                            <th class="th-dataTable ">Autores</th>
                            {{--<th class="th-dataTable ">Título</th>--}}
                            <th class="th-dataTable ">Fecha</th>
                            <th class="th-dataTable ">Tipo</th>
                            <th class="th-dataTable acciones-col">Acciones</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($registros as $registro)

                            <tr>
                                <td></td>
                                <td>{{$registro->id}}</td>

                                <td class="perfil">({{$registro->referencia->cita}}, {{$registro->referencia->fecha}}{{$registro->referencia->letra}})</td>
                                <td class="perfil">{{$registro->referencia->autores}}</td>
                                {{--<td class="perfil">{{$registro->referencia->titulo}}</td>--}}
                                <td class="perfil">{{$registro->referencia->fecha}}</td>
                                <td class="perfil">{{$registro->referencia->tipo}}</td>

                                <td class="acciones-row">
                                    <a href="{{route ('reporte.mostrar' ,$registro->id )}}" data-toggle="tooltip" title="Información" ><i class="fa fa-info-circle"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>

                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">

            <div class="panel">
                <div class="panel-body">

                    <div class=" mb-md tabla-mostrar-datos ">
                        <h4 class="">Galería</h4>
                    </div>

                    <div class="galeria_box">



                        @if($imagenes != null)

                        @foreach($imagenes as $imagen)
                            <div class="dp-iblock" id="img-{{$imagen->id}}">
                                <div>
                                    <a id="{{$imagen->id}}" class="eliminar-img  modal-with-zoom-anim" href="#modal-eliminar-img" data-toggle="tooltip" title="" data-original-title="Eliminar"><i class="fa fa-times text-danger"></i></a>

                                </div>
                                <a class="galeria" rel="galeria" href="{{ asset('../../galeria/'.$imagen->imagen.'_z.jpg')}}" title="{{$imagen->leyenda}}">
                                    <img class="img-galeria"  src="{{ asset('../../galeria/'.$imagen->imagen.'.jpg')}}" alt="" />
                                </a>
                            </div>

                        @endforeach
                        @endif


                            <section class="panel mt-xl">


                                @include('errors._listar')

                                {!! Form::open(['route' =>  ['imagen.agregar', $especie['id']],   'id'=>'jv_agregar-img', 'files' => true, 'class' => 'form  form-bordered']) !!}

                                <header class="panel-heading p-xs pl-md">

                                    <h5 class="name" >Agregar nueva imagen </h5>
                                </header>
                                <div class="panel-body">


                                    <div><h5>Versión pequeña</h5></div>

                                    <div class="col-sm-12 form-group">
                                        <div class="form-group ">

                                            {!! Form::file('pequena',  ['id'=>'pequena', 'class' => 'form-control']) !!}


                                        </div>
                                    </div>
                                    <div><h5>Versión completa</h5></div>


                                    <div class="col-sm-12 form-group">
                                        <div class="form-group ">

                                            {!! Form::file('completa',  ['id'=>'completa', 'class' => 'form-control']) !!}


                                        </div>
                                    </div>
                                    <div><h5>Tipo de imagen</h5></div>

                                    <input type="radio" name="tipo" value="h" checked> Principal<br>
                                    <input type="radio" name="tipo" value="g"> Galería<br>


                                    <div class="mt-md"><h5>Leyenda</h5></div>


                                    <div class="col-sm-12 form-group">
                                        <div class="form-group ">
                                            {!! Form::text('leyenda', null, ['id'=>'leyenda','class' => 'form-control ' ]) !!}


                                        </div>
                                    </div>



                                </div>

                                <footer class="panel-footer">
                                    {{--Guardar Form Imput--}}
                                    <div class="form-group">
                                        <div class="col-sm-3 pull-right ">
                                            {!! Form::submit('Agregar', ['id'=>'importar', 'class' => 'btn btn-primary form-control',  'accept'=>"image/jpeg"]) !!}
                                        </div>

                                    </div>

                                </footer>

                                {!! Form::close() !!}


                            </section>

                    </div>
              </div>

            </div>
        </div>
    </div>



    {{--Modal Eliminar--}}
    @include('registros.mis-registros._parciales._modal-quitar')
    @include('registros.mis-registros._parciales._modal-agregar-sinonimia')



        {{--Modal Eliminar--}}
        @include('taxonomia.especies._parciales._modal-eliminar_img')

@stop

@section('script_section')
    @parent
    <script>
        var especie = <?php echo $especie['id']; ?>;

        $(document).ready(function() {
            $("#portada").fancybox({
                openEffect	: 'fade',
                closeEffect	: 'fade',
                helpers : {
                    title : {
                        type : 'inside'
                    }
                }
            });
            $(".galeria").fancybox({
                openEffect	: 'fade',
                closeEffect	: 'fade',
                helpers : {
                    title : {
                        type : 'inside'
                    }
                }
            });
        });

    </script>
    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-validation/jquery.validate.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/jquery.dataTables.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/dataTables.bootstrap.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/datatable/sin-acciones-datatable.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/registros/validate_taxonomia.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/registros/mis-registros/taxonomia/especies-usuario.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/examples.modals.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/taxonomia/especies/procesar_imagenes_galeria.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/fancybox/jquery.fancybox.js')}}'></script>


    <script>

        var select = $("#select_sinonimia").select2({
            placeholder: "Seleccione una opción",
            allowClear: true
        });

        $('.agregar-sinonimia').on('click', function(){
            select.val(null).trigger("change")

        });



        var tabla_2 = $('#datatable_2').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ filas por página",
                "search": "Buscar",
                "zeroRecords": "No hay registros disponibles",
                "info": "Página _PAGE_ de _PAGES_",
                "infoEmpty": "",
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
//                {
//                    "width":'20%',
//                    "targets": 2
//                },
                {
                    "searchable": false,
                    "orderable": false,
                    "targets":[0, -1]
                }

            ],
            "order": [[ 4, 'desc' ]]
        });

        //Esconde la columna de los ids
        //table.column(1).visible( false );

        //Numeracion de filas de la tabla
        tabla_2.on( 'order.dt search.dt', function () {
            tabla_2.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        }).draw();




    </script>

    <script>
        localStorage.setItem("menu", "m-registros");
    </script>
@stop


