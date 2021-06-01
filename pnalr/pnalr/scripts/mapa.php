<?php 
/* procedimientos varios para consultar información de distribución geográfica a mostrar en el mapa */

function presencia($mostrar, $estado)  {	
	// activa la capa con marca de presencia, estado=1 indica que tiene presencia de la especie/género
	if ( $mostrar and $estado > 0) 
		echo "p";
}

function consultarHayDistribucion($id, $tabla, $opcion)  {

	// consulta la distribución para el PNALR por especie o género según $tabla	
	if        ($opcion == 'e')  { $query = "SELECT * FROM $tabla WHERE especies_id=$id"; }
	elseif ($opcion == 'l')   { 
	$idLocalidad = localidadConsultarId($id);  // en localidades.php
	$query = "SELECT especies_id FROM $tabla WHERE ".$id." >= 1";  } 
	elseif ($opcion == 'g')   { $query = "SELECT * FROM $tabla WHERE generos_id=$id"; }
	
	$res = ejecutarQuerySQL($query); 
	$total = getNumFilas($res);
	return($total); // retorna la cantidad de registros encontrado (1 si se ha reportado localidades)
}

function consultarDistribucionEspecies($id, $tabla)  {	
	// consulta la distribución para el PNALR por especie o género según $tabla
	
	$query = "SELECT * FROM $tabla WHERE especies_id=$id"; 
	$res = ejecutarQuerySQL($query); 
	return($res); // retorna el registro de localidades (1 si se ha reportado localidades)
}

function consultarDistribucionLocalidades($id, $tabla)  {	
	// consulta la distribución para el PNALR por localidad según $tabla
	
	$query = "SELECT * FROM $tabla WHERE localidades_id=$id"; 
	$res = ejecutarQuerySQL($query); 
	return($res); // retorna el registro de localidades (1 si se ha reportado localidades)
}


function consultarAusenciaLocalidad($localidad)  {	
	// consulta la imagen de ausencia para el PNALR para la localidad 
	
	$query = "SELECT imagen_ausencia FROM localidades WHERE localidad='$localidad'"; 
	$res = ejecutarQuerySQL($query);
	$actual = getFila($res);
	return($actual['imagen_ausencia']); 
}

function consultarPresenciaLocalidad($localidad)  {	
	// consulta la imagen de presencia para el PNALR para la localidad
	
	$query = "SELECT imagen_presencia FROM localidades WHERE localidad='$localidad'"; 
	$res = ejecutarQuerySQL($query);
	$actual = getFila($res);
	return($actual['imagen_presencia']);
}


function consultarNombreLocalidadMapa($criterio) { // consulta el nombre a mostrar para localidad  

	$query = "SELECT localidad_nombre FROM  localidades WHERE localidad='".$criterio."'";		
	$res = ejecutarQuerySQL($query);
	$actual = getFila($res);
			
return $actual['localidad_nombre'];
}


function consultarMapaImagenLocalidad($localidad)  {	
	// consulta la imagen del mini-mapa para la localidad con nombre para el usuario $localidad
	
	$localidad = trim($localidad);
	$query = "SELECT imagen_mapa FROM localidades WHERE localidad_nombre = '$localidad'"; 
	
	$res = ejecutarQuerySQL($query);
	$actual = getFila($res);
	return($actual['imagen_mapa']);
}


