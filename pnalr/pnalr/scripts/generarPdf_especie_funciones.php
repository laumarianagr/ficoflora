<?php
// Funciones asociadas a Especie utilizadas para crear el pdf con los resultados de las consultas
include ("generarPdf_taxonomia_funciones.php");
include ("generarPdf_autor_funciones.php");
include ("generarPdf_localidad_funciones.php");

function especieConsultarNombreGenero($criterio) { // consulta el género de la especie con id $criterio
	
	$query = "SELECT generos_id FROM especies WHERE id=".$criterio; 
	$res = ejecutarQuerySQL($query);	
	$actual = getFila($res);
	
	$query = "SELECT genero FROM generos WHERE id=". $actual['generos_id']; 
	$res = ejecutarQuerySQL($query);	
	$actual = getFila($res);
	
return  $actual['genero'];
}

function especieConsultarIdGenero($criterio) { // consulta de la información del género con id $criterio
	$query = "SELECT generos_id FROM especies WHERE id=".$criterio; 
	$res = ejecutarQuerySQL($query);	
	$actual = getFila($res);
	
return  $actual['generos_id'];
}

function especieConsultarNombre($criterio) { // consulta el nombre de la especie con id $criterio
	
	$query = "SELECT DISTINCT especies_id, nuevo_registro, genero, 
							epiteto_especifico, epiteto_varietal, epiteto_forma  
							FROM colecciones_especies 
							WHERE especies_id=$criterio"; 							
	 
	$res = ejecutarQuerySQL($query);	
	$actual = getFila($res);
	
	$nombreEspecie = "<em>" . $actual['genero']. " ". $actual['epiteto_especifico']. "</em>";
		if (trim($actual['epiteto_varietal'])<>"")  $nombreEspecie = $nombreEspecie . " var. <em>" . $actual['epiteto_varietal'] . "</em>";
		if (trim($actual['epiteto_forma'])<>"")  $nombreEspecie = $nombreEspecie . " f. <em>" . $actual['epiteto_forma']. "</em>";
	
return  $nombreEspecie;
}


function especieConsultarLocalidades($idEspecie, &$referenciasBiblio) { // consulta las localidades en donde se ha reportado el elemento id
		
		$query = "SELECT  localidades_id, especies_id   
							FROM localidades_distribucion 
							WHERE  especies_id = $idEspecie"; 							
		$res = ejecutarQuerySQL($query);		
		$total = getNumFilas($res);
		
		$localidades = "";
		if ($total == 0)  	{
				$localidades = "No hay reportes registrados para esta especie en el PNALR.";
		}
		else {
			
			for ($i=0; $i<$total; $i++) { 
				$actual = getFila($res);	
				$resRef = localidadConsultarReporteEspecie($actual['localidades_id'], $idEspecie);
				$actualRef = getFila($resRef);
				
				$localidades = $localidades . localidadConsultarNombre($actual['localidades_id']);		
				if ($i < $total-1)
						$localidades = $localidades . ", ";	
			}
		}	
		
return $localidades;
}


function especieConsultarImagenPrincipal($id, $nombreEspecie) { // consulta la foto principal o de hábito para el elemento id
		
		$query = "SELECT  especies_id, imagenes_id,  tipo    
							FROM especies_imagenes 
							WHERE  especies_id = $id   AND  tipo = 'h'"; 							
		$res = ejecutarQuerySQL($query);
		$actual = getFila($res);
							
		$foto = "<td align='center' style='padding-top:4px'>
									<img src='../images_especies/". ucfirst($actual['imagenes_id']) .".jpg' 
									style='height: 120px; padding-bottom:4px; padding-right: 10px;' />
						<br />" . 
						$nombreEspecie .
						"</td>";
		
return $foto;
}

