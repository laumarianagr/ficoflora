<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <ul class="opciones">
                    <li><h5><a><i class="fa fa-info-circle pr-sm"></i>¿Cómo citar esta página? &nbsp;&nbsp;<i id="copy"  class="fa fa-pencil-square-o" style="vertical-align: bottom;" onclick="copyToClipboard('#p1');" title="clic para copiar referencia"></i></a></h5>
                    </li>
                </ul>

                <p><b>Web Ficoflora Venezuela.</b>  {{Carbon\Carbon::now()->year}}. <b>Catálogo digital de la Ficoflora de Venezuela.</b>
                    Publicación electrónica. Universidad Central de Venezuela, Caracas.
                    Editores: Santiago Gómez, Yusneyi Carballo Barrera, Mayra García & Nelson Gil.
                    Consultado el {{Carbon\Carbon::now()->day}} de {{$mes}} de {{Carbon\Carbon::now()->year}},
                    de <a>http://www.ciens.ucv.ve/ficofloravenezuela</a>
                </p>

            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>  <!-- start: Footer credits -->
                        Proyecto Ficoflora Venezuela © 2015-{{Carbon\Carbon::now()->year}}
                        :: All rights reserved
                    <br />
                    <span style="font-size: 10px;">
                    Con el apoyo: Instituto de Biología Experimental (IBE) | Centro de Enseñanza Asistida por Computador (CENEAC) |
                    Instituto Experimental Jardín Botánico Dr. Tobías Lasser | Instituto Pedagógico de Miranda (IPM UPEL)
                    </span>
                    </p>
                    <br />
                        <!-- start: Stats & visits -->
                        <!-- Begin Shinystat code -->
                        <script type="text/javascript" src="http://codice.shinystat.com/cgi-bin/getcod.cgi?USER=FicofloraVenezu"></script>
                    <noscript>
                        <h6><a href="http://www.shinystat.com">
                                <img src="http://www.shinystat.com/cgi-bin/shinystat.cgi?USER=FicofloraVenezu" alt="Free web stats" style="border:0px" /></a></h6>
                    </noscript>
                    <!-- End Shinystat code -->
                </div>
            </div>
        </div>
    </div>
</footer>