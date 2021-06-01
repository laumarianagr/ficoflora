/**
 * Created by Lupita on 29/01/2016.

 * Se utiliza en los mapas que se muestran en las consultas por ubicación que muestran listas de especies
 */



/*------------------------------------------MAPA-----------------------------------*/
map = new L.Map('map', {zoomControl: false});

/*------------------------------------------CAPAS----------------------------------*/
// create the tile layer with correct attribution
var osmUrl='http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
var osmAttrib='Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors';
//osmAttrib = osmAttrib + '&nbsp;&nbsp;&nbsp;&nbsp;<img src="../../img_publicas/ficofloraVenezuela_ico.png" style="height: 25px; vertical-align: text-bottom;" />';
osmAttrib = osmAttrib + '&nbsp;&nbsp;&nbsp;&nbsp;<b style="color:#000000;">Proyecto Ficoflora Venezuela</b>';
osmAttrib = osmAttrib + '<span> | clic sobre el mapa para ver otras coordenadas</span>';

// src de la imagen configurado para mostrarla en el servidor web

//var osm = new L.TileLayer(osmUrl, {minZoom: 0, maxZoom: 16, attribution: osmAttrib});


var CyclmoUrl = 'https://dev.{s}.tile.openstreetmap.fr/cyclosm/{z}/{x}/{y}.png',
    SatelitalUrl = 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}';


var osm = new L.TileLayer(osmUrl, {minZoom: 0, maxZoom: 16, attribution: osmAttrib}),
    Ciclismo = new L.TileLayer(CyclmoUrl, {minZoom: 0, maxZoom: 16, attribution: osmAttrib}),
    Satelital = new L.TileLayer(SatelitalUrl, {minZoom: 0, maxZoom: 16, attribution: osmAttrib});

map.addLayer(osm);
var baseMaps = {
    "Osm": osm,
    "Ciclismo": Ciclismo,     
    "Satelital": Satelital   
};

/*-------------------------------CONTROL CAPAS RASTER----------------------------------------*/
var control = L.control.layers(baseMaps, null, {collapsed:false}).addTo(map); 


/*--------------------------CONTROL SIDEBAR--------------------------------------------------*/

var sidebar = L.control.sidebar({ container: 'side' }).addTo(map);

// Call the getContainer routine.
var htmlObject = control.getContainer();
// Get the desired parent node.
var newdoc = document.getElementById("controlL");

// Finally append that node to the new parent, recursively searching out and re-parenting nodes.
function setParent(el, newParent){
    newParent.appendChild(el);
}
setParent(htmlObject, newdoc);
            

//------------------------------------------------------------------------------------------//
//L.control.scale({imperial: false}).addTo(map);
//L.easyPrint().addTo(map); // agrega el control para imprimir

var popup = L.popup(); // muestra las coordenadas al hacer clic en un punto

function onMapClick(e) {
    popup
        .setLatLng(e.latlng)
        .setContent(e.latlng.toString())
        .openOn(map);
}

map.on('click', onMapClick);


for (coordenada in coordenadas) {
    console.log(coordenada);
    console.log(coordenadas[coordenada]['latitud']);
    console.log(coordenadas[coordenada]['nombre']);
    var marker = L.marker([coordenadas[coordenada]['latitud'], coordenadas[coordenada]['longitud']]).addTo(map);
    marker.bindPopup("<h5 style='margin-top: 5px;margin-bottom: 5px;'><b>" + coordenadas[coordenada]['nombre'] + ":</b> </h5> <b>Latitud: </b>" + coordenadas[coordenada]['latitud'] + "<br><b>Longitud: </b>" + coordenadas[coordenada]['longitud']);


    marker.on('mouseover', function (e) {
        this.openPopup();
    });
    marker.on('mouseout', function (e) {
        this.closePopup();
    });
}

$(".modal-mapa").on('click', function(){

    var id = $(this).attr('id');
    console.log(id);
    console.log(coordenadas[id]);

    mapas(coordenadas[id]['latitud'], coordenadas[id]['longitud'], 10);
//        mapas(10.42, -65.45);
    ruta(coordenadas[id]['latitud'], coordenadas[id]['longitud'], 10);


});


