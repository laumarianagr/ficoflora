@extends('master')

@section('title')

@stop

@section('css_section')
    @parent

@stop

@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <section class="panel panel-featured-bottom panel-featured-primary">
                <div class="panel-body">
                    <div class="widget-summary">

                        <div class="widget-summary-col">
                            <div class="summary mb-sm">
                                <div class="info">
                                    <strong class="amount"><em>{{$taxonomia['genero']}}</em></strong>

                                </div>
                            </div>
                            <div class="summary-footer">
                                <span class="text-muted">Phylum:</span> <a class="text-primary">{{$taxonomia['phylum']}} <i class="fa fa-angle-right text-muted"></i></a>
                                <span class="text-muted">Clase:</span> <a class="text-primary">{{$taxonomia['clase']}} <i class="fa fa-angle-right text-muted"></i></a>
                                @if($taxonomia['subclase'] != null)
                                    <span class="text-muted">Sublclase:</span> <a class="text-primary">{{$taxonomia['subclase']}} <i class="fa fa-angle-right text-muted"></i></a>
                                @endif
                                <span class="text-muted">Orden:</span> <a class="text-primary">{{$taxonomia['orden']}} <i class="fa fa-angle-right text-muted"></i></a>
                                <span class="text-muted">Familia:</span> <a class="text-primary">{{$taxonomia['familia']}}</a>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>


    <div class="col-xs-12">


           <div class="panel">
               <div class="panel-body">

                   <h5 class="mt-md mb-lg">Total de especies que pertenecen al género <em><b class="text-primary">{{$taxonomia['genero']}}</b></em>: <b>{{$total}}</b></h5>

                   <ol class="listas-resultados">
                       @foreach($especies as $especie)

                           <li>
                               <a href="{{route('especie.index', [$especie['id']])}}">
                               <em>{{$especie['genero']}} {{$especie['especifico']}}</em>

                                   @if($especie['varietal'] != null)
                                       var. <em>{{$especie['varietal']}}</em>
                                   @endif

                                   @if($especie['forma'] != null)
                                       f. <em>{{$especie['forma']}}</em>
                                   @endif

                                <span class="autores">{{$especie['autor']}}</span>

                               </a>
                           </li>
                       @endforeach
                   </ol>
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
