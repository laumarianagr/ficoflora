<div class="row">
    <div class="col-md-12 ">
        <section class="panel panel-featured-bottom panel-featured-primary">
            <div class="panel-body">
                <div class="widget-summary">

                    <div class="widget-summary-col">
                        <div class="summary mb-sm">
                            <div class="info">

                                <h3>@yield('taxo-tipo'): <em><b class="amount">@yield('taxo-nombre')</b></em></h3>

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


                @yield('total')
                <h5 class="mt-md ">Total de <b>@yield('taxo-listar')</b> que pertenecen @yield('pertenece') <em><b class="text-primary">@yield('taxo-nombre')</b></em>: <b>{{$total}}</b></h5>

                <hr class="dotted short">

                <ul class="opciones mb-md mt-md">
                    <li><a class="dp-in-b" href="{{route('buscar.index')}}"><i class="fa fa-search"></i>Nueva Búsqueda</a></li>
                </ul>

                <table id="datatable"  class="table table-hover table-striped table-bordered listas-resultados" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="numeros-dataTabla">#</th>
                        <th class="th-dataTable ">Nombre de @yield('taxo-listar-nombre')</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($especies as $especie)

                        <tr>
                            <td ></td>

                            <td class="perfil">

                                <a href="{{route('especie.index', [$especie['id']])}}">
                                    <em>{{$especie['genero']}} {{$especie['especifico']}}</em>

                                    @if($especie['varietal'] != null)
                                        <em>var. {{$especie['varietal']}}</em>
                                    @endif

                                    @if($especie['forma'] != null)
                                        <em>f. {{$especie['forma']}}</em>
                                    @endif

                                    <span class="autores">{{$especie['autor']}}</span>

                                </a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>

                </table>






            </div>

        </div>
    </div>
</div>