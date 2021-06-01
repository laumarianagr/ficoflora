<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/ficoflora.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/leaflet/leaflet.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/leaflet-easyPrint-gh-pages/dist/easyPrint.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/magnific-popup/magnific-popup.css')}}">

    <style>
        #map { height:500px; }
    </style>

</head>
<body>

<div class="row">
    <div class="col-xs-6">
        {{--<a class="modal-mapa text-md modal-basic modal-with-zoom-anim" href="#modal_nuevafamilia" id="0"><span class="fa fa-plus-circle va-middle text-xl " aria-hidden="true"></span> Nueva</a>--}}

        @foreach($col as $key=>$val)
            <a class="modal-mapa text-md modal-basic modal-with-zoom-anim" href="#modal-mapa" id="{{$key}}"><span class="fa fa-plus-circle va-middle text-xl " aria-hidden="true"></span> Nueva</a>

        @endforeach
    </div>

    @include('mapas._modal-mapa')

</div>



<script type='text/javascript' src='{{ asset('plugins/jquery/jquery-1.11.2.min.js')}}'></script>
<script type='text/javascript' src='{{ asset('plugins/leaflet/leaflet.js')}}'></script>
<script type='text/javascript' src='{{ asset('plugins/leaflet-easyPrint-gh-pages/dist/leaflet.easyPrint.js')}}'></script>

<script type='text/javascript' src='{{ asset('plugins/bootstrap/js/bootstrap.min.js')}}'></script>

<script type='text/javascript' src='{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js')}}'></script>
<script type='text/javascript' src='{{ asset('js/examples.modals.js')}}'></script>

<script>

    var tax = <?php echo $col; ?>;

    console.log(tax);

    $(".modal-mapa").on('click', function(){

        var id = $(this).attr('id');
        console.log(id);

        mapas(tax[id]['lat'], tax[id]['lon']);//aca estoy recuperando la longitud y latitud de la ubicacion de la especie
    });

    // ***
    // Se utiliza en los mapas que se muestran en las consultas por ubicación que muestran listas de ubicaciones
    // ***
    function mapas(lat, lon){
        map = new L.Map('map');

        // create the tile layer with correct attribution
        var osmUrl='http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
        var osmAttrib='Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors';
        osmAttrib = osmAttrib + '&nbsp;&nbsp;&nbsp;&nbsp;<img src="../img_publicas/ficofloraVenezuela_ico.png" style="height: 25px; vertical-align: text-bottom;" />';
        osmAttrib = osmAttrib + '&nbsp;<b style="color:#FFFFFF;">Proyecto Venezuela</b>';
        osmAttrib = osmAttrib + '<span> | clic sobre el mapa para ver otras coordenadas</span>';

        //-------NUEVAS CAPAS-------//

        // src de la imagen configurado para mostrarla en el servidor web
        var osm = new L.TileLayer(osmUrl, {minZoom: 0, maxZoom: 15, attribution: osmAttrib});

        // start the map in South-East England
        //map.setView(new L.LatLng(51.302, 0.702),8);
        map.setView(new L.LatLng(lat, lon),10);
        var marker = L.marker([lat, lon]).addTo(map);

        map.addLayer(osm);
        L.control.scale({imperial: false}).addTo(map);
        L.easyPrint().addTo(map); // agrega el control para imprimir

        //--------------------------------------------------------------//
        //creacion de nuevos controles de interacion, capas, comentarios, compartir


    


        //-----------------------------------------------------------------//


        var popup = L.popup(); // muestra las coordenadas al hacer clic en un punto

        function onMapClick(e) {
            popup
                    .setLatLng(e.latlng)
                    .setContent(e.latlng.toString())
                    .openOn(map);
        }

        map.on('click', onMapClick);

    }
    // set up the map

</script>
</body>
</html>