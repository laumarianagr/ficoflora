@extends('master')

@section('title')

@stop

@section('css_section')
    @parent

@stop


@section('titulo-seccion')
    Perfil del Usuario
@stop

@section('breadcrumbs')
    <li><a href="#"><span>Usuario</span></a></li>
    <li><a href="#"><span>Perfil</span></a></li>
@stop


@section('content')



    <div class="col-md-5 col-lg-4">

        <section class="panel">
            <div class="panel-body">
                <div class="thumb-info mb-md">
                    <img src="{{ asset($foto)}}" class="rounded img-responsive" alt="John Doe">
                    <div class="thumb-info-title">
                        <span class="thumb-info-inner">{{$usuario->usuario}} </span>
                        <span class="thumb-info-type">{{$perfil->tipo}}</span>
                    </div>
                </div>

                <div class="widget-toggle-expand mb-md">
                    <div class="widget-header">
                        <h4>Información</h4>
                        {{--<div class="widget-toggle">+</div>--}}
                    </div>
                    {{--<div class="widget-content-collapsed">--}}
                    {{--</div>--}}
                    <div class="widget-content-expanded">
                        <ul class="nav nav-main">
                            <li>
                                <i class="fa fa-user"></i> <span> {{$usuario->nombre}} {{$usuario->apellido}}</span>
                            </li>
                            <li>
                                <i class="fa fa-envelope-o"></i>  <span> {{$usuario->email}}</span>
                            </li>
                        </ul>

                    </div>
                </div>

                <hr class="dotted short">

                <h6 class="text-muted">Descripción</h6>
                @if($usuario->descripcion != null)
                    <p>{{$usuario->descripcion}}</p>
                {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis vulputate quam. Interdum et malesuada</p>--}}
                @endif
                <hr class="dotted short">

                {{--<div class="social-icons-list">--}}
                    {{--<a rel="tooltip" data-placement="bottom" href="http://www.twitter.com" data-original-title="Twitter"><i class="fa fa-twitter"></i><span>Twitter</span></a>--}}
                    {{--<a rel="tooltip" data-placement="bottom" href="http://www.linkedin.com" data-original-title="Linkedin"><i class="fa fa-linkedin"></i><span>Linkedin</span></a>--}}
                {{--</div>--}}

            </div>
        </section>






    </div>
@stop

@section('script_section')
    @parent
    <script>

    </script>
@stop
