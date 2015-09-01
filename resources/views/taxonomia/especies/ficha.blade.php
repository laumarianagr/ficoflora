@extends('master')

@section('title')

@stop

@section('css_section')
    @parent

@stop

@section('content')

    <div class="col-xs-3 col-xlg-2 col-xlg-offset-1">

        <section class="panel">
            <div class="panel-body">
                <div class="thumb-info mb-md">
                    <img src="{{ asset('img/!logged-user.jpg')}}" class="rounded img-responsive" alt="John Doe">

                </div>


                <ul class="opciones">
                    <li><a href=""><i class="fa fa-map-marker"></i>Ubicación en Venezuela </a></li>
                    <li><a><i class="fa fa-picture-o"></i>Galería </a></li>
                    <li><a href="{{route('genero.especies', [$mi_especie['genero_id']])}}"><i class="fa fa-list-ul"></i>Especies del género </a></li>
                </ul>


                <hr class="dotted short">

                @if(!empty($sinonimias))

                    <section class="panel ">
                        <div class="bg-dark p-sm ">
                         <h4 class="m-none">Sinónimos</h4>
                        </div>
                    </section>

                    <ul class="pl-lg">
                        @foreach($sinonimias as $sinonimia)
                            <li class="text-dark"><a class="text-dark" href="">{{$sinonimia['nombre']}}</a></li>
                        @endforeach
                    </ul>
                    <hr class="dotted short">

                @endif


                <ul class="opciones">
                    <li><a href=""><i class="fa fa-search"></i>Nueva Búsqueda</a></li>
                </ul>



            </div>
        </section>

    </div>
    <div class="col-xs-9 col-xlg-8">

        <div class="row">
            <div class="col-md-12 ">
                <section class="panel panel-featured-bottom panel-featured-primary">
                    <div class="panel-body">
                        <div class="widget-summary">

                            <div class="widget-summary-col">
                                <div class="summary mb-sm">
                                    <div class="info">
                                        <strong class="amount"><em>{{$especie['genero']}} {{$especie['especifico']}}</em></strong>

                                        <strong class="amount">
                                            @if($especie['varietal'] != null)
                                                var. <em>{{$especie['varietal']}}</em>
                                            @endif
                                        </strong>

                                        <strong class="amount">
                                            @if($especie['forma'] != null)
                                                f. <em>{{$especie['forma']}}</em>
                                            @endif
                                        </strong>

                                        <a class="text-primary">{{$especie['autor']}}</a>

                                    </div>
                                </div>
                                <div class="summary-footer">
                                    <span class="text-muted">Phylum:</span> <a class="text-primary">{{$especie['phylum']}} <i class="fa fa-angle-right text-muted"></i></a>
                                    <span class="text-muted">Clase:</span> <a class="text-primary">{{$especie['clase']}} <i class="fa fa-angle-right text-muted"></i></a>
                                    @if($especie['subclase'] != null)
                                        <span class="text-muted">Sublclase:</span> <a class="text-primary">{{$especie['subclase']}} <i class="fa fa-angle-right text-muted"></i></a>
                                    @endif
                                    <span class="text-muted">Orden:</span> <a class="text-primary">{{$especie['orden']}} <i class="fa fa-angle-right text-muted"></i></a>
                                    <span class="text-muted">Familia:</span> <a class="text-primary">{{$especie['familia']}}</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div>


        <div class="row">
            <div class="col-md-12">


                <div class="panel-group" id="accordion">

                <div class="panel panel-accordion">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1Two">
                                    Especie reportada en
                                </a>
                            </h4>
                        </div>
                        <div id="collapse1Two" class="accordion-body collapse in">
                            <div class="panel-body">

                                @foreach($referencias as $referencia)

                                    <section class="panel panel-featured-left panel-featured-primary ficha-reportes">

                                        <div class="panel-body reportado-en">
                                            <div class="widget-summary">

                                                <div class="widget-summary-col">
                                                    <div class="summary">
                                                        <h4 class="m-none">{{ $referencia['cita']}}, {{$referencia['fecha']}}</h4>

                                                    </div>

                                                    <div class="summary-footer ">


                                                        @foreach($referencia['reportes'] as $reporte)

                                                        <div class="reportado-ubicacion">

                                                            @if(!empty($reporte['sinonimia']))
                                                                <h6 class="reportado-sinonimia">como: <em><b>{{$reporte['sinonimia']['nombre']}}</b></em> <small> {{$reporte['sinonimia']['autor']}}</small></h6>
                                                            @endif


                                                            @if(!empty($reporte['ubicaciones']))

                                                                <ul>
                                                                    @foreach($reporte['ubicaciones'] as $ubicacion)
                                                                        <li>
                                                                            {{$ubicacion['entidad']}},

                                                                            @if($ubicacion['localidad']!= null)
                                                                                {{$ubicacion['localidad']}}

                                                                                @if(!empty($ubicacion['lugares']))
                                                                                    @foreach($ubicacion['lugares'] as $lugar)
                                                                                        <span class="reporte-lugar">{{$lugar['lugar']}}

                                                                                            @if(!empty($lugar['sitios']))
                                                                                                @foreach($lugar['sitios'] as $sitio)
                                                                                                   <span class="reporte-sitio">{{$sitio}}</span>
                                                                                               @endforeach
                                                                                            @endif

                                                                                        </span>
                                                                                    @endforeach
                                                                                @endif

                                                                            @endif

                                                                        </li>
                                                                    @endforeach
                                                                </ul>

                                                            @endif
                                                        </div>

                                                        @endforeach




                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>



                                @endforeach




                            </div>
                        </div>
                    </div>
                <div class="panel panel-accordion">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#galeria">
                                   Galería
                                </a>
                            </h4>
                        </div>
                        <div id="galeria" class="accordion-body collapse">
                            <div class="panel-body">
                                Donec tellus massa, tristique sit amet condimentum vel, facilisis quis sapien.
                            </div>
                        </div>
                    </div>
                <div class="panel panel-accordion">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1Three">
                                    Referencias Bibliográficas
                                </a>
                            </h4>
                        </div>
                        <div id="collapse1Three" class="accordion-body collapse">
                            <div class="panel-body">

                                <ul>
                                    @foreach($bibliografias as $bibliografia)
                                        <li class="mb-xlg">
                                            <h4>{{$bibliografia['cita']}}, {{$bibliografia['fecha']}}</h4>

                                            {!! $bibliografia['referencia'] !!}

                                        </li>
                                    @endforeach
                                </ul>


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

    </script>
@stop
