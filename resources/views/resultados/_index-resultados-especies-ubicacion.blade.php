<div class="row">
    <div class="col-md-12 ">
        <section class="panel panel-featured-bottom panel-featured-primary">
            <div class="panel-body">
                <div class="widget-summary">

                    <div class="widget-summary-col">
                        <div class="summary mb-sm">
                            <div class="info">

                                @yield('ubicacion-tipo'): <b class="amount">@yield('ubicacion-nombre')</b>

                            </div>
                        </div>
                        <div class="summary-footer">
                            @yield('ubicacion-superior')
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <div class="col-xs-12">

        <div class="panel">
            <div class="panel-body">

                @yield('total')

                <h5 class="mt-md ">Total de <b>Especie</b> que pertenecen @yield('pertenece') <b class="text-primary">@yield('ubicacion-nombre')</b>: <b>{{$total}}</b></h5>

                <hr class="dotted short">

                <ul class="opciones mb-md mt-md">
                    <li><a class="dp-in-b" href="{{route('buscar.index')}}"><i class="fa fa-search"></i>Nueva Búsqueda</a></li>
                </ul>

                <table id="datatable"  class="table table-hover table-striped table-bordered listas-resultados" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="numeros-dataTabla">#</th>
                        <th class="th-dataTable ">Nombre de la Especie</th>
                    </tr>
                    </thead>

                    <tbody>
                    @yield('content-tabla')
                    </tbody>

                </table>


            </div>

        </div>
    </div>
</div>