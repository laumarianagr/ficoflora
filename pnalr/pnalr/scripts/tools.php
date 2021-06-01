<?php 
/* procedimientos varios  codificados en php  */

function contar_palabras($cadena) { // cuenta la cantidad de palabras asumiendo separación por espacio	
    return str_word_count($cadena);	
}

function fechaEuropea($f) { // formatea la fecha f a dd-mm-aaaa
    return date("d-m-Y",strtotime($f));
}

function fechaVenezuela() { // formatea la fecha al fomato timezone_set Caracas
	date_default_timezone_set('America/Caracas');
	setlocale(LC_TIME, 'spanish');
	return(strftime("%d.%B.%Y")); 
}