function especieConsultarImagenes($id) { // consulta las imágenes disponibles para la especie dado el id
		
		$query = "SELECT  imagenes_id, especies_id, leyenda 
							FROM especies_imagenes 
							WHERE  especies_id = $id"; 							
		$res = ejecutarQuerySQL($query);		
		$totalIma = getNumFilas($res);
		
		$imagenes = "";
		if ($totalIma == 0) {    // no hay imagen diaponible para  la especie
			
			$imagenes = 
						"<img src='../images_especies/imagenGeneral.jpg' width='150' />
						<br />
						<span style='font-size: 12px; margin-top:5px ;margin-left:50px;'>Imagen provisional</span>";
		 }
	   else  {
		  $i = 1;		  
		   $imagenes = "";
		  while ($i <= $totalIma) 	{
			  $actualIma = getFila($res);
			  $ima = "../images_especies/".ucfirst($actualIma["imagenes_id"]).".jpg";
			  $imagenes .= "<img src='". $ima . "' style=' width: 150px;'/>
			  			<br />
						<span style='font-size: 10px; padding-top:5px;'>" . 
						ucfirst($actualIma["leyenda"])."</span><br /><br /><br /><br />";
          	  $i++;
          } // end while 
	  }           
		
return $imagenes;
}

function especieConsultarDescripcion($id) { // consulta la descripción de la especie dado el id
		
		/*    falta AGREGAR CAMPO descripcion en la tabla especies */
		$query = "SELECT  id, descripcion  FROM especies WHERE id = $id"; 
		$res = ejecutarQuerySQL($query);		
		$total = getNumFilas($res);		
		
		if ($total == 0)  	{
				$descripcion = "No hay descripción disponible para esta especie.";
		}
		else { 
				$actual = getFila($res);	
				$descripcion = $actual['descripcion'];
		}
		
return $descripcion;
}


function pdfEspecie($criterio, $nombreEspecie) {
	
	$nombreEspecie = especieConsultarNombre($criterio);	 // en generarPdf_especie_funciones;	
	$autor = consultarAutorEspecie($criterio);		// en generarPdf_autor_funciones;	
	$idGenero = especieConsultarIdGenero($criterio);
	$taxon = consultarTaxon($idGenero);  	 			// en generarPdf_taxonomia_funciones;	
	$descripcion = especieConsultarDescripcion($criterio);
	$refBiblio = citasBibliograficas($criterio);  // en generarPdf_taxonomia_funciones;
	$localidades = especieConsultarLocalidades($criterio, $refBiblio);
	$visitas = localidadesConsultarVisitas($criterio);
	$imagenes = especieConsultarImagenes($criterio);
	$citas = consultarReportes($criterio);  // en generarPdf_taxonomia_funciones;	
	$tabla = "especies_distribucion";
	$mapaPDF = mostrarMapaEspecies($criterio, $tabla); // en generarPdf_taxonomia_funciones;	
	
	// ficha de la especie
	$listado = "";
	$listado .= 
					"<table style='width:100%;'>
							<tr>
									<td style='text-align:justify'> <!-- identificación del listado -->
									<div style='padding-top: 15px; '>
										<h1>". ucfirst($nombreEspecie) . "&nbsp;" .
											  "<span style='font-size:60%'>" . $autor ."</span><br />
											  <span style='font-size: 55%'>" . $taxon ."</span>
										 </h1>
											  
										<br />
										<h2>Descripción</h2>
												<p>" . $descripcion ." </p>
											
											<br /><br />
											<h2>Información Geográfica y Ecológica</h2>											
													<br />
													<h3>Colectada para el proyecto en</h3>" 
														. $visitas;
													
		if  ($citas <> "")
			$listado .=  "
											<br /><h3>Especie reportada adicionalmente en</h3>
													<p>" . $citas ." </p><br />";
										
			$listado .=  "			<br /><h3>Referencias</h3>" 
												. $refBiblio ."										
										";
		
		$listado .= 	"</div>
							</td>
							
		<!--  ************* segunda columna, fotos de la especie ****************** -->
		
							<td style='width:190px; text-align:center;'> 
													<!-- imágenes de la especie -->" 
													. $imagenes ."
									</td>
							</tr>
						</table>";

	// ******** segunda tabla, mapa de distribución de la especie ***********
	$listado .= 
					"
					<table style='width:100%;'>
							<tr>
									<td style='text-align:left'> 
										<br />
										<h1  style='font-size:40px'>Distribución geográfica</h1> 
										<br /><br /><br />" .
										$mapaPDF .
									"</td>
							</tr>
						</table>";
																							
	return	$listado;
}
?>