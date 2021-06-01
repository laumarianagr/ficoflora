<div class="row">
    <div class="col-md-12 ">
        <section class="panel panel-featured-bottom panel-featured-primary">
            <div class="panel-body">
                <div class="widget-summary">

                    <div class="widget-summary-col">

                        <div class="pdf-img">
                        </div>
                        <div class="summary mb-sm">
                            <div class="info">
                                <b class="amount">@yield('referencia-tipo')</b>
                            </div>
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
                        <h5 class="">@yield('listar')</h5>
                    </div>
                    <div class="col-md-4 nueva-busqueda">
                        <a class="dp-in-b" href="{{route('buscar.referencias.index')}}"><i class="fa fa-search"></i>Nueva búsqueda</a>
                    </div>
                </div>
                <hr class="dotted short mb-lg mt-sm">

                <tbody>
                <table id="datatable"  class="table table-hover table-striped table-bordered listas-resultados" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <td class="perfil">
                            @yield('content-tabla')
                        </td>
                    </tr>
                </table>
                </tbody>

           </div>

        </div>
    </div>
</div>