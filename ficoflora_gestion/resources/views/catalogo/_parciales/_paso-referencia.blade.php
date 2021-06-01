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
                        <a class="accordion-toggle" data-parent="#accordion_paso_referencia" data-toggle="collapse"  href="#libro_crear">
                            <i class="fa fa-plus"></i> Crear Libro
                        </a>
                    </h4>
                </div>
                <div id="libro_crear" class="accordion-body collapse ">
                    <div class="panel-body ">
                        @include('bibliograficos.referencias._parciales._libro-formulario')



                    </div>
                </div>
            </div>
            <div class="panel panel-accordion ">
                <div class="panel-heading dark">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-parent="#accordion_paso_referencia" data-toggle="collapse"  href="#revista_crear">
                            <i class="fa fa-plus"></i> Crear Revista
                        </a>
                    </h4>
                </div>
                <div id="revista_crear" class="accordion-body collapse ">
                    <div class="panel-body ">

                        @include('bibliograficos.referencias._parciales._revista-formulario')


                    </div>
                </div>
            </div>
            <div class="panel panel-accordion ">
                <div class="panel-heading dark">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-parent="#accordion_paso_referencia" data-toggle="collapse"  href="#trabajo_crear">
                            <i class="fa fa-plus"></i> Crear Trabajo
                        </a>
                    </h4>
                </div>
                <div id="trabajo_crear" class="accordion-body collapse ">
                    <div class="panel-body ">
                        @include('bibliograficos.referencias._parciales._trabajos-form')



                    </div>
                </div>
            </div>



        </div>

    </div>
</div>
