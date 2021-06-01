<?php 
/* procedimientos varios para consultar información de las citas y referencias bibliográficas */

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
	$citasReferencias = citasReferenciasBibliograficas($citas);
		
	return $citasReferencias;
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

function consultarCitasReportes($idEspecie) { 
//consulta campo reportes de la tabla colecciones_especies 
		 
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