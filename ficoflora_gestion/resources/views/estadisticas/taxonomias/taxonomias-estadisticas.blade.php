@extends('master')

@section('titulo-seccion')
    Estadísticas  Taxonómicas
@stop

@section('breadcrumbs')
    <li><a href="{{route('estadisticas.index')}}"><span>Estadísticas</span></a></li>
    <li><a ><span>Taxonómicas</span></a></li>

@stop

@section('css_section')
    @parent

@stop

@section('content')

    <div class="row">

        <div class="col-md-12">

            <section class="panel panel-featured-bottom panel-featured-primary">
                <div class="panel-body">
                    <div class="widget-summary widget-summary-xlg">

                        <div class="widget-summary-col">
                            <div class="summary">
                                <div class="info">
                                    <strong class="amount fz-lg">{{$total}}</strong>
                                </div>
                                <h3 class="text-dark mt-sm mb-none">Elementos taxonómicos registrados</h3>

                            </div>


                        </div>

                    </div>
                </div>
            </section>
        </div>

        @foreach($elementos as $elemento)
            <div class="col-sm-6 col-md-4">
                <section class="panel panel-featured-left panel-featured-primary">
                    <div class="panel-body">
                        <div class="widget-summary">

                            <div class="widget-summary-col">
                                <div class="summary mh-auto">
                                    <div class="info">
                                        <strong class="amount">{{$elemento['total']}}</strong> <h4 class="title dp-inline">{{$elemento['tipo']}}</h4>

                                    </div>

                                </div>
                                <div class="summary-footer">
                                    <a class="" href="{{route('estadisticas.'.$elemento['ruta'])}}"><i class="fa fa-bar-chart pr-xs"></i> Datos</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        @endforeach
    </div>

@stop

@section('script_section')
    @parent
    <script>
        localStorage.setItem("menu", "m-estadisticas");
    </script>
@stop
