<?php 
/* procedimientos varios de gestión de COLECCIONES, codificados en php  */

function coleccionesActualizarEspecies(&$total) { // actualiza la lista de especies por coleccion

	// se eliminan los datos de la tabla colecciones_especies
	$query ="TRUNCATE TABLE colecciones_especies";
	$res = ejecutarQuerySQL($query);
	
	$query ="ALTER TABLE colecciones_especies AUTO_INCREMENT = 1";
	$res = ejecutarQuerySQL($query);
	
	$query ="SELECT DISTINCT especies_id, por_verificar,  nuevo_registro, genero, epiteto_especifico, 
								generos_id, epiteto_varietal, epiteto_forma, imagenes_id 
								FROM importados_colecciones 
								WHERE por_verificar = 0  
								ORDER BY epiteto_especifico";								
								//  AND nuevo_registro = 0 
	$res = ejecutarQuerySQL($query);	
	
	$total = getNumFilas($res);
	$i=1;
	
	while ($i <= $total) 	
		{
				$actual = getFila($res);
				$v1= $actual['especies_id']; 					$v2= $actual['por_verificar']; 			
				$v3= $actual['nuevo_registro']; 
				$v4= $actual['epiteto_especifico']; 		$v5= $actual['epiteto_varietal'];  	$v6= $actual['epiteto_forma']; 
				$v7= $actual['imagenes_id']; 			    $v8= $actual['genero'];						$v9= $actual['generos_id'];
				
				if ($actual['especies_id'] != 0) {
				$queryT1 = "INSERT INTO colecciones_especies (especies_id,  por_verificar,  nuevo_registro, 
												generos_id, genero, epiteto_especifico, epiteto_varietal, epiteto_forma, 
												imagenes_id) 
												VALUES ('$v1',  '$v2', '$v3', '$v9', '$v8', '$v4', '$v5', '$v6', '$v7')";	
				$resT1 = ejecutarQuerySQL($queryT1);
				}		
		$i++;
		}
		
return $total;	
}


function coleccionesActualizarGeneros(&$total) { // actualiza la lista de géneros por coleccion

	// se eliminan los datos de la tabla colecciones_generos
	$query ="TRUNCATE TABLE colecciones_generos";
	$res = ejecutarQuerySQL($query);
	
	$query ="ALTER TABLE colecciones_generos AUTO_INCREMENT = 1";
	$res = ejecutarQuerySQL($query);
		
	$query ="SELECT DISTINCT genero, por_verificar, nuevo_registro, generos_id  FROM importados_colecciones WHERE por_verificar = 0  ORDER BY genero";
								// AND nuevo_registro = 0 
	$res = ejecutarQuerySQL($query);
	
	$total = getNumFilas($res);
	$i=1;
	
	while ($i <= $total) 	
		{
				$actual = getFila($res);
				$v1= $actual['generos_id']; 					$v2= $actual['genero'];
				
				if ($actual['generos_id'] != 0) {
				$queryT1 = "INSERT INTO colecciones_generos (generos_id,  genero) 	VALUES ( '$v1',  '$v2') ";	
				$resT1 = ejecutarQuerySQL($queryT1);
				}
		$i++;
		}

return $total;	
}


function coleccionesActualizar(&$total) { // actualiza la tabla coleccion

	// se eliminan los datos de la tabla colecciones
	$query ="TRUNCATE TABLE colecciones";
	$res = ejecutarQuerySQL($query);
	
	$query ="ALTER TABLE colecciones AUTO_INCREMENT = 1";
	$res = ejecutarQuerySQL($query);
	
	$query ="SELECT DISTINCT num_coleccion, fecha_coleccion, visita_localidades_id, especies_id,  por_verificar, 
								nuevo_registro, generos_id,  genero, epiteto_especifico, epiteto_varietal,
								epiteto_forma,  imagenes_id FROM importados_colecciones  
								ORDER BY num_coleccion";
	$res = ejecutarQuerySQL($query);	
	
	$total = getNumFilas($res);
	$i=1;
	
	while ($i <= $total) 	
		{
				$actual = getFila($res);
				$v1= $actual['num_coleccion']; 			$v2= $actual['fecha_coleccion']; 		$v3= $actual['visita_localidades_id']; 
				$v4= $actual['especies_id']; 					$v5= $actual['por_verificar']; 			$v6= $actual['nuevo_registro']; 
				$v7= $actual['generos_id']; 					$v8= $actual['genero'];
				$v9= $actual['epiteto_especifico']; 		$v10= $actual['epiteto_varietal']; 
				$v11= $actual['epiteto_forma']; 			$v12= $actual['imagenes_id']; 
				
				if ($actual['num_coleccion'] != 0) {
				$queryT1 = "INSERT INTO colecciones (num_coleccion, fecha_coleccion, visita_localidades_id, especies_id,
												por_verificar,  nuevo_registro, generos_id,  
												genero, epiteto_especifico, epiteto_varietal,
												epiteto_forma, imagenes_id ) 	
												VALUES ( '$v1',  '$v2', '$v3',  '$v4', '$v5', '$v6', '$v7', '$v8', '$v9',  '$v10', '$v11', 
												'$v12' ) ";	
				$resT1 = ejecutarQuerySQL($queryT1);
				}
		$i++;
		}
}
?>