<?php
// Funciones asociadas a Género utilizadas para crear el pdf con los resultados de las consultas

function especieConsultarNombre2($criterio) { // consulta el nombre de la especie con id $criterio
	
	$query = "SELECT DISTINCT especies_id, nuevo_registro, genero, 
							epiteto_especifico, epiteto_varietal, epiteto_forma  
							FROM colecciones_especies 
							WHERE especies_id=$criterio"; 
							// solo se consultan las especie YA REPORTADAS, no los registros nuevos							
	 
	$res = ejecutarQuerySQL($query);	
	$actual = getFila($res);
	
	$nombreEspecie = "<em>" . $actual['genero']. " ". $actual['epiteto_especifico']. "</em>";
		if (trim($actual['epiteto_varietal'])<>"")  $nombreEspecie = $nombreEspecie . " var. <em>" . $actual['epiteto_varietal'] . "</em>";
		if (trim($actual['epiteto_forma'])<>"")  $nombreEspecie = $nombreEspecie . " f. <em>" . $actual['epiteto_forma']. "</em>";
	
return  $nombreEspecie;
}

function consultarAutorEspecie2($criterio) { // consulta el nombre del autor dado el id de la especie
	
	$query = "SELECT autores_id FROM especies WHERE id=".$criterio; 
	$res = ejecutarQuerySQL($query);	
	$actual = getFila($res);
	
	$query = "SELECT autor FROM autores WHERE id=". $actual['autores_id']; 
	$res = ejecutarQuerySQL($query);	
	$actual = getFila($res);
	
return  $actual['autor'];
}

function localidadConsultarNombre($criterio) { // consulta el nombre de la localidad dado su id 

	$query = "SELECT localidad_nombre 	FROM  localidades WHERE id=".$criterio;	
	$res = ejecutarQuerySQL($query);
	$actual = getFila($res);
			
return $actual['localidad_nombre'];
}

function localidadConsultarCoordenadasGeograficas($criterio) { // consulta las C.Geo de la localidad dado su id  
	$query = "SELECT coordenadas_Geograficas FROM  localidades WHERE id=".$criterio;	
	$res = ejecutarQuerySQL($query);
	$actual = getFila($res);
			
return $actual['coordenadas_Geograficas'];
}

function localidadConsultarCoordenadasUTM($criterio) { // consulta las C.UTM de la localidad dado su id  

	$query = "SELECT coordenadas_UTM FROM  localidades WHERE id=".$criterio;	
	$res = ejecutarQuerySQL($query);
	$actual = getFila($res);
			
return $actual['coordenadas_UTM'];
}

function consultarCoordenadas($idVisita, &$cGeo, &$cUTM)  { 
	// consulta las coordenadas geográfica y UTM de la visita a una localidad
	
	$query = "SELECT id, fecha, coordenadas_Geograficas, coordenadas_UTM 
							FROM  visita_localidades WHERE id = $idVisita ORDER BY fecha"; 
	$res = ejecutarQuerySQL($query);
	$actual = getFila($res);		
	$cGeo = $actual['coordenadas_Geograficas'];
	$cUTM = $actual['coordenadas_UTM'];
}

function localidadConsultarEspecies($nombreLocalidad) { // consulta de la información de las especies de la localidad

	$query = "SELECT localidad FROM  localidades WHERE localidad_nombre = '$nombreLocalidad'"; 
	$res = ejecutarQuerySQL($query);
	$actual = getFila($res);		
	$criterio = $actual['localidad'];			
			
	$donde =  " nuevo_registro = 0 AND `$criterio` > 0 ";	
	
	if (isset($_SESSION["autenticado"]) and ( ($_SESSION["perfil"]==0)  or  ($_SESSION["perfil"]==1) ) )  {
	// determina si se incluyen los registros nuevos
	$donde =  " `$criterio` > 0 "; 
	}	
	
	$query = "SELECT especies_distribucion.id, especies_distribucion.especies_id, 
					colecciones_especies.especies_id, nuevo_registro,
					nuevo_registro_mostrar   
					FROM especies_distribucion 
					INNER JOIN colecciones_especies 
					ON especies_distribucion.especies_id = colecciones_especies.especies_id 							
				 WHERE  $donde";
					// esto busca en las columnas con el nombre de cayo $criterio y con valor > 0, 
					//  es decir, presencia de la especie
					
	$res = ejecutarQuerySQL($query);
			
return $res;
}


function localidadConsultarReporteEspecie($idLocalidad, $idEspecie) { 
	// consulta la referencia bibliográfica de la publicación en donde se reportó la especie para esa localidad
	
	$num = rand(1, 4);  /* temporalmente */
	$query = "SELECT autorRef, autorCompleto, agno, titulo, urlDocumento, publicacion
					 FROM  referencias 
					 WHERE id=$num ORDER BY autorRef"; 
	$res = ejecutarQuerySQL($query);
			
return $res;
}


