<div class="row">
    <div class="col-md-12 ">
        <section class="panel panel-featured-bottom panel-featured-primary">
            <div class="panel-body">
                <div class="widget-summary">

                    <div class="widget-summary-col">
                        <div class="pdf-img">
                            @yield('ruta-pdf')
                            <img src="{{ asset('img/pdf.png')}}" class="" alt="Exportar">
                            </a>
                        </div>
                        <div class="summary mb-sm">
                            <div class="info">
                                <b class="amount">@yield('taxo-nombre')</b>
                            </div>
                        </div>
                        <div class="summary-footer">
                            @yield('taxo-superior')
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <div class="col-xs-12">

        <div class="panel">
            <div class="panel-body">

                <div class="row mb-md ">
                    <div class="col-md-8">
                        <h5 class="">@yield('listar') <b class="text-primary">{{$total}}</b></h5>
                    </div>
                    <div class="col-md-4 nueva-busqueda">
                        <a class="dp-in-b" href="{{route('buscar.index')}}"><i class="fa fa-search"></i>Nueva búsqueda</a>
                    </div>
                </div>
                <hr class="dotted short mb-lg mt-sm">

                <table id="datatable"  class="table table-hover table-striped table-bordered listas-resultados" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="numeros-dataTabla">N°</th>
                        <th class="th-dataTable ">Nombre @yield('taxo-listar')</th>
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