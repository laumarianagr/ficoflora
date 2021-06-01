

<div id="modal-mapa" class="zoom-anim-dialog modal-block mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h4 class="panel-title" style="font-size: 13px;">Reportes en Venezuela de la especie:</h4>
            <h4 class="panel-title" style="font-size: 16px;">@yield('especie-mapa')</h4>
        </header>


        <div class="panel-body">
            <div class="modal-wrapper">
                <div class="modal-text">

                    <div id="map" class="sidebar-map map"></div>

                    <!-- sidebar content via HTML markup -->
                    <div id="sidebar" class="leaflet-sidebar collapsed">

                        <!-- nav tabs -->
                        <div class="leaflet-sidebar-tabs">
                            <!-- top aligned tabs -->
                            <ul role="tablist">
                                <li><a href="#home" title="leyenda" role="tab"><i class="fa fa-info"></i></a></li>
                                <li><a href="#capas" title="capas" role="tab"><img style="width: 20px; " src="{{ asset('img/layer.png')}}"></a></li>
                                <li style=" height: 30%;"><a href="" role="tab" title="Zoom"><div id="zoom" style="padding-left: 15%;"></div></a></li>
                                <li><a href="#comments" title="comentarios" role="tab"><i class="fa fa-edit" style="font-size:22px"></i></a></li>
                                <li><a href="#route" role="tab" title="Calcular Ruta" target="_blank"><img style="width: 20px; " src="{{ asset('img/route.png')}}"></a></li>
                                <li><a href="#share" role="tab" title="Compartir" target="_blank"><i class="fa fa-share"></i></a></li>
                                <li><a href="" role="tab" title=""><div id="print" style="padding-left: 15%;"></div></a></li>

                            </ul>

                            <!-- bottom aligned tabs -->
                            <!--<ul role="tablist">
                                <li><a href="https://github.com/nickpeihl/leaflet-sidebar-v2"><i class="fa fa-github"></i></a></li>
                            </ul>-->
                        </div>

                        <!-- panel content -->
                        <div class="leaflet-sidebar-content">
                            <div class="leaflet-sidebar-pane" id="home">
                                <h1 class="leaflet-sidebar-header">
                                    Leyenda del mapa
                                    <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
                                </h1><br>
                                <h3 class="display-4 text-center">@yield('especie-mapa')</h3>

                                
                                @if($portada==null)
                                    <img style="width: 150px; border-radius: 4px; float: left; padding-right: 10px;" src="{{ asset('img/sin-imagen.png')}}" alt="sin imagen disponible">
                                @else
                                    <img style="width: 150px; border-radius: 4px; float: left; padding-right: 10px;" src="{{ asset('../../galeria/'.$portada->imagen.'.jpg')}}" alt="" />
                                @endif    
                                @foreach($pruebas as $info) 
                                    <p class="lorem">{{$info->informacion}}</p>
                                @endforeach 
                                <p>{{$especie['autor']}}</p>    
                 
                            </div>

                            <div class="leaflet-sidebar-pane" id="capas">
                                <h1 class="leaflet-sidebar-header">
                                    Capas de Información
                                    <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
                                </h1>
                                </br>
                                <div id="controlL">
                                    
                                </div>                              
                            </div>

                            <div class="leaflet-sidebar-pane" id="comments">
                                <h1 class="leaflet-sidebar-header">
                                    Comentarios 
                                    <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
                                </h1>
                                </br></br>
                                <div class="col-sm-12">
                                    <form class="col-sm-12" name="notes" method="post">
                                        <!--<label for="long"></label><br>-->
                                        
                                            <input class="col-sm-12" type="text" name="long" id="long" value="Longitud"></br>

                                            <label for="lat"></label><br>
                                            <input class="col-sm-12" type="text" name="lat" id="lat" value="Latitud"></br>

                                            <label for="notes"></label><br>
                                            <input class="col-sm-12" type="text" name="notes" id="notes" value="Nota o Comentario"><br><br>
                                            <input type="button" value="Comentar" id="btn" onclick="getdata()">
                                        
                                    </form>
                                </div>    
                                  
                            </div>

                            <div class="leaflet-sidebar-pane" id="route">
                                <h1 class="leaflet-sidebar-header">
                                    Calculo de Rutas
                                    <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
                                </h1>
                                </br></br>
                                 <div id="controlR">
                                    
                                </div> 
                              
                            </div>

                            <div class="leaflet-sidebar-pane" id="share">
                                <h1 class="leaflet-sidebar-header">
                                    Compartir Ubicación
                                    <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
                                </h1>
                                </br></br>
                                <div class="share">
                                    <button class="col-sm-6"><a href="https://twitter.com/share?text=Consultando%20el%20Catálogo%20digital%20Ficoflora%20Venezuela%20http://www.ciens.ucv.ve/ficofloravenezuela/public/especie{{$especie['id']}}#modal-mapa" title="twitter" target="_blank"><i class="fa fa-twitter-square" style="font-size:36px; color: black"></i></a></button>
                                    <button class="col-sm-6"><a href="https://www.facebook.com/sharer/sharer.php?u=http://www.ciens.ucv.ve/ficofloravenezuela/public/especie/{{$especie['id']}}#modal-mapa" title="facebook" target="_blank"><i class="fa fa-facebook-square" style="font-size:36px; color: black"></i></a></button>
                                </div>                                  
                            </div>                           

                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button onclick="document.getElementById('controlR').innerHTML=''" class="btn btn-default modal-dismiss">Cerrar</button>
                </div>
            </div>
        </footer>

    </section>
</div>
