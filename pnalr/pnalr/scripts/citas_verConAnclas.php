<?php 
/* procedimientos varios para consultar información de las citas y referencias bibliográficas */

/* *****  SE UTILIZAN los campos de la tabla referencias_anterior ************** */
function consultarCita($idEspecie, &$autorRef, &$agno) {  // consulta  autor y  año de una cita bibliog. para $idEspecie

	// se busca en la tabla principal referencias	
	  $query = "SELECT autorRef, agno FROM referencias WHERE id= $idEspecie"; 
	  $res = ejecutarQuerySQL($query);
	  $actual = getFila($res);
	  $autorRef = $actual['autorRef'];    $agno = $actual['agno'];
}

function consultarCitaxId($id, &$autorRef, &$agno) {  // consulta  autor y  año de una cita bibliog. para el autor $id

	// se busca en la tabla principal referencias	
	  $query = "SELECT autorRef, agno FROM referencias WHERE id= $id"; 
	  $res = ejecutarQuerySQL($query);
	  $actual = getFila($res);
	  $autorRef = $actual['autorRef'];    $agno = $actual['agno'];
}



/* ***  SE UTILIZA EL CAMPO citas_bibliograficas de la tabla ESPECIE y la tabla REFERENCIAS  ******* */

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


function citasLimpiaryCrearListaAnclas($citas) {  
// sustituye caracteres de la cita original por los usados en el ancla de  la pági Referencias 	

	$citas2 = "";
	$citas2 = str_replace(' ', '', $citas);	
	$citas2 = str_replace('.', '', $citas2);	
	$citas2 = str_replace('<i>', '_', $citas2);	$citas2 = str_replace('</i>', '', $citas2);	
	$citas2 = str_replace('&', '_', $citas2);
	$citas2 = str_replace('(', '_', $citas2);
	$citas2 = str_replace(')', '', $citas2);
	// se separa por autor
	$citas = explode(",", $citas);	
	$citas2 = explode(",", $citas2);		
	$citasAnclas = "";
	// se crea la lista de citas bibliográficas con anclas y enlaces a la página Referencias
	for ($i = 0; $i < count($citas); $i++) {
		$ancla = trim($citas2[$i]);
		$ref = trim($citas[$i]);
		$citasAnclas .= "&nbsp;<a href='referencias.php#" . $ancla . "'  title=' consultar referencia: " . $ref  ."'
								style='color:#36C;'>" . $ref . "</a>"; 
		$citasAnclas .= ",";  
		}
		$citasAnclas = substr ($citasAnclas, 0 , strlen($citasAnclas)-1);		
		$citasAnclas .= ".";
		
	return $citasAnclas;
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
	// se crea la lista de citas bibliográficas con anclas y enlaces a la página Referencias
	for ($i = 0; $i < count($citas); $i++) {
		
		$ancla = trim($citas[$i]);	
		$ancla2 = trim($citas2[$i]);	
		$referencia = consultarReferencia($ancla2);
		$articulo = "";
		$articulo = consultarReferenciaArticulo($ancla2);
		
		$listaReferencias .= "<br /><strong>" . $ancla . "</strong><br />" . $referencia;
		//$listaReferencias .= "<br />" . $referencia;
		
		if ($articulo <> "") {
			$listaReferencias .=  "<br /> <a href='documents/articulos/" . $articulo . "'  title='ver artículo' 
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
	//$citasAnclas = citasLimpiaryCrearListaAnclas($citas);  // se crea la lista de citas con las anclas y los enlaces
	$citasReferencias = citasReferenciasBibliograficas($citas);
		
	return $citasReferencias;
}


function localidadConsultarCitasxLocalidad($idLocalidad, $idEspecie) {  // consulta las citas que reportan la localidad $idLocalidad para la especie $idEspecie
// NO SE ESTÁ UTILIZANDO, se sustituye por consultarCitasReportes

	// se busca en la tabla principal localidades_distribucion
	$query = "SELECT referencias_id, especies_id, localidades_id FROM localidades_distribucion 
						WHERE localidades_id > 0 AND localidades_id = $idLocalidad AND especies_id = $idEspecie"; 
	$res = ejecutarQuerySQL($query);	
	$total = getNumFilas($res);

	$citas=""; $i = 1;
	if ($total > 0 ){
		 while ($i <= $total) {
		 	$actual = getFila($res);
			$valores = $actual['referencias_id'];
			if (strpos($valores, ",") ) {
				$citas = " (";
				  // caso del reporte de varios autores para la especie y la localidad
				$valores = explode(",", $valores);
				$total2 = count($valores);  $j=1; // inicia en 1 para evitar el caracter de control del inicio
				$autorRef = ""; $agno="";
				while ($j < $total2) {						 	
					  consultarCita($valores[$j], $autorRef, $agno);					 
					  $citas = $citas . $autorRef . ", " . $agno;
					  if ($j < $total2-1) $citas = $citas . "; "; 
					  $j++;
			   }
				$citas = $citas . ")";	
		}
		else
		{  // caso del reporte de un sólo autor para la especie y la localidad				  
				  $valores = explode(",", $valores);
				  consultarCita($valores[0], $autorRef, $agno);
				  if ($autorRef <>"") $citas = " (" . $autorRef . ", " . $agno . ")";		
		}		
		$i++;
		 }
	}
	
return $citas;
}

function localidadConsultarCitasxAutor($res, $idEspecie) {  // consulta las localidades reportadas por los resultados de la consulta $res para la especie $idEspecie

	// creando el arreglo de autores para la especie 	
	$total = getNumFilas($res);  $localidades="";
	
	$arrayAL1[20] =  array(	"autor" => 0, 
											"idlocalidad" => 0, 
											"localidad" => "");
	$i=0; $pos = 0;
	while ($i < $total) {
		$actual = getFila($res);
		$autores = $actual["referencias_id"];
		$autores = explode(",", $autores);
		
		for ($j = 1; $j < count($autores); $j++) {
			if (!(in_array($autores[$j], $arrayAL1) )) {
					$arrayAL1[$pos]["autor"] = $autores[$j]; 
					$arrayAL1[$pos]["idlocalidad"] = $actual["localidades_id"];
					$arrayAL1[$pos]["localidad"] = localidadConsultarNombre($actual["localidades_id"]);
					$pos++;
				}
		}
	$i++;
	}
	
	foreach ($arrayAL1 as $key => $row) {
		$autor[$key]  = $row["autor"];
		$idlocalidad[$key] = $row["idlocalidad"];
		$localidad[$key] = $row["localidad"];
	}

	array_multisort($autor, SORT_ASC, $localidad, SORT_ASC,  $arrayAL1);
	// print_r($arrayAL1) . "<br />";   // muestra cada línea del arreglo $arrayAL1				

	// armamos la lista de autores y localidades que reportan
	$localidades = ""; $total = count($arrayAL1);
	$idAutor = 0;
	for ($k = 1; $k < $total; $k++) {
		
		if ($idAutor != $arrayAL1[$k]["autor"])
		{	// nuevo autor
			  if ($k>1)  $localidades .= "); ";  // separación entre autores
			  $autorRef = ""; $agno = "";
			  consultarCitaxId($arrayAL1[$k]["autor"], $autorRef, $agno);
			  $localidades .= "<b>". $autorRef . ", " . $agno . " </b> (";
			  $localidades .= $arrayAL1[$k]["localidad"];	
		} 
		else { // localidades para el mismo autor
			  $localidades .= ", " . $arrayAL1[$k]["localidad"];
		}
		$idAutor = $arrayAL1[$k]["autor"] ;
	}	 // end for
	if ($total > 1 )  $localidades .= ").";
	else $localidades = "";
	
return $localidades;
}

function consultarCitasReportes($idEspecie) { //consulta campo reportes de la tabla colecciones_especies 
		 
	$query = "SELECT  reportes    
						FROM colecciones_especies 
						WHERE  especies_id = $idEspecie"; 							
	$res = ejecutarQuerySQL($query);
	$total = getNumFilas($res);
	$citas="<b>No hay reportes para la especie.</b>";
	
	$citas="";	
	if ($total > 0 ) {
		 	$actual = getFila($res);
			$citas = $actual['reportes'];
	}
	
return $citas;
}


function reportesLimpiaryCrearAnclas($citas) {  
// sustituye caracteres y expresiones de la lista de reportes por los usados en el ancla de  la página Referencias 	

	$citas = str_replace('),', ').', $citas);
	$citas2 = str_replace('Sin especificar localización: ', '', $citas);
	$citas2 = str_replace(' ', '', $citas2);
	//$citas2 = substr ($citas2, 0 , strlen($citas2)-1); // se elimina el . al final
	$citas2 = str_replace('<i>', '_', $citas2);	$citas2 = str_replace('</i>', '', $citas2);
	$citas2 = str_replace('&', '_', $citas2);
	
	// se separa la lista por el . de separación de cada reporte
	$citas2 = explode(";", $citas2);	
	
    $citasAnclas = "";
	for ($i = 0; $i < count($citas2); $i++) {
		$ref = trim($citas2[$i]);		
		$pos = strpos($ref, "("); // posición del ( en la referencia
		if ( !$pos === false)  {  // hay paréntesis en el reporte
			if (!is_numeric($ref[$pos+1]) ) {
				$ref = substr ($ref, 0 , $pos);  // en el paréntesis hay una lista de localidades
				$ref2 = explode(",", $ref);
				$ref = $ref2[0] . "(" . $ref2[1] . ")"; 
			}
		$ancla = str_replace('(', '_', $ref);
		$ancla = str_replace(')', '', $ancla);
		$ancla = str_replace(',', '.', $ancla);
		}
		$citasAnclas .= $ancla . ".";		
		}

	// se crea la lista de reportes bibliográficos con anclas y enlaces a la página Referencias		
	$citasAnclas = explode(".", $citasAnclas);
	$citas = explode(";", $citas);
	// se eliminan posible duplicados en los arreglos
	$citasAnclas = array_unique($citasAnclas);
	$citas = array_unique($citas);	
	// se cuentan la cantidad de referencias
	$n = count($citasAnclas) -1;
	$citasReportes = "";
	for ($i = 0; $i < $n; $i++) {		
		$ancla = $citasAnclas[$i];
		$ref = trim($citas[$i]);
		
		// verificación de la existencia de : en el reporte
		$pos = strpos($ref, ":"); // posición del : del sin especificar localización
		if ( !$pos === false)  {  // hay : en el reporte, se separa la cita la cadena previa
				$ref2 = explode(": ", $ref);
				$refa = $ref2[0] . ": ";  $refb = $ref2[1]; 
				//$citasReportes .= $refa  ."<a href='referencias.php#" . $ancla . "'  
						//title=' consultar referencia: " . $ref  ."' style='color:#36C;'>" . $refb . "</a>"; 
				$citasReportes .= $refa  . $refb; 
		} else {
		// verificación de la existencia de ( en el reporte 
		$pos = strpos($ref, "(");  // posición del ( en el reporte

		if ( !$pos === false)  {  // hay paréntesis en el reporte, se separa cita de localidades
			if (!is_numeric($ref[$pos+1]) ) {
				$ref2 = explode(" (", $ref);
				$refa = $ref2[0];  $refb = " (" . $ref2[1]; 
			} else {
				$refa = $ref;  $refb = ""; 			
			}
		}
		// se crea la lista de enlaces y anclas para los reportes 	
		//$citasReportes .= "<a href='referencias.php#" . $ancla . "'  title=' consultar referencia: " . $ref  ."'
								//style='color:#36C;'>" . $refa . "</a>" . $refb . "&nbsp;"; 	
		$citasReportes .=  $refa . $refb . ".&nbsp;"; 		
		}
		}
		
	return $citasReportes;
}


function citasReportes($idEspecie) {  
// consulta la lista de citas bibliográficas asociadas a los reportes y la separa por autor 
	
	// se eliminan espacios de la lista de citas
	$citas = consultarCitasReportes($idEspecie);
	$citasAnclas = "";
	if ($citas <> "") {
	$citas = substr ($citas, 0 , strlen($citas)-1);	  // se elimina el punto al final	
	$citasAnclas = reportesLimpiaryCrearAnclas($citas);  // se crea la lista de citas con las anclas y los enlaces
	}
		
	return $citasAnclas;
}


function consultarCitasSinLocalidad($idEspecie) { // consulta las citas para $idEspecie que no indican localidades 
		 
	$query = "SELECT  localidades_id, especies_id, referencias_id    
						FROM localidades_distribucion 
						WHERE  especies_id = $idEspecie AND referencias_id <>'' AND localidades_id = 0"; 							
	$res = ejecutarQuerySQL($query);
	$total = getNumFilas($res);
	
	$citas=""; $i=1;	
	if ($total > 0 ) {
		 $citas="<b>Sin especificar localización: </b>";	
		 while ($i <= $total) {
		 	$actual = getFila($res);
			$valores = $actual['referencias_id'];
			if (strpos($valores, ",") ) {
				  // caso del reporte de varios autores para la especie y la localidad
				$valores = explode(",", $valores);
				$total2 = count($valores);  $j=1; // inicia en 1 para evitar el caracter de control del inicio
				$autorRef = ""; $agno="";
				while ($j < $total2) {						 	
					  consultarCita($valores[$j], $autorRef, $agno);					 
					  $citas = $citas . $autorRef . " (" . $agno . ")";
					  if ($j < $total2-1) $citas = $citas . "; "; 
					  $j++;
			   }			   
		}
		else
		{  // caso del reporte de un sólo autor para la especie y la localidad				  
				  $valores = explode(",", $valores);
				  consultarCita($valores[0], $autorRef, $agno);
				  if ($autorRef <>"") $citas = $citas . $autorRef . " (" . $agno . ")";		
		}		
		$i++;
		 }
		$citas = $citas . "." ;
	}
	
return $citas;
}