<?php
// Funciones asociadas a Taxonomía utilizadas para crear el pdf con los resultados de las consultas

function consultarCitas($idEspecie) {  // consulta la lista de citas bibliográficas por $idEspecie
	// se busca en la tabla principal referencias
	$listaCitas = "";
	$query = "SELECT citas_bibliograficas 
					 FROM especies 
					 WHERE id= $idEspecie"; 
	$res = ejecutarQuerySQL($query);	
	$total = getNumFilas($res);
		
	if ($total == 0)
	   $citas = "No hay referencias registradas para esta especie.";
	else {				
			$actual = getFila($res);
			$listaCitas = $actual['citas_bibliograficas'];
	}		
	return $listaCitas;
}


function consultarReferencia($ancla) {  // consulta la información de la referencia bibliográfica según el ancla

	$query = "SELECT referencia 
					 FROM referencias 
					 WHERE id_ancla = '". $ancla ."'"; 
	
	$res = ejecutarQuerySQL($query);
	$total = getNumFilas($res);
	if ($total == 0) {				
		$referencia = "<span style='color: #36C;'> Falta agregar información de la referencia.</span>";
	} else {
		$actual = getFila($res);
		$referencia = $actual['referencia'];	
	}
	return $referencia;
}

function consultarReferenciaArticulo($ancla) {  // consulta si la referencia tiene artículo .pdf asociado
	$articulo = "";
	$query = "SELECT referencia_articulo 
					 FROM referencias 
					 WHERE id_ancla = '". $ancla . "'"; 
	$res = ejecutarQuerySQL($query);
	$total = getNumFilas($res);
	
	if ($total == 1) {				
			$actual = getFila($res);
			$articulo = $actual['referencia_articulo'];
	}		
	return $articulo;		
}

function citasReferenciasBibliograficas($citas) {  
// crear las anclas y consulta en la tabla Referencias la información de la ref. bibliográfica correspondiente 	

	// se separa por autor
	$citas2 = str_replace('<i>', '', $citas);	
	$citas2 = str_replace('</i>', '', $citas2);			
	$citas = explode(",", $citas);	
	$citas2 = explode(",", $citas2);	
	
	$lista = "";
	$listaReferencias = "";
	// se crea la lista de citas bibliográficas
	for ($i = 0; $i < count($citas); $i++) {
		
		$ancla = trim($citas[$i]);	
		$ancla2 = trim($citas2[$i]);	
		$referencia = consultarReferencia($ancla2);
		$articulo = "";
		$articulo = consultarReferenciaArticulo($ancla2);
		
		//$listaReferencias .= "<br /><strong>" . $ancla . "</strong><br />" . $referencia;
		$listaReferencias .= "<br />" . $referencia;
		
		
		if ($articulo <> "") {
			$listaReferencias .=  "<br /> <a href='../documents/articulos/" . $articulo . "'  title='ver artículo' 
								style='color:#36C;'> &raquo; ver artículo</a>"; 
		}
		
		$listaReferencias .= "<br />";
	}

	return $listaReferencias;
}


function citasBibliograficas($idEspecie) {  // consulta la lista de citas bibliográficas y la separa por autor 
	
	// se eliminan espacios de la lista de citas
	$citas = consultarCitas($idEspecie);
	$citas = substr ($citas, 0 , strlen($citas)-1);	  // se elimina el punto al final	
	$citasReferencias = citasReferenciasBibliograficas($citas);
		
	return $citasReferencias;
}


