<?php
// Funciones asociadas a Autor utilizadas para crear el pdf con los resultados de las consultas

function consultarAutorEspecie($criterio) { // consulta el nombre del autor dado el id de la especie
	
	$query = "SELECT autores_id FROM especies WHERE id=".$criterio; 
	$res = ejecutarQuerySQL($query);	
	$actual = getFila($res);
	
	$query = "SELECT autor FROM autores WHERE id=". $actual['autores_id']; 
	$res = ejecutarQuerySQL($query);	
	$actual = getFila($res);
	
return  $actual['autor'];
}

function consultarAutor($id) {  // consulta el nombre del autor o autoridad identificado por $id
	$query = "SELECT autor FROM autores WHERE id=$id"; 
	$res = ejecutarQuerySQL($query);			
	$actual = getFila($res);	
	return $actual['autor'];
}
?>