function consultarVisitaLocalidad($idVisita, &$localidad, &$comentarios)  { 
	// consulta el nombre de la localidad y su comentario (info. ecológica)
	
	$query = "SELECT id, comentarios, localidades_id 
							FROM  visita_localidades WHERE id = $idVisita"; 
	$res = ejecutarQuerySQL($query);
	$actual = getFila($res);		
	$comentarios = $actual['comentarios'];
	$idLocalidades = $actual['localidades_id'];
	
	$query = "SELECT DISTINCT id, localidad
							FROM  localidades WHERE id = $idLocalidades"; 
	$res = ejecutarQuerySQL($query);
	$actual = getFila($res);		
	$localidad = $actual['localidad'];
}


function localidadesConsultarVisitas2($idEspecie)  { 
// consulta las localidades visitadas para la especie y su información ecológica

		$query = "SELECT DISTINCT visita_localidades_id, especies_id, nuevo_registro 
									FROM  colecciones 
									WHERE  especies_id=$idEspecie";
							// solo se consultan las especie YA REPORTADAS, no los registros nuevos
									
		$res = ejecutarQuerySQL($query);
		$total = getNumFilas($res);
		
		$i=0;		
		$visitas = ""; 
		
		while ($i < $total) 	{		  	
			$actual = getFila($res);
			
			$idVisita = $actual['visita_localidades_id'];
			$cGeo = "";  	$cUTM = "";		$localidad=0;  	$comentarios = "";
			
			consultarCoordenadas($idVisita, $cGeo, $cUTM);
			$coordenadasLocalidad = "Coordenadas Geográficas: $cGeo &nbsp; &#8226; &nbsp; 
			Coordenadas UTM: $cUTM";
			
			consultarVisitaLocalidad($idVisita, $localidad, $comentarios); 			
			
			$visitas = $visitas . "<p><strong>$localidad</strong><br />
												$coordenadasLocalidad<br />
												$comentarios
											</p><br />";
			$i++;
		} // end while
		
return $visitas;
}

