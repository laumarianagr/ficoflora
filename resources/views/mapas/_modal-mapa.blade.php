<div id="modal-mapa" class="zoom-anim-dialog modal-block mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h4 class="panel-title" style="font-size: 13px;">Ubicación en Venezuela de la especie:</h4>
            <h4 class="panel-title" style="font-size: 16px;">@yield('especie-mapa')</h4>
        </header>


        <div class="panel-body">
            <div class="modal-wrapper">
                <div class="modal-text">

                    <div id="map"></div>


                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">

                    <button class="btn btn-default modal-dismiss">Cerrar</button>

                </div>
            </div>
        </footer>

    </section>
</div>