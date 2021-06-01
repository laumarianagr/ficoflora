<div class="row">

    <div class="col-xs-12">
        <div class="panel-group" id="accordion_paso_referencia">

            {{--<div class="panel panel-accordion ">--}}
                {{--<div class="panel-heading dark">--}}
                    {{--<h4 class="panel-title">--}}
                        {{--<a class="accordion-toggle" data-parent="#accordion_paso_referencia" data-toggle="collapse"  href="#referencia_busqueda">--}}
                            {{--<i class="fa fa-search"></i> Buscar Referencia--}}
                        {{--</a>--}}
                    {{--</h4>--}}
                {{--</div>--}}
                {{--<div id="referencia_busqueda" class="accordion-body collapse">--}}
                    {{--<div class="panel-body ">--}}



                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{-- CREAR REFERENCIA--}}

            <div class="panel panel-accordion ">
                <div class="panel-heading dark">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-parent="#accordion_paso_referencia" data-toggle="collapse"  href="#referencia_crear">
                            <i class="fa fa-plus"></i> Crear Referencia
                        </a>
                    </h4>
                </div>
                <div id="referencia_crear" class="accordion-body collapse in">
                    <div class="panel-body ">


                        <div class="tabs pt-sm">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_libro" data-toggle="tab">Libro</a>
                                </li>
                                <li >
                                    <a href="#tab_revista" data-toggle="tab">Revista</a>
                                </li>
                                <li>
                                    <a href="#tab_trabajo" data-toggle="tab">Trabajo Académico</a>
                                </li>
                                {{--<li>--}}
                                    {{--<a href="#tab_enlace" data-toggle="tab">Enlace Web</a>--}}
                                {{--</li>--}}
                            </ul>
                            <div class="tab-content" ng-app="myApp" ng-controller="citaCtrl">
                                <div id="tab_libro"  class="tab-pane active">
                                    @include('bibliograficos.referencias._parciales._libro-formulario')
                                </div>

                                <div id="tab_revista" class="tab-pane ">
                                    @include('bibliograficos.referencias._parciales._revista-formulario')
                                </div>

                                <div id="tab_trabajo" class="tab-pane">
                                    @include('bibliograficos.referencias._parciales._trabajos-form')
                                </div>

                                {{--<div id="tab_enlace" class="tab-pane">--}}
                                    {{--@include('bibliograficos.referencias._parciales._enlace-form')--}}
                                {{--</div>--}}


                                <div class="dp-none" id="clean"></div>

                            </div>


                        </div>


                    </div>
                </div>
            </div>



        </div>

    </div>
</div>