function localidadesConsultarVisitas($idEspecie)  { 
// consulta las localidades visitadas para la especie y su información ecológica
		
		$query = "SELECT DISTINCT visita_localidades_id, especies_id  
									FROM  colecciones 
									WHERE especies_id=$idEspecie";
							// solo se consultan las especie YA REPORTADAS, no los registros nuevos		
		
		$res = ejecutarQuerySQL($query);
		$total = getNumFilas($res);

							
		$i=0;		
		$visitas = ""; 
		// arreglo para almacenar la localidad, coordenadas e información ecológica de todas las localidades		
		$arrayLocalidades[$total-1] =  array(	"localidad" => "",	
																		 "coordenadasLocalidad" => "",
																		 "comentarios" => "");	
		
		while ($i < $total) 	{		  	
			$actual = getFila($res);
			
			$idVisita = $actual['visita_localidades_id'];
			$cGeo = "";  	$cUTM = "";		$localidad=0;  	$comentarios = "";
			
			consultarCoordenadas($idVisita, $cGeo, $cUTM);
			$coordenadasLocalidad = "Coordenadas Geográficas: $cGeo &nbsp; &#8226; &nbsp; 
			Coordenadas UTM: $cUTM";		
			
			consultarVisitaLocalidad($idVisita, $localidad, $comentarios); 
						
			$arrayLocalidades[$i]["localidad"] =  $localidad;
			$arrayLocalidades[$i]["coordenadasLocalidad"] = "&nbsp;- " . $coordenadasLocalidad;
			$arrayLocalidades[$i]["comentarios"] = "&nbsp;&nbsp; " . $comentarios;  
											  
			$i++;
		} // end while
		
		// ordenamos el arreglo alfabéticamente y ascendentemente por localidad
		sort($arrayLocalidades);
		
		// arreglo auxiliar en donde se almacenan los datos de la colección sin repeticiones del nombre de la localidad
		$arrayAux[$total-1] = array(	"localidad" => "",
														"coordenadasLocalidad" => "");		
		
		$i = 0; $k =0; 
		while ($i < $total) {			
			$arrayAux[$k]["localidad"] = $arrayLocalidades[$i]["localidad"]; 	
			$arrayAux[$k]["coordenadasLocalidad"] = $arrayLocalidades[$i]["coordenadasLocalidad"] ."<br />".  
																						$arrayLocalidades[$i]["comentarios"] . "<br />";
			$i++; 
			$k++;
		}
		
		if ($k == 0 )
			$visitas="No hay colecciones registradas para esta especie en el PNALR.";	
		
		else {
			sort($arrayAux);
			$visitas="";			
			$localidad = ""; $i = 1;  $j = 1;
			
			
			/*   Listado que muestra la localidad, coordenadas geográficas e información ecológica	    */	
			
			foreach($arrayAux as $key => $value)  {
								
				if ( !empty($value["coordenadasLocalidad"]) ) { // debido a que la primera celda queda vacía
				
				// evitamos que el nombre de la localidad se repita
				if ($localidad == $value["localidad"])   {
							$localidadVisita = "";  $j++; $termine = false;
						}
				else {
							$localidadVisita = "<li style='margin-top:30px;'>" .
															$value["localidad"] . "<br />";   
							$i++; 
							$localidad = $value["localidad"];	
							$termine = true; 						
						}
				
				if ( ($termine) && ($j>1)) { $visitas .=  "</li>
																				 <span  style='color:#888;'>
																				 &nbsp;| total visitas: $j </span><br />"; $j=1; }
				$visitas = $visitas . "
												<strong>" . $localidadVisita ."</strong>" .									
												$value["coordenadasLocalidad"];
				}
			}
			
		
			/*   Listado que muestra solo las localidades
			
			$visitas = "<b>FPNALR </b>("; 
			foreach($arrayAux as $key => $value)  {
								
				if ( !empty($value["coordenadasLocalidad"]) ) { // debido a que la primera celda queda vacía
					
					// evitamos que el nombre de la localidad se repita
					if ($localidad == $value["localidad"])   {
								$visitas .=""; $localidadVisita = "";  $j++; $termine = false;
							}
					else {
								$visitas .= $value["localidad"] . ", "; $localidad = $value["localidad"];
						}
				}
			}
			$visitas = substr($visitas, 0, count($visitas) -3); 
			$visitas .= ").";
			 */
			
		}
		$visitas = "<ul>" . $visitas ."</ul>";
		
return $visitas;
}


function pdfLocalidad($criterio, $nombreLocalidad) {
	
	$res = localidadConsultarEspecies($nombreLocalidad);
	$coordenadas = "
		Coordenadas Geográficas: " . localidadConsultarCoordenadasGeograficas($criterio) . 
									" &#8226; Coordenadas UTM: ". localidadConsultarCoordenadasUTM($criterio);		
	
	// identificación del listado				
	$listado ="<br /><div><h1>Localidad ". ucfirst($nombreLocalidad) . "<br />
							  <span style='font-size: 60%'>" . $coordenadas ."</span>
							  </h1>
					</div>";
	
	// tabla del listado
	$total = getNumFilas($res);
	$listado = $listado .
					"<table>
							<caption>
								Resultado: <strong> $total </strong>especies encontradas
							</caption>
							<thead> 
							  <tr>
									  <th>N°</th>
									  <th style='text-align:left'>Especie</th>
							  </tr>	
							 </thead> 	
							 <tbody>";
							 	
		  $i = 1;            
		  while ($i <= $total) 	{
				$actual = getFila($res);
				$idE = $actual['especies_id'];
				
				$nombreEspecie = especieConsultarNombre2($idE);	 // en generarPdf_especie_funciones;	
				$autor = consultarAutorEspecie2($idE);	 // en generarPdf_autor_funciones;	
				
				// se verifica si es nuevo registro
				$nuevoRegistro = $actual['nuevo_registro']; 
				$nuevoRegistroMostrar = $actual['nuevo_registro_mostrar']; 
				$nuevo = "";
				if  ($nuevoRegistro == 1 or $nuevoRegistroMostrar == 1)
					$nuevo = "<b  style='color:#F00;'>&nbsp;&nbsp;&nbsp; &raquo; Nuevo registro Venezuela</b>";
				elseif  ($nuevoRegistro == 2 or $nuevoRegistroMostrar == 2)
					$nuevo = "<b  style='color:#F00;'>&nbsp;&nbsp;&nbsp; &raquo; Nuevo registro PNALR</b>";
				elseif  ($nuevoRegistro == 3 or $nuevoRegistroMostrar == 3)
					$nuevo = "<b  style='color:#F00;'>&nbsp;&nbsp;&nbsp; &raquo; Nuevo registro Mar Caribe</b>";	
				
				$sombra="";
				if ($i % 2 == 0) $sombra=" class='sombra' ";
						
				$listado = $listado .
								"<tr $sombra>
									  <td style='text-align:center'>".$i . ".</td>
									  <td>" . ucfirst($nombreEspecie) . "&nbsp;&nbsp;" .$autor . $nuevo ."</td> 
							     </tr>";
				$i++;
			  } // end while
			  
			  $listado = $listado . 
			  		"</tbody> 
			 </table>";
			 
			 // en generarPdf_taxonomia_funciones;
			 $imagenLocalidad = consultarMapaImagenLocalidad($criterio); 
			 $mapaPDF = mostrarUbicacionLocalidad($criterio); 	
			 
			// ******** segunda tabla, mapa de distribución de la especie ***********
			$listado .= 
							"
							<table style='width:100%; margin-top: 70px;'>
									<tr>
											<td style='text-align:left'>
												<h1 style='font-size: 40px'>
													Ubicación de la localidad</h1>
													<br /><br />" .
												$mapaPDF .
											"</td>
									</tr>
									<tr>
											<td style='text-align:center; padding-top: 40px;'>
												<br />
												<h1 style='font-size:40px'>Mapa de la localidad</h1> 
												<br /><br />
												<img src='../images_mapaPNALR/" . $imagenLocalidad . "' height='900px' />
											</td>
									</tr>									
								</table>";			 	 
	
	return	$listado;
}
?>