function mostrarMapaEspecies($id, $tabla) {
// muestra la distribución en las localidades para una especie/género 
				
			$res = consultarDistribucionEspecies($id, $tabla);
			$actual = getFila($res);			
			
			$rutaMapaBase = "images_mapaPNALR/pnalr_mapaBase.png";
			$rutaMapa = "images_mapaPNALR/"; // ruta carpeta donde está el mapa o sus cuadrículas	
			$localidades = "";	 $j = 1;											

			/* *****************       FILA 1 DEL MAPA  ******************** */
			$pnalr_f1_1 = $rutaMapa . "pnalr_f1_1.png";  		
			$pnalr_f1_2 = $rutaMapa . "pnalr_f1_2.png";  	
					
			if ( $actual['Gran Roque'] == 0 ) {					
					$pnalr_f1_3 = $rutaMapa . consultarAusenciaLocalidad('Gran Roque'); }  
			else { 					
					$pnalr_f1_3 = $rutaMapa . consultarPresenciaLocalidad('Gran Roque');  
					$localidades = $localidades . " &#8226; " . 
					consultarNombreLocalidadMapa("Gran Roque") . 
					"&nbsp;"; $j++;
					}
			
			if (  ( $actual['Francisquí'] == 0 )  and ( $actual['Francisquí Arriba'] == 0 )  and
				  ( $actual['Nordisquí'] == 0 )   and ( $actual['Cayo Vapor'] == 0 )  ) {					
					$pnalr_f1_4 = $rutaMapa . consultarAusenciaLocalidad('Francisquí Arriba'); }  
					
			elseif  (  ( ( $actual['Francisquí'] >= 1) or  ( $actual['Francisquí Arriba'] >= 1)  )   and 
						    ( $actual['Nordisquí'] == 0 ) and ( $actual['Cayo Vapor'] == 0 )  ) { 					
					$pnalr_f1_4 = $rutaMapa . consultarPresenciaLocalidad('Francisquí Arriba');  
					$localidades = $localidades . " &#8226; " . 
					consultarNombreLocalidadMapa("Francisquí Arriba") . 
					"&nbsp;"; $j++;
					} 
					
			elseif  (  ( ( $actual['Francisquí'] == 0) or ( $actual['Francisquí Arriba'] == 0) ) and 
						  ( $actual['Nordisquí'] >= 1 ) and ( $actual['Cayo Vapor'] == 0 ) ) { 					
					$pnalr_f1_4 = $rutaMapa . consultarPresenciaLocalidad('Nordisquí');  
					$localidades = $localidades . " &#8226; " . 
					consultarNombreLocalidadMapa("Nordisquí") . 
					"&nbsp;"; $j++;
					}
					 
			elseif  (  ( ( $actual['Francisquí'] == 0) or ( $actual['Francisquí Arriba'] == 0) ) and 
						 ( $actual['Nordisquí'] == 0 ) and ( $actual['Cayo Vapor'] >= 1 ) ) { 					
					$pnalr_f1_4 = $rutaMapa . consultarPresenciaLocalidad('Cayo Vapor');  
					$localidades = $localidades . " &#8226;  " . 
					consultarNombreLocalidadMapa("Cayo Vapor") . 
					"&nbsp;"; $j++;
					}  
					
			elseif  (  ( ( $actual['Francisquí'] >= 1)  or ( $actual['Francisquí Arriba'] >= 1) )  and 
						 ( $actual['Nordisquí'] >= 1 ) and ( $actual['Cayo Vapor'] == 0 ) ) { 					
					$pnalr_f1_4 = $rutaMapa . "pnalr_f1_4_p_110.png";  
					$localidades = $localidades . " &#8226; " . 
					consultarNombreLocalidadMapa("Francisquí Arriba") . 
					"&nbsp; &#8226; " .  
					consultarNombreLocalidadMapa("Nordisquí") . 
					"&nbsp;"; $j++;
					} 
					
			elseif  (  ( ( $actual['Francisquí'] >= 1) or ( $actual['Francisquí Arriba'] >= 1) ) and 
						 ( $actual['Nordisquí'] == 0) and ( $actual['Cayo Vapor'] >= 1 ) ) { 					
					$pnalr_f1_4 = $rutaMapa . "pnalr_f1_4_p_101.png";  
					$localidades = $localidades . " &#8226; " . 
					consultarNombreLocalidadMapa("Francisquí Arriba") . 
					"&nbsp; &#8226; " .  
					consultarNombreLocalidadMapa("Cayo Vapor") . 
					"&nbsp;"; $j++;
					} 
					 
			elseif  ( ( $actual['Francisquí Arriba'] == 0) and ($actual['Nordisquí'] >= 1) and ($actual['Cayo Vapor'] >= 1) ) { 					
					$pnalr_f1_4 = $rutaMapa  . "pnalr_f1_4_p_011.png";  
					$localidades = $localidades . " &#8226; " . 
					consultarNombreLocalidadMapa("Nordisquí") . 
					"&nbsp; &#8226; " .  
					consultarNombreLocalidadMapa("Cayo Vapor") . 
					"&nbsp;"; $j++;
					} 
					 
			elseif  (  ( ( $actual['Francisquí'] >= 1) or ( $actual['Francisquí Arriba'] >= 1) ) and 
						 ( $actual['Nordisquí'] >= 1 ) and ( $actual['Cayo Vapor'] >= 1 )  ) { 					
					$pnalr_f1_4 = $rutaMapa  . "pnalr_f1_4_p.png";  
					$localidades = $localidades . " &#8226; " . 
					consultarNombreLocalidadMapa("Francisquí Arriba") . 
					"&nbsp; &#8226; " .   
					consultarNombreLocalidadMapa("Nordisquí") . 
					"&nbsp; &#8226; " .  
					consultarNombreLocalidadMapa("Cayo Vapor") . 
					"&nbsp;"; $j++; 
					}
					
			if  ( $actual['Francisquí'] >= 1) { 
					$localidades = "&#8226; " .  
					consultarNombreLocalidadMapa("Francisquí") . 
					" &nbsp;" . $localidades;
					 $j++; 
					}			
					
			/* *****************       FILA 2 DEL MAPA  ******************** */
			
			$pnalr_f2_1 = $rutaMapa . "pnalr_f2_1.png";
					
			if (  ($actual['Los Canquises'] == 0 )  and ($actual['Los Canquises Arriba'] == 0 ) ) {					
					$pnalr_f2_2 = $rutaMapa . consultarAusenciaLocalidad('Los Canquises Arriba'); }  
			else { 					
					$pnalr_f2_2 = $rutaMapa . consultarPresenciaLocalidad('Los Canquises Arriba');  
					$localidades = $localidades . " &#8226; " .  
					consultarNombreLocalidadMapa("Los Canquises Arriba") . 
					"&nbsp;"; $j++;
					}
					
					
			if  ( $actual['Los Canquises'] >= 1) { 
					$localidades = "&#8226; " .  
					consultarNombreLocalidadMapa("Los Canquises") . 
					" &nbsp;" . $localidades;
					 $j++;
					}						
								
							
			if ( ($actual['Noronquí'] == 0 ) and ($actual['Noronquí Arriba'] == 0 ) ) {					
					$pnalr_f2_3 = $rutaMapa . consultarAusenciaLocalidad('Noronquí Arriba'); }  
			else { 					
					$pnalr_f2_3 = $rutaMapa . consultarPresenciaLocalidad('Noronquí Arriba');  
					$localidades = $localidades . " &#8226; " .  
					consultarNombreLocalidadMapa("Noronquí Arriba") . 
					"&nbsp;"; $j++;
					}
					
					
			if  ( $actual['Noronquí'] >= 1) { 
					$localidades = "&#8226; " .  
					consultarNombreLocalidadMapa("Noronquí") . 
					" &nbsp;" . $localidades;
					 $j++;
					}					
			
			if ( ( $actual['Madrisquí'] == 0 ) and ( $actual['Cayo Pirata'] == 0 ) ) {					
					$pnalr_f2_4 = $rutaMapa . consultarAusenciaLocalidad('Madrisquí'); }  
			
			elseif ( ( $actual['Madrisquí'] >= 1 ) and ( $actual['Cayo Pirata'] == 0 ) ) {					
					$pnalr_f2_4 = $rutaMapa . "pnalr_f2_4_p_10.png";  
					$localidades = $localidades . " &#8226; " .  
					consultarNombreLocalidadMapa("Madrisquí") . 
					"&nbsp;"; $j++;
					}  
			
			elseif ( ( $actual['Madrisquí'] == 0 ) and ( $actual['Cayo Pirata'] >= 1 ) ) {					
					$pnalr_f2_4 = $rutaMapa . "pnalr_f2_4_p_01.png";  
					$localidades = $localidades . " &#8226; " .  
					consultarNombreLocalidadMapa("Cayo Pirata") . 
					"&nbsp;"; $j++;
					} 
			
			elseif ( ( $actual['Madrisquí'] >= 1 ) and ( $actual['Cayo Pirata'] >= 1 ) ) {					
					$pnalr_f2_4 = $rutaMapa . "pnalr_f2_4_p.png";  
					$localidades = $localidades . " &#8226; " . 
					consultarNombreLocalidadMapa("Madrisquí") . 
					"&nbsp; &#8226; " .  
					consultarNombreLocalidadMapa("Cayo Pirata") . 
					"&nbsp;"; $j++;
					}
					
					
			/* *****************       FILA 3 DEL MAPA  ******************** */
			
			$pnalr_f3_1a = $rutaMapa . consultarAusenciaLocalidad('Selesquí');  // localidad sin especie colectada
			
					
			if ( $actual['Cayo Carenero'] == 0 ) {					
					$pnalr_f3_1b = $rutaMapa . consultarAusenciaLocalidad('Cayo Carenero'); }  
			else { 					
					$pnalr_f3_1b = $rutaMapa . consultarPresenciaLocalidad('Cayo Carenero');  
					$localidades = $localidades . " &#8226; " .  
					consultarNombreLocalidadMapa("Cayo Carenero") . 
					"&nbsp;"; $j++;
					}
					
			if ( ( $actual['Yonquí'] == 0 )   and ( $actual['Sarquí'] == 0 ) and ( $actual['Espenquí'] == 0 )  ) {					
					$pnalr_f3_2 = $rutaMapa . consultarAusenciaLocalidad('Espenquí'); }  
					
			elseif  (  ( $actual['Yonquí'] == 0 ) and ( $actual['Sarquí'] == 0 )  and ( $actual['Espenquí'] >= 1) ) { 					
					$pnalr_f3_2 = $rutaMapa . consultarPresenciaLocalidad('Espenquí');  
					$localidades = $localidades . " &#8226; " .  
					consultarNombreLocalidadMapa("Espenquí")  . 
					"&nbsp;"; $j++;
					} 
					
			elseif  ( ( $actual['Yonquí'] >= 1 ) and ( $actual['Sarquí'] == 0 ) and ( $actual['Espenquí'] == 0) ) { 					
					$pnalr_f3_2 = $rutaMapa . consultarPresenciaLocalidad('Yonquí');  
					$localidades = $localidades . " &#8226; " .  
					consultarNombreLocalidadMapa("Yonquí")  . 
					"&nbsp;"; $j++;
					}
					 
			elseif  ( ( $actual['Espenquí'] == 0) and ( $actual['Yonquí'] == 0 ) and ( $actual['Sarquí'] >= 1 ) ) { 					
					$pnalr_f3_2 = $rutaMapa . consultarPresenciaLocalidad('Sarquí');  
					$localidades = $localidades . " &#8226; " .  
					consultarNombreLocalidadMapa("Sarquí")  . 
					"&nbsp;"; $j++;
					}  
					
			elseif  ( ( $actual['Yonquí'] >= 1 ) and ( $actual['Sarquí'] == 0 ) and ( $actual['Espenquí'] >= 1)) { 					
					$pnalr_f3_2 = $rutaMapa . "pnalr_f3_2_p_101.png";  
					$localidades = $localidades . " &#8226; " . 
					consultarNombreLocalidadMapa("Espenquí") . 
					"&nbsp; &#8226; " .  
					consultarNombreLocalidadMapa("Yonquí") . 
					"&nbsp;"; $j++;
					} 
					
			elseif  ( ( $actual['Yonquí'] == 0) and ( $actual['Sarquí'] >= 1 ) and ( $actual['Espenquí'] >= 1)) { 					
					$pnalr_f3_2 = $rutaMapa . "pnalr_f3_2_p_011.png";  
					$localidades = $localidades . " &#8226; " . 
					consultarNombreLocalidadMapa("Espenquí") . 
					"&nbsp; &#8226; " .  
					consultarNombreLocalidadMapa("Sarquí") . 
					"&nbsp;"; $j++;
					} 
					 
			elseif  ( ( $actual['Yonquí'] >= 1 ) and ( $actual['Sarquí'] >= 1 ) and ( $actual['Espenquí'] == 0) ) { 					
					$pnalr_f3_2 = $rutaMapa  . "pnalr_f3_2_p_110.png";  
					$localidades = $localidades . " &#8226; " . 
					consultarNombreLocalidadMapa("Yonquí") . 
					"&nbsp; &#8226; " .  
					consultarNombreLocalidadMapa("Sarquí") . 
					"&nbsp;"; $j++;
					} 
					 
			elseif  ( ( $actual['Yonquí'] >= 1 ) and ( $actual['Sarquí'] >= 1 ) and ( $actual['Espenquí'] >= 1) ) { 					
					$pnalr_f3_2 = $rutaMapa  . "pnalr_f3_2_p.png";  
					$localidades = $localidades . " &#8226; " . 
					consultarNombreLocalidadMapa("Espenquí") . 
					"&nbsp; &#8226; " .   
					consultarNombreLocalidadMapa("Yonquí") . 
					"&nbsp; &#8226; " .  
					consultarNombreLocalidadMapa("Sarquí") . 
					"&nbsp;"; $j++;
					}
									
					
			if ( $actual['Cayo Crasquí'] == 0 ) {					
					$pnalr_f3_3 = $rutaMapa . consultarAusenciaLocalidad('Cayo Crasquí'); }  
			else { 					
					$pnalr_f3_3 = $rutaMapa . consultarPresenciaLocalidad('Cayo Crasquí');  
					$localidades = $localidades . " &#8226; " .  
					consultarNombreLocalidadMapa("Cayo Crasquí") . 
					"&nbsp;"; $j++;
					}
			
							
			if ( $actual['Esparquí'] == 0 ) {					
					$pnalr_f3_4 = $rutaMapa . consultarAusenciaLocalidad('Esparquí'); }  
			else { 					
					$pnalr_f3_4 = $rutaMapa . consultarPresenciaLocalidad('Esparquí');  
					$localidades = $localidades . " &#8226; " .  
					consultarNombreLocalidadMapa("Esparquí") . 
					"&nbsp;"; $j++;
					}
					
					
			/* *****************       FILA 4 DEL MAPA  ******************** */
			
			if ( $actual['Cayo Bequevé'] == 0 ) {					
					$pnalr_f4_1a = $rutaMapa . consultarAusenciaLocalidad('Cayo Bequevé'); }  
			else { 					
					$pnalr_f4_1a = $rutaMapa . consultarPresenciaLocalidad('Cayo Bequevé'); 
					$localidades = $localidades . " &#8226; " .  
					consultarNombreLocalidadMapa("Cayo Bequevé") . 
					"&nbsp;"; $j++;
					}
					
			if ( $actual['Mosquitoquí'] == 0 ) {					
					$pnalr_f4_1b = $rutaMapa . consultarAusenciaLocalidad('Mosquitoquí'); }  
			else { 					
					$pnalr_f4_1b = $rutaMapa . consultarPresenciaLocalidad('Mosquitoquí');  
					$localidades = $localidades . " &#8226; " .  
					consultarNombreLocalidadMapa("Mosquitoquí") . 
					"&nbsp;"; $j++;
					}
					
			if ( $actual['Isla Larga'] == 0 ) {	// faltó Isla Fernando en localidades de prueba en la bdd
					$pnalr_f4_2 = $rutaMapa . consultarAusenciaLocalidad('Isla Larga'); }  
			else { 					
					$pnalr_f4_2 = $rutaMapa . consultarPresenciaLocalidad('Isla Larga');  
					$localidades = $localidades . " &#8226; " .  
					consultarNombreLocalidadMapa("Isla Larga") . 
					"&nbsp;"; $j++;
					}
			
						
			if ( ( $actual['Sanquí'] == 0 ) and ( $actual['Rabusquí'] == 0 ) ) {					
					$pnalr_f4_3 = $rutaMapa . consultarAusenciaLocalidad('Rabusquí'); }  
			
			elseif ( ( $actual['Sanquí'] >= 1 ) and ( $actual['Rabusquí'] == 0 ) ) {					
					$pnalr_f4_3 = $rutaMapa . consultarPresenciaLocalidad('Sanquí'); 
					$localidades = $localidades . " &#8226; " .  
					consultarNombreLocalidadMapa("Sanquí") . 
					"&nbsp;"; $j++;
					}  
			
			elseif ( ( $actual['Sanquí'] == 0 ) and ( $actual['Rabusquí'] >= 1 ) ) {					
					$pnalr_f4_3 = $rutaMapa . consultarPresenciaLocalidad('Rabusquí'); 
					$localidades = $localidades . " &#8226; " .  
					consultarNombreLocalidadMapa("Rabusquí") . 
					"&nbsp;"; $j++;
					} 
			
			elseif ( ( $actual['Sanquí'] >= 1 ) and ( $actual['Rabusquí'] >= 1 ) ) {					
					$pnalr_f4_3 = $rutaMapa . "pnalr_f4_3_p.png";  
					$localidades = $localidades . " &#8226; " .   
					consultarNombreLocalidadMapa("Sanquí") . 
					"&nbsp; &#8226; " .  
					consultarNombreLocalidadMapa("Rabusquí") . 
					"&nbsp;"; $j++;
					}
					
			$pnalr_f4_4 = $rutaMapa . consultarAusenciaLocalidad('Cuchillo');	 // localidad sin especie colectada
					
															

			/* *****************       FILA 5   DEL MAPA  ******************** */

			if ( $actual['Cayo de Agua'] == 0 ) {					
					$pnalr_f5_1a = $rutaMapa . consultarAusenciaLocalidad('Cayo de Agua'); }  
			else { 					
					$pnalr_f5_1a = $rutaMapa . consultarPresenciaLocalidad('Cayo de Agua');  
					$localidades = $localidades . " &#8226; " .  
					consultarNombreLocalidadMapa("Cayo de Agua") . 
					"&nbsp;"; $j++;
					}
			
			
			if ( ( $actual['Dos Mosquises'] == 0 ) and
				 ( $actual['Dos Mosquises Norte'] == 0 ) and ( $actual['Dos Mosquises Sur'] == 0 )  ) {					
					$pnalr_f5_1b = $rutaMapa . consultarAusenciaLocalidad('Dos Mosquises Norte'); }  
					
			elseif  ( ( $actual['Dos Mosquises'] >= 1 ) or
					( $actual['Dos Mosquises Norte'] >= 1 ) and ( $actual['Dos Mosquises Sur'] == 0 )  ) {	
					$pnalr_f5_1b = $rutaMapa . consultarPresenciaLocalidad('Dos Mosquises Norte');  
					$localidades = $localidades . " &#8226; " .  
					consultarNombreLocalidadMapa("Dos Mosquises Norte") . 
					"&nbsp;"; $j++;
					} 
					
			elseif  ( ( $actual['Dos Mosquises'] >= 1 ) or  
					( $actual['Dos Mosquises Norte'] == 0 ) and ( $actual['Dos Mosquises Sur'] >= 1 ) ) {		
					$pnalr_f5_1b = $rutaMapa . consultarPresenciaLocalidad('Dos Mosquises Sur');  
					$localidades = $localidades . " &#8226; " .  
					consultarNombreLocalidadMapa("Dos Mosquises Sur") . 
					"&nbsp;"; $j++;
					}
					
			elseif  ( ( $actual['Dos Mosquises Norte'] >= 1 ) and ( $actual['Dos Mosquises Sur'] >= 1 )  ) {				
					$pnalr_f5_1b = $rutaMapa . "pnalr_f5_1b_p_110.png";  
					$localidades = $localidades . " &#8226; Dos Mosquises Norte &nbsp; &#8226; Dos Mosquises Sur &nbsp;";  $j++;
					}
					
				if  ( $actual['Dos Mosquises'] >= 1) { 
					$localidades = "&#8226;  " .  
					consultarNombreLocalidadMapa("Dos Mosquises") . 
					" &nbsp;" . $localidades;
					 $j++;					 
					}		
														

			if ( $actual['Cayo Sal'] == 0 ) {					
					$pnalr_f5_2 = $rutaMapa . consultarAusenciaLocalidad('Cayo Sal'); }  
			else { 					
					$pnalr_f5_2 = $rutaMapa . consultarPresenciaLocalidad('Cayo Sal');  
					$localidades = $localidades . " &#8226; " .  
					consultarNombreLocalidadMapa("Cayo Sal") . 
					"&nbsp;"; $j++;
					}
			
			
			if ( ( $actual['Boca de Cote'] == 0 ) ) {					
					$pnalr_f5_3 = $rutaMapa . consultarAusenciaLocalidad('Boca de Cote'); }  
					
			else {				
					$pnalr_f5_3 = $rutaMapa . consultarPresenciaLocalidad('Boca de Cote');  
					$localidades = $localidades . " &#8226; " .  
					consultarNombreLocalidadMapa("Boca de Cote") . 
					"&nbsp;"; $j++;
					}
			
						
			if ( ( $actual['Sebastopol'] == 0 ) and ( $actual['María Uespen'] == 0 ) ) {					
					$pnalr_f5_4 = $rutaMapa . consultarAusenciaLocalidad('Sebastopol'); }  
			
			elseif ( ( $actual['Sebastopol'] >= 1 ) and ( $actual['María Uespen'] == 0 ) ) {					
					$pnalr_f5_4 = $rutaMapa . "pnalr_f5_4_p_01.png";  
					$localidades = $localidades . " &#8226; " .  
					consultarNombreLocalidadMapa("Sebastopol") . 
					"&nbsp;"; $j++;
					}  
			
			elseif ( ( $actual['Sebastopol'] == 0 ) and ( $actual['María Uespen'] >= 1 ) ) {					
					$pnalr_f5_4 = $rutaMapa . "pnalr_f5_4_p_10.png";  
					$localidades = $localidades . " &#8226; " .  
					consultarNombreLocalidadMapa("María Uespen") . 
					"&nbsp;"; $j++;
					} 
			
			elseif ( ( $actual['Sebastopol'] >= 1 ) and ( $actual['María Uespen'] >= 1 ) ) {					
					$pnalr_f5_4 = $rutaMapa . "pnalr_f5_4_p.png";  
					$localidades = $localidades . " &#8226; " .   
					consultarNombreLocalidadMapa("Sebastopol") . 
					"&nbsp; &#8226; " .  
					consultarNombreLocalidadMapa("María Uespen") . 
					"&nbsp;"; $j++;
					}
			
			
			/*  se ordenan la lista de localidades alfabéticamente */
					/* se eliminan espacios y caracteres especiales */
					$localidades = trim($localidades);  
					$localidades = str_replace('&nbsp;', '', $localidades);					
					
					$localidades2 = explode("&#8226;", $localidades);
					sort($localidades2);
					$localidades = "";
					
					$carpeta = "images_mapaPNALR/";
					
					for ($j = 1; $j < count($localidades2); $j++) {
						$localidad = $localidades2[$j ];
						$imagen_mapaLocalidad = consultarMapaImagenLocalidad($localidad);
						$imagen_mapaLocalidad = $carpeta . $imagen_mapaLocalidad;  
						
						//$localidades .=  $localidad;
						$localidades .=  " &#8226; " .  "<a class='fancybox' rel='group1' style='color: #36C;' 
													href='" . $imagen_mapaLocalidad . "'  title='" . $localidad  ."'>" . 
													$localidad . "</a>";  
						}

			
			?>
            
            <!-- mapa dinámico de presencia/ausencia en el PNALR -->            
           <p>
           		<h1>Distribución geográfica</h1>
                <span class="etiqueta">Localidades en donde se ha reportado la especie </span>
             	<ol class="listaLocalidades" id="localidades"><?php echo $localidades; ?></ol><br />
            </p>	
            
            <?php $porcRed = "100%"; 
			
			$mapaPDF =   "
            <table id='mapa_pnalr'>
                  <tr>  <!--   ****************  FILA 1 DEL MAPA   ****************** -->
                    <td colspan='2'><img src='$pnalr_f1_1' width='$porcRed' /></td>
                    <td><img src='$pnalr_f1_2' width='$porcRed'  /></td>
                    <td><img src='$pnalr_f1_3' width='$porcRed'  /></td>
                    <td><img src='$pnalr_f1_4' width='$porcRed'   /></td>
                  </tr>				  
                  
                  <tr> <!--   ****************  FILA 2 DEL MAPA   ****************** -->
                    <td colspan='2'><img src='$pnalr_f2_1' width='$porcRed'   /></td>
                    <td><img src='$pnalr_f2_2' width='$porcRed'   /></td>
                    <td><img src='$pnalr_f2_3' width='$porcRed'   /></td>
                    <td><img src='$pnalr_f2_4' width='$porcRed'   /></td>
                  </tr>
				  		
                  <tr> <!--   ****************  FILA 3 DEL MAPA   ****************** -->
                    <td><img src='$pnalr_f3_1a' width='$porcRed'  /></td>
                    <td><img src='$pnalr_f3_1b' width='$porcRed'  /></td>
                    <td><img src='$pnalr_f3_2' width='$porcRed'   /></td>
                    <td><img src='$pnalr_f3_3' width='$porcRed'   /></td>
                    <td><img src='$pnalr_f3_4' width='$porcRed'   /></td>
                  </tr>				  

                  
                  <tr> <!--   ****************  FILA 4  DEL MAPA   ****************** -->
                    <td><img src='$pnalr_f4_1a' width='$porcRed'  /></td>
                    <td><img src='$pnalr_f4_1b' width='$porcRed'  /></td>
                    <td><img src='$pnalr_f4_2' width='$porcRed'   /></td>
                    <td><img src='$pnalr_f4_3' width='$porcRed'   /></td>
                    <td><img src='$pnalr_f4_4'  width='$porcRed'  /></td>
                  </tr>


                  <tr> <!--   ****************  FILA 5 DEL MAPA   ****************** -->
                    <td><img src='$pnalr_f5_1a' width='$porcRed'   /></td>
                    <td><img src='$pnalr_f5_1b' width='$porcRed'   /></td>
                    <td><img src='$pnalr_f5_2' width='$porcRed'   /></td>
                    <td><img src='$pnalr_f5_3' width='$porcRed'   /></td>
                    <td><img src='$pnalr_f5_4' width='$porcRed'   /></td>
                  </tr>
                </table>";

				echo $mapaPDF;
				$nombreEspecie = especieConsultarNombre($id);
				$localidades = especieConsultarLocalidades($id);	
}