function consultarReportes($idEspecie) { // consulta las citas bibliog. de la especie dado el id

	$query = "SELECT  reportes    
						FROM colecciones_especies 
						WHERE  especies_id = $idEspecie"; 							
	$res = ejecutarQuerySQL($query);
	$total = getNumFilas($res);
	
	$citas=""; $i=1;	
	if ($total > 0 ) {
		 	$actual = getFila($res);
			$citas = $actual['reportes'];
	}
	
return $citas;
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




/* ****************  FUNCIONES PARA GENERAR LOS MAPAS ********************* */

function consultarDistribucionEspecies($id, $tabla)  {	
	// consulta la distribución para el PNALR por especie o género según $tabla
	
	$query = "SELECT * FROM $tabla WHERE especies_id=$id"; 
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


function mostrarMapaEspecies($id, $tabla) {
// crear el arreglo con la distribución de las localidades para el mapa de una especie 
				
			$res = consultarDistribucionEspecies($id, $tabla);
			$actual = getFila($res);			
			
			$rutaMapaBase = "../images_mapaPNALR/pnalr_mapaBase.png";
			$rutaMapa = "../images_mapaPNALR/"; // ruta carpeta donde está el mapa o sus cuadrículas
			
			/* *****************       FILA 1 DEL MAPA  ******************** */
			$pnalr_f1_1a = $rutaMapa . "pnalr_f1_1a.png";
			$pnalr_f1_1b = $rutaMapa . "pnalr_f1_1b.png";				  		
			$pnalr_f1_2 = $rutaMapa . "pnalr_f1_2.png";
					
			if ( $actual['Gran Roque'] == 0 ) {					
					$pnalr_f1_3 = $rutaMapa . consultarAusenciaLocalidad('Gran Roque'); }  
			else { 					
					$pnalr_f1_3 = $rutaMapa . consultarPresenciaLocalidad('Gran Roque'); 
					}
			
			if (  ( $actual['Francisquí'] == 0 )  and ( $actual['Francisquí Arriba'] == 0 )  and
				  ( $actual['Nordisquí'] == 0 )   and ( $actual['Cayo Vapor'] == 0 )  ) {					
					$pnalr_f1_4 = $rutaMapa . consultarAusenciaLocalidad('Francisquí Arriba'); }  
					
			elseif  (  ( ( $actual['Francisquí'] >= 1) or  ( $actual['Francisquí Arriba'] >= 1)  )   and 
						    ( $actual['Nordisquí'] == 0 ) and ( $actual['Cayo Vapor'] == 0 )  ) { 					
					$pnalr_f1_4 = $rutaMapa . consultarPresenciaLocalidad('Francisquí Arriba'); 
					} 
					
			elseif  (  ( ( $actual['Francisquí'] == 0) or ( $actual['Francisquí Arriba'] == 0) ) and 
						  ( $actual['Nordisquí'] >= 1 ) and ( $actual['Cayo Vapor'] == 0 ) ) { 					
					$pnalr_f1_4 = $rutaMapa . consultarPresenciaLocalidad('Nordisquí'); 
					}
					 
			elseif  (  ( ( $actual['Francisquí'] == 0) or ( $actual['Francisquí Arriba'] == 0) ) and 
						 ( $actual['Nordisquí'] == 0 ) and ( $actual['Cayo Vapor'] >= 1 ) ) { 					
					$pnalr_f1_4 = $rutaMapa . consultarPresenciaLocalidad('Cayo Vapor'); 
					}  
					
			elseif  (  ( ( $actual['Francisquí'] >= 1)  or ( $actual['Francisquí Arriba'] >= 1) )  and 
						 ( $actual['Nordisquí'] >= 1 ) and ( $actual['Cayo Vapor'] == 0 ) ) { 					
					$pnalr_f1_4 = $rutaMapa . "pnalr_f1_4_p_110.png"; 
					} 
					
			elseif  (  ( ( $actual['Francisquí'] >= 1) or ( $actual['Francisquí Arriba'] >= 1) ) and 
						 ( $actual['Nordisquí'] == 0) and ( $actual['Cayo Vapor'] >= 1 ) ) { 					
					$pnalr_f1_4 = $rutaMapa . "pnalr_f1_4_p_101.png";  
					} 
					 
			elseif  ( ( $actual['Francisquí Arriba'] == 0) and ($actual['Nordisquí'] >= 1) and ($actual['Cayo Vapor'] >= 1) ) { 					
					$pnalr_f1_4 = $rutaMapa  . "pnalr_f1_4_p_011.png";  
					} 
					 
			elseif  (  ( ( $actual['Francisquí'] >= 1) or ( $actual['Francisquí Arriba'] >= 1) ) and 
						 ( $actual['Nordisquí'] >= 1 ) and ( $actual['Cayo Vapor'] >= 1 )  ) { 					
					$pnalr_f1_4 = $rutaMapa  . "pnalr_f1_4_p.png";  
					}
					
			/* *****************       FILA 2 DEL MAPA  ******************** */
			$pnalr_f2_1a = $rutaMapa . "pnalr_f2_1a.png";
			$pnalr_f2_1b = $rutaMapa . "pnalr_f2_1b.png";	
					
			if (  ($actual['Los Canquises'] == 0 )  and ($actual['Los Canquises Arriba'] == 0 ) ) {					
					$pnalr_f2_2 = $rutaMapa . consultarAusenciaLocalidad('Los Canquises Arriba'); }  
			else { 					
					$pnalr_f2_2 = $rutaMapa . consultarPresenciaLocalidad('Los Canquises Arriba');  
					}
								
							
			if ( ($actual['Noronquí'] == 0 ) and ($actual['Noronquí Arriba'] == 0 ) ) {					
					$pnalr_f2_3 = $rutaMapa . consultarAusenciaLocalidad('Noronquí Arriba'); }  
			else { 					
					$pnalr_f2_3 = $rutaMapa . consultarPresenciaLocalidad('Noronquí Arriba');  
					}
			
			
			if ( ( $actual['Madrisquí'] == 0 ) and ( $actual['Cayo Pirata'] == 0 ) ) {					
					$pnalr_f2_4 = $rutaMapa . consultarAusenciaLocalidad('Madrisquí'); }  
			
			elseif ( ( $actual['Madrisquí'] >= 1 ) and ( $actual['Cayo Pirata'] == 0 ) ) {					
					$pnalr_f2_4 = $rutaMapa . "pnalr_f2_4_p_10.png";  
					}  
			
			elseif ( ( $actual['Madrisquí'] == 0 ) and ( $actual['Cayo Pirata'] >= 1 ) ) {					
					$pnalr_f2_4 = $rutaMapa . "pnalr_f2_4_p_01.png";  
					} 
			
			elseif ( ( $actual['Madrisquí'] >= 1 ) and ( $actual['Cayo Pirata'] >= 1 ) ) {					
					$pnalr_f2_4 = $rutaMapa . "pnalr_f2_4_p.png"; 
					}
					
					
			/* *****************       FILA 3 DEL MAPA  ******************** */
			
			$pnalr_f3_1a = $rutaMapa . consultarAusenciaLocalidad('Selesquí');  // localidad sin especie colectada
			
					
			if ( $actual['Cayo Carenero'] == 0 ) {					
					$pnalr_f3_1b = $rutaMapa . consultarAusenciaLocalidad('Cayo Carenero'); }  
			else { 					
					$pnalr_f3_1b = $rutaMapa . consultarPresenciaLocalidad('Cayo Carenero'); 
					}
					
			if ( ( $actual['Yonquí'] == 0 )   and ( $actual['Sarquí'] == 0 ) and ( $actual['Espenquí'] == 0 )  ) {					
					$pnalr_f3_2 = $rutaMapa . consultarAusenciaLocalidad('Espenquí'); }  
					
			elseif  (  ( $actual['Yonquí'] == 0 ) and ( $actual['Sarquí'] == 0 )  and ( $actual['Espenquí'] >= 1) ) { 					
					$pnalr_f3_2 = $rutaMapa . consultarPresenciaLocalidad('Espenquí');  
					} 
					
			elseif  ( ( $actual['Yonquí'] >= 1 ) and ( $actual['Sarquí'] == 0 ) and ( $actual['Espenquí'] == 0) ) { 					
					$pnalr_f3_2 = $rutaMapa . consultarPresenciaLocalidad('Yonquí');  
					}
					 
			elseif  ( ( $actual['Espenquí'] == 0) and ( $actual['Yonquí'] == 0 ) and ( $actual['Sarquí'] >= 1 ) ) { 					
					$pnalr_f3_2 = $rutaMapa . consultarPresenciaLocalidad('Sarquí');  
					}  
					
			elseif  ( ( $actual['Yonquí'] >= 1 ) and ( $actual['Sarquí'] == 0 ) and ( $actual['Espenquí'] >= 1)) { 					
					$pnalr_f3_2 = $rutaMapa . "pnalr_f3_2_p_101.png";  
					} 
					
			elseif  ( ( $actual['Yonquí'] == 0) and ( $actual['Sarquí'] >= 1 ) and ( $actual['Espenquí'] >= 1)) { 					
					$pnalr_f3_2 = $rutaMapa . "pnalr_f3_2_p_011.png";  
					} 
					 
			elseif  ( ( $actual['Yonquí'] >= 1 ) and ( $actual['Sarquí'] >= 1 ) and ( $actual['Espenquí'] == 0) ) { 					
					$pnalr_f3_2 = $rutaMapa  . "pnalr_f3_2_p_110.png";  
					} 
					 
			elseif  ( ( $actual['Yonquí'] >= 1 ) and ( $actual['Sarquí'] >= 1 ) and ( $actual['Espenquí'] >= 1) ) { 					
					$pnalr_f3_2 = $rutaMapa  . "pnalr_f3_2_p.png";  
					}
									
					
			if ( $actual['Cayo Crasquí'] == 0 ) {					
					$pnalr_f3_3 = $rutaMapa . consultarAusenciaLocalidad('Cayo Crasquí'); }  
			else { 					
					$pnalr_f3_3 = $rutaMapa . consultarPresenciaLocalidad('Cayo Crasquí');  
					}
			
							
			if ( $actual['Esparquí'] == 0 ) {					
					$pnalr_f3_4 = $rutaMapa . consultarAusenciaLocalidad('Esparquí'); }  
			else { 					
					$pnalr_f3_4 = $rutaMapa . consultarPresenciaLocalidad('Esparquí');  
					}
					
			/* *****************       FILA 4 DEL MAPA  ******************** */
			
			if ( $actual['Cayo Bequevé'] == 0 ) {					
					$pnalr_f4_1a = $rutaMapa . consultarAusenciaLocalidad('Cayo Bequevé'); }  
			else { 					
					$pnalr_f4_1a = $rutaMapa . consultarPresenciaLocalidad('Cayo Bequevé'); 
					}
					
			if ( $actual['Mosquitoquí'] == 0 ) {					
					$pnalr_f4_1b = $rutaMapa . consultarAusenciaLocalidad('Mosquitoquí'); }  
			else { 					
					$pnalr_f4_1b = $rutaMapa . consultarPresenciaLocalidad('Mosquitoquí');  
					}
					
			if ( $actual['Isla Larga'] == 0 ) {	// faltó Isla Fernando en localidades de prueba en la bdd
					$pnalr_f4_2 = $rutaMapa . consultarAusenciaLocalidad('Isla Larga'); }  
			else { 					
					$pnalr_f4_2 = $rutaMapa . consultarPresenciaLocalidad('Isla Larga');  
					}
			
						
			if ( ( $actual['Sanquí'] == 0 ) and ( $actual['Rabusquí'] == 0 ) ) {					
					$pnalr_f4_3 = $rutaMapa . consultarAusenciaLocalidad('Rabusquí'); }  
			
			elseif ( ( $actual['Sanquí'] >= 1 ) and ( $actual['Rabusquí'] == 0 ) ) {					
					$pnalr_f4_3 = $rutaMapa . consultarPresenciaLocalidad('Sanquí'); 
					}  
			
			elseif ( ( $actual['Sanquí'] == 0 ) and ( $actual['Rabusquí'] >= 1 ) ) {					
					$pnalr_f4_3 = $rutaMapa . consultarPresenciaLocalidad('Rabusquí'); 
					} 
			
			elseif ( ( $actual['Sanquí'] >= 1 ) and ( $actual['Rabusquí'] >= 1 ) ) {					
					$pnalr_f4_3 = $rutaMapa . "pnalr_f4_3_p.png";  
					}
					
			$pnalr_f4_4 = $rutaMapa . consultarAusenciaLocalidad('Cuchillo');	 // localidad sin especie colectada
					
															

			/* *****************       FILA 5   DEL MAPA  ******************** */
			
			if ( $actual['Cayo de Agua'] == 0 ) {					
					$pnalr_f5_1a = $rutaMapa . consultarAusenciaLocalidad('Cayo de Agua'); }  
			else { 					
					$pnalr_f5_1a = $rutaMapa . consultarPresenciaLocalidad('Cayo de Agua');  
					}
			
			
			if ( ( $actual['Dos Mosquises'] == 0 ) and
				 ( $actual['Dos Mosquises Norte'] == 0 ) and ( $actual['Dos Mosquises Sur'] == 0 )  ) {					
					$pnalr_f5_1b = $rutaMapa . consultarAusenciaLocalidad('Dos Mosquises Norte'); }  
					
			elseif  ( ( $actual['Dos Mosquises'] >= 1 ) or
					( $actual['Dos Mosquises Norte'] >= 1 ) and ( $actual['Dos Mosquises Sur'] == 0 )  ) {	
					$pnalr_f5_1b = $rutaMapa . consultarPresenciaLocalidad('Dos Mosquises Norte');  
					} 
					
			elseif  ( ( $actual['Dos Mosquises'] >= 1 ) or  
					( $actual['Dos Mosquises Norte'] == 0 ) and ( $actual['Dos Mosquises Sur'] >= 1 ) ) {		
					$pnalr_f5_1b = $rutaMapa . consultarPresenciaLocalidad('Dos Mosquises Sur');  
					}
					
			elseif  ( ( $actual['Dos Mosquises Norte'] >= 1 ) and ( $actual['Dos Mosquises Sur'] >= 1 )  ) {				
					$pnalr_f5_1b = $rutaMapa . "pnalr_f5_1b_p_110.png";  
					}
			

			if ( $actual['Cayo Sal'] == 0 ) {					
					$pnalr_f5_2 = $rutaMapa . consultarAusenciaLocalidad('Cayo Sal'); }  
			else { 					
					$pnalr_f5_2 = $rutaMapa . consultarPresenciaLocalidad('Cayo Sal');  
					}
			
			
			if ( ( $actual['Boca de Cote'] == 0 ) ) {					
					$pnalr_f5_3 = $rutaMapa . consultarAusenciaLocalidad('Boca de Cote'); }  
					
			else {				
					$pnalr_f5_3 = $rutaMapa . consultarPresenciaLocalidad('Boca de Cote');  
					}
			
						
			if ( ( $actual['Sebastopol'] == 0 ) and ( $actual['María Uespen'] == 0 ) ) {					
					$pnalr_f5_4 = $rutaMapa . consultarAusenciaLocalidad('Sebastopol'); }  
			
			elseif ( ( $actual['Sebastopol'] >= 1 ) and ( $actual['María Uespen'] == 0 ) ) {					
					$pnalr_f5_4 = $rutaMapa . "pnalr_f5_4_p_01.png";  
					}  
			
			elseif ( ( $actual['Sebastopol'] == 0 ) and ( $actual['María Uespen'] >= 1 ) ) {					
					$pnalr_f5_4 = $rutaMapa . "pnalr_f5_4_p_10.png";  
					} 
			
			elseif ( ( $actual['Sebastopol'] >= 1 ) and ( $actual['María Uespen'] >= 1 ) ) {					
					$pnalr_f5_4 = $rutaMapa . "pnalr_f5_4_p.png";  
					}			
	
			$porcRedf1 = " height='198px' ";
			$porcRedf2 = " height='163.2px' ";
			$porcRedf3 = " height='150.6px' ";
			$porcRedf4 = " height='204px' ";
			$porcRedf5 = " height='540px' ";
			$margin = " style='padding:0px; margin:0px;' ";
			
			$mapaPDF =   "
            <table id='mapa_pnalr'>
                  <tr>
                    <td $margin><img src='$pnalr_f1_1a' $porcRedf1 /></td>
                    <td $margin><img src='$pnalr_f1_1b' $porcRedf1 /></td>					
                    <td $margin><img src='$pnalr_f1_2' $porcRedf1 /></td>
                    <td $margin><img src='$pnalr_f1_3' $porcRedf1 /></td>
                    <td $margin><img src='$pnalr_f1_4' $porcRedf1 /></td>
                  </tr>				  
                  
                  <tr>
                    <td $margin><img src='$pnalr_f2_1a' $porcRedf2 /></td>
                    <td $margin><img src='$pnalr_f2_1b' $porcRedf2 /></td>							
                    <td $margin><img src='$pnalr_f2_2' $porcRedf2 /></td>
                    <td $margin><img src='$pnalr_f2_3' $porcRedf2 /></td>
                    <td $margin><img src='$pnalr_f2_4' $porcRedf2 /></td>
                  </tr>
				  		
                  <tr>
                    <td $margin><img src='$pnalr_f3_1a' $porcRedf3 /></td>
                    <td $margin><img src='$pnalr_f3_1b' $porcRedf3 /></td>
                    <td $margin><img src='$pnalr_f3_2' $porcRedf3 /></td>
                    <td $margin><img src='$pnalr_f3_3' $porcRedf3 /></td>
                    <td $margin><img src='$pnalr_f3_4' $porcRedf3 /></td>
                  </tr>				  

                  
                  <tr>
                    <td $margin><img src='$pnalr_f4_1a' $porcRedf4 /></td>
                    <td $margin><img src='$pnalr_f4_1b' $porcRedf4 /></td>
                    <td $margin><img src='$pnalr_f4_2' $porcRedf4 /></td>
                    <td $margin><img src='$pnalr_f4_3' $porcRedf4 /></td>
                    <td $margin><img src='$pnalr_f4_4' $porcRedf4 /></td>
                  </tr>

                  <tr>
                    <td $margin><img src='$pnalr_f5_1a' $porcRedf5 /></td>
                    <td $margin><img src='$pnalr_f5_1b' $porcRedf5 /></td>
                    <td $margin><img src='$pnalr_f5_2' $porcRedf5 /></td>
                    <td $margin><img src='$pnalr_f5_3' $porcRedf5 /></td>
                    <td $margin><img src='$pnalr_f5_4' $porcRedf5 /></td>
                  </tr>
                </table>";
				
		return ($mapaPDF);
}


function consultarMapaImagenLocalidad($idLocalidad)  {	
	// consulta la imagen del mini-mapa para una localidad
	
		$query = "SELECT imagen_mapa FROM localidades WHERE id = $idLocalidad"; 
		
		$res = ejecutarQuerySQL($query);
		$actual = getFila($res);
		
	return($actual['imagen_mapa']);
}

function mostrarUbicacionLocalidad($idLocalidad) {
// muestra la ubicación de la localidad en el PNALR 
			
			$rutaMapa = "../images_mapaPNALR/"; // ruta carpeta donde está el mapa o sus cuadrículas	
			
			/* *****************       FILA 1 DEL MAPA  ******************** */
			$pnalr_f1_1a = $rutaMapa . "pnalr_f1_1a.png";  $pnalr_f1_1b = $rutaMapa . "pnalr_f1_1b.png";
			$pnalr_f1_2 = $rutaMapa . "pnalr_f1_2.png";
			$pnalr_f1_3 = $rutaMapa . "pnalr_f1_3.png";	$pnalr_f1_4 = $rutaMapa . "pnalr_f1_4.png";
	
			/* *****************       FILA 2 DEL MAPA  ******************** */
			$pnalr_f2_1a = $rutaMapa . "pnalr_f2_1a.png";  $pnalr_f2_1b = $rutaMapa . "pnalr_f2_1b.png";
			$pnalr_f2_2 = $rutaMapa . "pnalr_f2_2.png";
			$pnalr_f2_3 = $rutaMapa . "pnalr_f2_3.png";	$pnalr_f2_4 = $rutaMapa . "pnalr_f2_4.png";

			/* *****************       FILA 3 DEL MAPA  ******************** */
			$pnalr_f3_1a = $rutaMapa . "pnalr_f3_1a.png";	 $pnalr_f3_1b = $rutaMapa . "pnalr_f3_1b.png";
			$pnalr_f3_2 = $rutaMapa . "pnalr_f3_2.png";	$pnalr_f3_3 = $rutaMapa . "pnalr_f3_3.png";
			$pnalr_f3_4 = $rutaMapa . "pnalr_f3_4.png";

			/* *****************       FILA 4 DEL MAPA  ******************** */
			$pnalr_f4_1a = $rutaMapa . "pnalr_f4_1a.png";	 $pnalr_f4_1b = $rutaMapa . "pnalr_f4_1b.png";
			$pnalr_f4_2 = $rutaMapa . "pnalr_f4_2.png";	$pnalr_f4_3 = $rutaMapa . "pnalr_f4_3.png";
			$pnalr_f4_4 = $rutaMapa . "pnalr_f4_4.png";

			/* *****************       FILA 5 DEL MAPA  ******************** */
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
	
			$porcRedf1 = " height='198px' ";
			$porcRedf2 = " height='163.2px' ";
			$porcRedf3 = " height='150.6px' ";
			$porcRedf4 = " height='204px' ";
			$porcRedf5 = " height='540px' ";
			$margin = " style='padding:0px; margin:0px;' ";
			
			$mapaPDF =   "
            <table id='mapa_pnalr'>
                  <tr>
                    <td $margin><img src='$pnalr_f1_1a' $porcRedf1 /></td>
                    <td $margin><img src='$pnalr_f1_1b' $porcRedf1 /></td>					
                    <td $margin><img src='$pnalr_f1_2' $porcRedf1 /></td>
                    <td $margin><img src='$pnalr_f1_3' $porcRedf1 /></td>
                    <td $margin><img src='$pnalr_f1_4' $porcRedf1 /></td>
                  </tr>				  
                  
                  <tr>
                    <td $margin><img src='$pnalr_f2_1a' $porcRedf2 /></td>
                    <td $margin><img src='$pnalr_f2_1b' $porcRedf2 /></td>							
                    <td $margin><img src='$pnalr_f2_2' $porcRedf2 /></td>
                    <td $margin><img src='$pnalr_f2_3' $porcRedf2 /></td>
                    <td $margin><img src='$pnalr_f2_4' $porcRedf2 /></td>
                  </tr>
				  		
                  <tr>
                    <td $margin><img src='$pnalr_f3_1a' $porcRedf3 /></td>
                    <td $margin><img src='$pnalr_f3_1b' $porcRedf3 /></td>
                    <td $margin><img src='$pnalr_f3_2' $porcRedf3 /></td>
                    <td $margin><img src='$pnalr_f3_3' $porcRedf3 /></td>
                    <td $margin><img src='$pnalr_f3_4' $porcRedf3 /></td>
                  </tr>				  

                  
                  <tr>
                    <td $margin><img src='$pnalr_f4_1a' $porcRedf4 /></td>
                    <td $margin><img src='$pnalr_f4_1b' $porcRedf4 /></td>
                    <td $margin><img src='$pnalr_f4_2' $porcRedf4 /></td>
                    <td $margin><img src='$pnalr_f4_3' $porcRedf4 /></td>
                    <td $margin><img src='$pnalr_f4_4' $porcRedf4 /></td>
                  </tr>

                  <tr>
                    <td $margin><img src='$pnalr_f5_1a' $porcRedf5 /></td>
                    <td $margin><img src='$pnalr_f5_1b' $porcRedf5 /></td>
                    <td $margin><img src='$pnalr_f5_2' $porcRedf5 /></td>
                    <td $margin><img src='$pnalr_f5_3' $porcRedf5 /></td>
                    <td $margin><img src='$pnalr_f5_4' $porcRedf5 /></td>
                  </tr>
                </table>";
				
		return ($mapaPDF);
}
?>