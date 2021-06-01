
    <title>SIDEBAR</title>
    <link rel="stylesheet" href="{{ asset('plugins/sidebar/leaflet-sidebar.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('plugins/leaflet/leaflet.css')}}">
    
   <style type="text/css">
       #mapid { height: 180px; }
   </style>

    <p id="demo">Click me to change my HTML content (innerHTML).</p>
    <div id="mapid"></div>
	<div id="sidebar" class="sidebar collapsed">
        <!-- Nav tabs -->
        <div class="sidebar-tabs">
            <ul role="tablist">
                <li><a href="#home" role="tab" title="Leyenda del mapa"><i class="fa fa-info"></i></a></li>
                <li><a href="#profile" role="tab" title="Capas"><i class="fas fa-layer-group"></i></a></li>
                <li><a href="#messages" role="tab" title="Notas y Comentarios"><i class="fas fa-comment"></i></a></li>
                <li style="padding-bottom: 35%;padding-top: 15%"><a href="" role="tab" title="Zoom"><div id="zoom" style="padding-left: 15%;"></div></a></li>
                <li><a href="#share" role="tab" title="Compartir" target="_blank"><i class="fas fa-share"></i></a></li>
                <li><a href="#route" role="tab" title="Calcular Ruta" target="_blank"><i class="fas fa-route"></i></a></li>
            </ul>

            <!--<ul role="tablist">
                <li><a href="#settings" role="tab"><i class="fa fa-gear"></i></a></li>
            </ul>-->
        </div>

        <!-- Tab panes -->
        <div class="sidebar-content">
            <div class="sidebar-pane" id="home">
                <h1 class="sidebar-header">
                    Leyenda del Mapa
                    <span class="sidebar-close"><i class="fa fa-caret-left"></i></span>
                </h1>

                <p>Informacion Extra</p>

                <p class="lorem">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>

               
            </div>

            <div class="sidebar-pane" id="profile">
                <h1 class="sidebar-header">Capas
                	<span class="sidebar-close">
                		<i class="fa fa-caret-left">
                		</i>
                	</span>
                </h1>
                </br>
                <div id="controlL">
                	
                </div>

            </div>

            <div class="sidebar-pane" id="messages">
                <h1 class="sidebar-header">Comentarios<span class="sidebar-close"><i class="fa fa-caret-left"></i></span></h1>
                </br></br>
                <form name="notes" method="post">
					<label for="notes">Notas y Comentarios</label>
					<input type="text" name="notes" id="notes">
					<input type="button" value="Comentar" id="btn" onclick="getdata()">
				</form>
            </div>

            <div class="sidebar-pane" id="share">
                <h1 class="sidebar-header">Compartir<span class="sidebar-close"><i class="fa fa-caret-left"></i></span></h1>
                <br>
                <H1>Compartir Ubicación:</H1>
                <button><a href="https://twitter.com/share" title="twitter" target="_blank"><i class="fa fa-twitter" style="font-size:24px; color: black"></i></a></button>
                <button><a href="https://www.facebook.com/sharer/sharer.php" title="facebook" target="_blank"><i class="fa fa-facebook-official" style="font-size:24px; color: black"></i></a></button>
                <button><a href="" title="Correo" target="_blank"><i class="fas fa-envelope-open-text" style="font-size:24px; color: black"></i></a></button>               	

            </div>

            <div class="sidebar-pane" id="route">
            	<h1 class="sidebar-header">Calcular Ruta<span class="sidebar-close"><i class="fa fa-caret-left"></i></span></h1>
            	<p>Distancia (m): <span id="distance"></span></p> 

            </div>

        </div>
    </div>

<!-- SIDE BAR END -->

    <script type='text/javascript' src='{{ asset('plugins/leaflet/leaflet.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/sidebar/leaflet-sidebar.js')}}'></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script>
        var mymap = L.map('mapid').setView([51.505, -0.09], 13);

        var osmUrl='http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
        var osmAttrib='Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors';
            osmAttrib = osmAttrib + '&nbsp;&nbsp;&nbsp;&nbsp;<img src="../img_publicas/ficofloraVenezuela_ico.png" style="height: 25px; vertical-align: text-bottom;" />';
            osmAttrib = osmAttrib + '&nbsp;<b style="color:#17b218;">Proyecto Ficoflora Venezuela</b>';
            osmAttrib = osmAttrib + '<span> | clic sobre el mapa para ver otras coordenadas</span>';
        var osm = new L.TileLayer(osmUrl, {minZoom: 0, maxZoom: 15, attribution: osmAttrib});

        mymap.addLayer(osm);

        var marker = L.marker([51.5, -0.09]).addTo(mymap);
        var sidebar = L.control.sidebar('sidebar').addTo(mymap);
    </script>