function mostrarMapaLocalidades($idLocalidad) {
// muestra la ubicación de la localidad en el PNALR 
			
			$rutaMapaBase = "images_mapaPNALR/pnalr_mapaBase.png";
			$rutaMapa = "images_mapaPNALR/"; // ruta carpeta donde está el mapa o sus cuadrículas	
			
			/* *****************       FILA 1 DEL MAPA  ******************** */
			$pnalr_f1_1 = $rutaMapa . "pnalr_f1_1.png";		$pnalr_f1_2 = $rutaMapa . "pnalr_f1_2.png";
			$pnalr_f1_3 = $rutaMapa . "pnalr_f1_3.png";	$pnalr_f1_4 = $rutaMapa . "pnalr_f1_4.png";

			$pnalr_f2_1 = $rutaMapa . "pnalr_f2_1.png";		$pnalr_f2_2 = $rutaMapa . "pnalr_f2_2.png";
			$pnalr_f2_3 = $rutaMapa . "pnalr_f2_3.png";	$pnalr_f2_4 = $rutaMapa . "pnalr_f2_4.png";

			$pnalr_f3_1a = $rutaMapa . "pnalr_f3_1a.png";	 $pnalr_f3_1b = $rutaMapa . "pnalr_f3_1b.png";
			$pnalr_f3_2 = $rutaMapa . "pnalr_f3_2.png";	$pnalr_f3_3 = $rutaMapa . "pnalr_f3_3.png";
			$pnalr_f3_4 = $rutaMapa . "pnalr_f3_4.png";

			$pnalr_f4_1a = $rutaMapa . "pnalr_f4_1a.png";	 $pnalr_f4_1b = $rutaMapa . "pnalr_f4_1b.png";
			$pnalr_f4_2 = $rutaMapa . "pnalr_f4_2.png";	$pnalr_f4_3 = $rutaMapa . "pnalr_f4_3.png";
			$pnalr_f4_4 = $rutaMapa . "pnalr_f4_4.png";

			$pnalr_f5_1a = $rutaMapa . "pnalr_f5_1a.png";	 $pnalr_f5_1b = $rutaMapa . "pnalr_f5_1b.png";
			$pnalr_f5_2 = $rutaMapa . "pnalr_f5_2.png";	$pnalr_f5_3 = $rutaMapa . "pnalr_f5_3.png";
			$pnalr_f5_4 = $rutaMapa . "pnalr_f5_4.png";
			
			// determino que imagen de la cuadricula corresponde a la localidad seleccionada
			switch ($idLocalidad)
			{
				case 1:
						$pnalr_f1_3 = $rutaMapa . consultarPresenciaLocalidad('Gran Roque'); break;
						
				case 3:
						$pnalr_f1_4 = $rutaMapa . consultarPresenciaLocalidad('Francisquí Arriba'); break;
						
				case 61:
						$pnalr_f1_4 = $rutaMapa . consultarPresenciaLocalidad('Francisquí'); break;
						
				case 6:
						$pnalr_f1_4 = $rutaMapa . consultarPresenciaLocalidad('Nordisquí'); break;
						
				case 7:
						$pnalr_f2_4 = $rutaMapa . consultarPresenciaLocalidad('Cayo Pirata'); break;
						
				case 8:
						//$pnalr_f1_3 = $rutaMapa . consultarPresenciaLocalidad('Rasquí'); break;
						
				case 9:
						$pnalr_f2_4 = $rutaMapa . consultarPresenciaLocalidad('Madrisquí'); break;
						
				case 11:
						$pnalr_f2_3 = $rutaMapa . consultarPresenciaLocalidad('Noronquí Arriba'); break;
						
				case 63:
						$pnalr_f2_3 = $rutaMapa . consultarPresenciaLocalidad('Noronquí'); break;
						
				case 13:
						$pnalr_f3_3 = $rutaMapa . consultarPresenciaLocalidad('Cayo Crasquí'); break;
						
				case 14:
						$pnalr_f4_3 = $rutaMapa . consultarPresenciaLocalidad('Isla Agustín'); break;
						
				case 16:
						$pnalr_f4_3 = $rutaMapa . consultarPresenciaLocalidad('Rabusquí'); break;
						
				case 19:
						$pnalr_f3_4 = $rutaMapa . consultarPresenciaLocalidad('Espenquí'); break;
						
				case 20:
						$pnalr_f2_2 = $rutaMapa . consultarPresenciaLocalidad('Los Canquises Arriba'); break;
						
				case 62:
						$pnalr_f2_2 = $rutaMapa . consultarPresenciaLocalidad('Los Canquises'); break;

				case 22:
						$pnalr_f4_2 = $rutaMapa . consultarPresenciaLocalidad('Isla Larga'); break;
						
				case 23:
						$pnalr_f4_2 = $rutaMapa . consultarPresenciaLocalidad('Yonquí'); break;
						
				case 24:
						$pnalr_f1_3 = $rutaMapa . consultarPresenciaLocalidad('Sarquí'); break;
						
				case 25:
						$pnalr_f3_1b = $rutaMapa . consultarPresenciaLocalidad('Cayo Carenero'); break;
						
				case 29:
						$pnalr_f5_1b = $rutaMapa . consultarPresenciaLocalidad('Pelona'); break;
						
				case 30:
						$pnalr_f4_1b = $rutaMapa . consultarPresenciaLocalidad('Mosquitoquí'); break;
						
				case 31:
						$pnalr_f3_1a = $rutaMapa . consultarPresenciaLocalidad('Selesquí'); break;
						
				case 32:
						$pnalr_f4_1a = $rutaMapa . consultarPresenciaLocalidad('Cayo Bequevé'); break;
						
				case 33:
						$pnalr_f5_1a = $rutaMapa . consultarPresenciaLocalidad('Cayo de Agua'); break;
						
				case 34:						
						$pnalr_f5_1b = $rutaMapa . consultarPresenciaLocalidad('Dos Mosquises Norte'); break;
						
				case 35:
						$pnalr_f5_1b = $rutaMapa . consultarPresenciaLocalidad('Dos Mosquises Sur'); break;
						
				case 60:
						$pnalr_f5_1b = $rutaMapa . consultarPresenciaLocalidad('Dos Mosquises'); break;

				case 47:
						$pnalr_f5_2 = $rutaMapa . consultarPresenciaLocalidad('Cayo Sal'); break;
						
				case 48:
						$pnalr_f5_3 = $rutaMapa . consultarPresenciaLocalidad('Nube Verde'); break;

				case 50:
						$pnalr_f5_4 = $rutaMapa . consultarPresenciaLocalidad('Sebastopol'); break;
						
				case 52:
						$pnalr_f1_4 = $rutaMapa . consultarPresenciaLocalidad('Cayo Vapor'); break;
						
				case 53:
						$pnalr_f3_4 = $rutaMapa . consultarPresenciaLocalidad('Esparquí'); break;
						
				case 54:
						$pnalr_f5_4 = $rutaMapa . consultarPresenciaLocalidad('María Uespen'); break;

				case 55:
						$pnalr_f5_3 = $rutaMapa . consultarPresenciaLocalidad('Boca de Cote'); break;
						
				case 56:
						$pnalr_f4_4 = $rutaMapa . consultarPresenciaLocalidad('Cuchillo'); break;
		
				default:
				echo "Localidad no contemplada";  break;
			}	
 ?>

            <!-- mapa dinámico de presencia/ausencia en el PNALR 
                   este mapa no lleva el encabezado de lista de localidades del mapa por especie  -->  
           
            <h1>Ubicaci&oacute;n</h1>   <!---  muestra el mapa de ubicación del cayo, llamado desde 
           																	localidades > localidadMostrarEspecies -->
            
              <?php $porcRed = "100%"; ?>
            <table id="mapa_pnalr" >
                  <tr>  <!--   ****************  FILA 1 DEL MAPA   ****************** -->
                    <td colspan="2"><img src="<?php echo $pnalr_f1_1; ?>"  width="<?php echo $porcRed; ?>" /></td>
                    <td><img src="<?php echo $pnalr_f1_2; ?>"   width="<?php echo $porcRed; ?>" /></td>
                    <td><img src="<?php echo $pnalr_f1_3; ?>"   width="<?php echo $porcRed; ?>" /></td>
                    <td><img src="<?php echo $pnalr_f1_4; ?>"   width="<?php echo $porcRed; ?>" /></td>
                  </tr>
                  
                  <tr> <!--   ****************  FILA 2 DEL MAPA   ****************** -->
                    <td colspan="2"><img src="<?php echo $pnalr_f2_1; ?>"   width="<?php echo $porcRed; ?>" /></td>
                    <td><img src="<?php echo $pnalr_f2_2; ?>"   width="<?php echo $porcRed; ?>" /></td>
                    <td><img src="<?php echo $pnalr_f2_3; ?>"   width="<?php echo $porcRed; ?>" /></td>
                    <td><img src="<?php echo $pnalr_f2_4; ?>"   width="<?php echo $porcRed; ?>" /></td>
                  </tr>
                  
                  <tr> <!--   ****************  FILA 3 DEL MAPA   ****************** -->
                    <td><img src="<?php echo $pnalr_f3_1a; ?>"   width="<?php echo $porcRed; ?>" /></td>
                    <td><img src="<?php echo $pnalr_f3_1b; ?>"   width="<?php echo $porcRed; ?>" /></td>
                    <td><img src="<?php echo $pnalr_f3_2; ?>"   width="<?php echo $porcRed; ?>" /></td>
                    <td><img src="<?php echo $pnalr_f3_3; ?>"   width="<?php echo $porcRed; ?>" /></td>
                    <td><img src="<?php echo $pnalr_f3_4; ?>"   width="<?php echo $porcRed; ?>" /></td>
                  </tr>
                  
                  <tr> <!--   ****************  FILA 4  DEL MAPA   ****************** -->
                    <td><img src="<?php echo $pnalr_f4_1a; ?>"   width="<?php echo $porcRed; ?>" /></td>
                    <td><img src="<?php echo $pnalr_f4_1b; ?>"   width="<?php echo $porcRed; ?>" /></td>
                    <td><img src="<?php echo $pnalr_f4_2; ?>"   width="<?php echo $porcRed; ?>" /></td>
                    <td><img src="<?php echo $pnalr_f4_3; ?>"   width="<?php echo $porcRed; ?>" /></td>
                    <td><img src="<?php echo $pnalr_f4_4; ?>"   width="<?php echo $porcRed; ?>" /></td>
                  </tr>
                  
                  <tr> <!--   ****************  FILA 5 DEL MAPA   ****************** -->
                    <td><img src="<?php echo $pnalr_f5_1a; ?>"   width="<?php echo $porcRed; ?>" /></td>
                    <td><img src="<?php echo $pnalr_f5_1b; ?>"   width="<?php echo $porcRed; ?>" /></td>
                    <td><img src="<?php echo $pnalr_f5_2; ?>"   width="<?php echo $porcRed; ?>" /></td>
                    <td><img src="<?php echo $pnalr_f5_3; ?>"   width="<?php echo $porcRed; ?>" /></td>
                    <td><img src="<?php echo $pnalr_f5_4; ?>"   width="<?php echo $porcRed; ?>" /></td>
                  </tr>
                </table>
<?php	
}
?>