$("#modal-vzla").on('click', function(){
    mapas(10.617, -66.966, 5);
    //rutas(coordenadas[id]['latitud'], coordenadas[id]['longitud'], 10); 
    ruta(10.617, -66.966, 5);
     
    
});

$("#modal-entidad").on('click', function(){
    mapas(coordenadasUbicacion[0]['latitud'], coordenadasUbicacion[0]['longitud'], 7);
    ruta(coordenadasUbicacion[0]['latitud'], coordenadasUbicacion[0]['longitud'], 7);


});

$("#modal-localidad").on('click', function(){
    mapas(coordenadasUbicacion[0]['latitud'], coordenadasUbicacion[0]['longitud'], 10);
    ruta(coordenadasUbicacion[0]['latitud'], coordenadasUbicacion[0]['longitud'], 10);

});

$("#modal-localidad2").on('click', function(){
    mapas(coordenadas[0]['latitud'], coordenadas[0]['longitud'], 10);
    ruta(coordenadas[0]['latitud'], coordenadas[0]['longitud'], 10);


});

$("#modal-lugar").on('click', function(){
    mapas(coordenadasUbicacion[0]['latitud'], coordenadasUbicacion[0]['longitud'], 10);
    ruta(coordenadasUbicacion[0]['latitud'], coordenadasUbicacion[0]['longitud'], 10);



});

$("#modal-lugar2").on('click', function(){
    mapas(coordenadas[0]['latitud'], coordenadas[0]['longitud'], 10);
    ruta(coordenadas[0]['latitud'], coordenadas[0]['longitud'], 10);

});

$("#modal-sitio").on('click', function(){
    mapas(coordenadas[0]['latitud'], coordenadas[0]['longitud'], 10);
    ruta(coordenadas[0]['latitud'], coordenadas[0]['longitud'], 10);

});



function mapas(lat, lon, zoom){

    //map.setView(new L.LatLng(51.302, 0.702),8);
    map.setView(new L.LatLng(lat, lon),zoom);
}

/*---------------------------------------NOTAS O COMENTARIOS------------------------------------*/
var markerOptions = {
    title: "Notas",
    clickable: true,
    draggable: true
}
/*--1. SE CREA LA NOTAs--*/

var markerC,
    note;   

/*--2. SE AGREGA LA NOTA Y SE MANDA A GETDATA--*/
function getdata(){

    note = document.getElementById('notes').value;//toma el valor del formulario
    longitud = document.getElementById('long').value;//toma el valor del formulario
    latitud = document.getElementById('lat').value;//toma el valor del formulario

    addNote(note);
}

function  addNote(note){
            
    markerOptions= {
        draggable: true
    }
    markerC = L.marker([longitud, latitud], markerOptions).addTo(map).bindPopup("<b>Notas: " + note).openPopup();// creacion marcador

}

//----------------------------CONTROL ZOOM----------------------------//

var zoom = L.control.zoom().addTo(map);
var htmlPO = zoom.getContainer();
var newObj = document.getElementById('zoom');
setParent(htmlPO, newObj);

//----------------------------CONTROL IMPRIMIR------------------------//

var htmlOb = L.easyPrint().addTo(map).getContainer();
var newie = document.getElementById('print');
setParent(htmlOb, newie);


//-----------------------------RUTAS---------------------------------//
function ruta(lat, lon, zoom){

 
    var controlRoute = L.Routing.control({
            waypoints: [
                L.latLng(),
                L.latLng()
            ],
            language: 'es',
            geocoder: L.Control.Geocoder.nominatim(),
            routeWhileDragging: true,
            reverseWaypoints: true,
            showAlternatives: true,
          
            router: L.Routing.mapbox('pk.eyJ1IjoibGF1bWFyaWFuYWdyIiwiYSI6ImNraWRvYm92dTAzNzcycWxiZDlvMzlkdDQifQ.Bt2UCd6VpYuXHLcCqVmE7Q')
    }).addTo(map);

        //L.Routing.errorControl(controlRoute).addTo(map);
        
    var ObjR = controlRoute.getContainer();
    var newr = document.getElementById('controlR');
    setParent(ObjR, newr);
       

} 
