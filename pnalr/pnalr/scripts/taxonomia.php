<?php 
/* procedimientos varios para consultar información de la taxonomía */

function consultar($tabla,$campo) { // consulta todos los $campo de la bdd 
	$query = "SELECT id, $campo FROM  $tabla ORDER BY $campo"; 
	$res = ejecutarQuerySQL($query);			
	return $res;
}

function consultarAutor($idEspecie) {  // consulta el nombre del autor para la especie con id $idEspecie

	// se busca en la tabla principal especie
	$query = "SELECT autores_id FROM especies WHERE id = $idEspecie"; 
	$res = ejecutarQuerySQL($query);			
	$actual = getFila($res);	
	$idAutor = $actual['autores_id'];

	$query = "SELECT autor FROM autores WHERE id=$idAutor"; 
	$res = ejecutarQuerySQL($query);			
	$actual = getFila($res);	
	// reemplaza el * en el nombre del autor por el '
	$autor = str_replace("*", "'", $actual['autor'],$num);
	
	return $autor;
}


function consultarTaxon($idGenero) {	
	// construye la cadena taxonómica del género
	
	$query = "SELECT id, familias_id FROM generos WHERE id=$idGenero"; 
	$res = ejecutarQuerySQL($query);
	$total = getNumFilas($res);
	
	if ($total>0)
	{ // el género está incluido en la bdd del proyecto
	$actual = getFila($res);		
	$idFamilia = $actual['familias_id'];

	$query = "SELECT id, ordenes_id, familia FROM familias WHERE id=$idFamilia"; 
	$res = ejecutarQuerySQL($query);	
	$actual = getFila($res);		
	$familia = $actual['familia'];	
	$idOrden = $actual['ordenes_id'];

	$query = "SELECT id, clases_id, orden FROM ordenes WHERE id=$idOrden"; 
	$res = ejecutarQuerySQL($query);	
	$actual = getFila($res);		
	$orden = $actual['orden'];	
	$idClase = $actual['clases_id'];
	
	$query = "SELECT id, divisiones_id, clase FROM clases WHERE id=$idClase"; 
	$res = ejecutarQuerySQL($query);	
	$actual = getFila($res);		
	$clase = $actual['clase'];	
	$idDivision = $actual['divisiones_id'];
	
	$query = "SELECT id, division FROM divisiones WHERE id=$idDivision"; 
	$res = ejecutarQuerySQL($query);	
	$actual = getFila($res);
	$division = $actual['division'];
	$taxon = "<span class='textoClaro'>phylum</span> $division &#8250; 
						<span class='textoClaro'>clase</span> $clase &#8250; 
						<span class='textoClaro'>orden</span> $orden  &#8250;  
						<span class='textoClaro'>familia</span> $familia";
	return($taxon);
	}		
}


function arregloAutocompletarConsulta($tabla, $campo) {
	// consulta $tabla y crea un arreglo con los valores de campo, por ejemplo, una lista de géneros o de localidades
	
	if ($tabla == "localidades") {
			$query = "SELECT localidades.id, $campo, imagen_presencia, visita_localidades.localidades_id 
								FROM  localidades, visita_localidades
								WHERE imagen_presencia <> '' AND localidades.id = visita_localidades.localidades_id 
								ORDER BY $campo"; 
			$res = ejecutarQuerySQL($query);	
	} else {
			$query = "SELECT id, $campo FROM  $tabla ORDER BY $campo"; 
			$res = ejecutarQuerySQL($query);
	}
	
			$arreglo_php2 = array();			
			if(getNumFilas($res)==0)
			   array_push($arreglo_php2, "No hay datos");
			else{
			  while($lista = mysql_fetch_array($res)){
				array_push($arreglo_php2, $lista[$campo]);
			  	}
			}						
			$array_valores_unicos = array_keys(array_count_values($arreglo_php2));
			return($array_valores_unicos);  // arreglo con lista de valores, sin duplicación por ejemplo del género
}


function arregloAutocompletar($op) {
	// consulta géneros, especies o localidades (según op) y los almacena en un arreglo para una lista de autocompletar			
			
			$arreglo_php = array();
			
			// determino que se consultará para la lista 
			switch ($op)
			{
				case "genero":
						$tabla="colecciones_generos";   $campo="genero";
						$arreglo_php = arregloAutocompletarConsulta($tabla, $campo);
				break;
				
				case "especie":
						// consultando info de especies

						$query = "SELECT id, especies_id, nuevo_registro, 
												genero, epiteto_especifico, epiteto_varietal, epiteto_forma 									 
												FROM colecciones_especies
												ORDER BY genero";	
												
						$res = ejecutarQuerySQL($query);
						
						$arregloAux = array();  $arreglo_php = array(); 
						
						if(getNumFilas($res)==0)
						   array_push($arregloAux, "No hay datos");
						else {							
						  while($lista = mysql_fetch_array($res)) {
							  
								$valor = $lista['genero']. " ". $lista['epiteto_especifico'];
								if ($lista['epiteto_varietal'] !="")  $valor .= " ". $lista['epiteto_varietal'];
								if ($lista['epiteto_forma'] !="")  $valor .= " ". $lista['epiteto_forma'];
								array_push( $arregloAux, $valor );
								sort($arregloAux);	 // ordenamiento alfabético ascendente por especie							
							}
						}
						$arreglo_php = $arregloAux;
				break;				
				
				case "localidad":
						$tabla="localidades";   $campo="localidad";
						$arreglo_php = arregloAutocompletarConsulta($tabla, $campo);
				break;							
				
				case "autor":
						$tabla="autores";   $campo="autor";
						$arreglo_php = arregloAutocompletarConsulta($tabla, $campo);
				break;
				
				case "familia":
						$tabla="familias";   $campo="familia";
						$arreglo_php = arregloAutocompletarConsulta($tabla, $campo);
				break;
				
				case "orden":
						$tabla="ordenes";   $campo="orden";
						$arreglo_php = arregloAutocompletarConsulta($tabla, $campo);
				break;				
				
				case "clase":
						$tabla="clases";   $campo="clase";
						$arreglo_php = arregloAutocompletarConsulta($tabla, $campo);
				break;				
				
				case "division":
						$tabla="divisiones";   $campo="division";
						$arreglo_php = arregloAutocompletarConsulta($tabla, $campo);
				break;
				
				/*
				case "palabras":
					echo " <br />Consulta por palabra clave, funcionalidad en desarrollo.";
				break;
				*/
		
				default:
				echo "Opcion no contemplada"; 
				break;
			}
			return($arreglo_php);  // arreglo con lista de valores
}
?>