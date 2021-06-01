/*! (c) js functions Yusneyi Carballo Barrera         */

/* ------------------- date --------------------- */

var d = new Date();
var year = d.getFullYear();
var month = d.getMonth(); /* +1 */
var day = d.getDate();
var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
$(document).ready(function() {

  $('#agno').text( year );
  $('#agno2').text( year );  
  $('#agnoCopyright').text( year );
  $('#fecha').text( day  + " de "  + meses[month] + " de "  + year  );
});

