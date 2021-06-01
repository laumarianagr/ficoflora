<?php 
/* procedimientos varios de gestión de LOCALIDADES, codificados en php  */

function localidadConsultar($id) { // consulta la información de la localidad dado su id

	$query = "SELECT localidad, localidad_nombre, coordenadas_Geograficas, coordenadas_UTM 
					FROM  localidades WHERE id=$id";	
	$res = ejecutarQuerySQL($query);
			
return $res;
}

function localidadConsultarId($criterio) { // consulta el id  de la localidad dado su nombre técnico
// localidad_nombre en cambio es el que se muetsra al usuario

	$query = "SELECT id FROM  localidades WHERE localidad='".$criterio."'";	
	$res = ejecutarQuerySQL($query);
	$actual = getFila($res);
			
return $actual['id'];
}

function localidadConsultarNombreTec($criterio) { // consulta el nombre Tec de la localidad dado su id 

	$query = "SELECT localidad FROM  localidades WHERE id=".$criterio;	
	$res = ejecutarQuerySQL($query);
	$actual = getFila($res);
			
return $actual['localidad'];
}

function localidadConsultarNombre($criterio) { // consulta el nombre de la localidad dado su id 

	$query = "SELECT localidad_nombre FROM  localidades WHERE id=".$criterio;	
	$res = ejecutarQuerySQL($query);
	$actual = getFila($res);
			
return $actual['localidad_nombre'];
}


function localidadConsultarEspecies($criterio) { // consulta de la información de las especies de la localidad

	$donde =  " `$criterio` > 0 ";
	
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


function localidadConsultarFoto($criterio) { 
// consulta la imagen del mapa o una foto de la localidad dado su id 

	$query = "SELECT imagen_mapa FROM  localidades WHERE id=".$criterio;	
	$res = ejecutarQuerySQL($query);
	$actual = getFila($res);
			
return $actual['imagen_mapa'];
}



function localidadConsultarxAutor($idAutor, $idEspecie) { // consulta las localidades para una especie y un autor
	
	$localidades = "";
	
	$query = "SELECT localidades_id, referencias_id, especies_id, id, localidad, localidad_nombre 
				FROM localidades_distribucion INNER JOIN localidades   
				WHERE especies_id = $idEspecie AND referencias_id LIKE $idAutor  
				ORDER BY localidad"; 
	$res = ejecutarQuerySQL($query);	
	$total = getNumFilas($res);
	
	$i = 0;
	while ($i < $total) 	{		  	
			$actual = getFila($res);
			
			$localidades = $actual['localidad_nombre'];
			if ($i < $total-1) $localidades = $localidades . ", "; 
											  
			$i++;
		} // end while
	
			
return $localidades;
}


function localidadConsultarReporteEspecie($idLocalidad, $idEspecie) { 
	// consulta la referencia bibliográfica de la publicación en donde se reportó la especie para esa localidad
	
	$num = rand(1, 4);  /* temporalmente */
	$query = "SELECT autorRef, agno, urlDocumento FROM  referencias 
					 WHERE id=$num"; 
	$res = ejecutarQuerySQL($query);
			
return $res;
}

function fichaResumenLocalidad($idLocalidad,  $total)  { 
// muestra la ficha superior identificando la especie y la clasificación taxonómica
		
		$res = localidadConsultar($idLocalidad);  // consulta la información de la localidad dado su id
		$actual = getFila($res);	
		$localidad = $actual['localidad_nombre'];
		$coordenadas = "";
		
		/*
		$coordenadas = "
		Coordenadas Geográficas: " . $actual['coordenadas_Geograficas'] . 
									"&nbsp; &#8226; &nbsp; Coordenadas UTM: ". $actual['coordenadas_UTM'];
									*/
?>        
        <div class="well">  <!--  well crea una caja de fondo gris --> 
       
            <div class="icons">
                <a class="btn icon" href="scripts/generarPdf.php?op=codLocalidad&amp;id=<?php echo  $idLocalidad;?>" 
                    target="_blank">
                    <img src="images/ico_pdf.png" alt="exportar a PDF" title="exportar a PDF"/></a>
                <!-- <a class="btn icon" href="#" target="_blank">   
                <img src="images/ico_excel.png" alt="exportar a Excel" title="exportar a Excel"  />
                  </a>   -->    
            </div>
        
            <h1><span><?php echo  ucfirst($localidad); ?></span>
            </h1>	
            <?php echo $coordenadas; ?>
    	</div>        
<?php 
}


function consultarCoordenadas($idVisita, &$cGeo, &$cUTM, &$mapaVisitaLocalidad)  { 
	// consulta las coordenadas geográfica y UTM de la visita a una localidad
	
	$query = "SELECT DISTINCT id, fecha, coordenadas_Geograficas, coordenadas_UTM, imagen_mapa 
							FROM  visita_localidades WHERE id = $idVisita ORDER BY fecha"; 
	$res = ejecutarQuerySQL($query);
	$actual = getFila($res);		
	$cGeo = $actual['coordenadas_Geograficas'];
	$cUTM = $actual['coordenadas_UTM'];
	$mapaVisitaLocalidad = $actual['imagen_mapa'];	
}

function consultarVisitaLocalidad($idVisita, &$localidad, &$comentarios, &$mapaLocalidad)  { 
	// consulta el nombre de la localidad y su comentario (info. ecológica)
	
	$query = "SELECT id, comentarios, localidades_id 
							FROM  visita_localidades WHERE id = $idVisita"; 
	$res = ejecutarQuerySQL($query);
	$actual = getFila($res);		
	$comentarios = $actual['comentarios'];
	$idLocalidades = $actual['localidades_id'];
	
	$query = "SELECT DISTINCT id, localidad, localidad_nombre, imagen_mapa 
							FROM  localidades WHERE id = $idLocalidades"; 
	$res = ejecutarQuerySQL($query);
	$actual = getFila($res);		
	$localidad = $actual['localidad_nombre'];
	$mapaLocalidad = $actual['imagen_mapa'];
}


function localidadesConsultarVisitas($idEspecie)  { 
// consulta las localidades visitadas para la especie y su información ecológica
		
		$query = "SELECT DISTINCT visita_localidades_id, especies_id  
									FROM  colecciones 
									WHERE especies_id=$idEspecie";
							// solo se consultan las especie YA REPORTADAS, no los registros nuevos		
		
		$res = ejecutarQuerySQL($query);
		$total = getNumFilas($res);

							
		$i = 0;		
		$visitas = ""; 
		$carpeta = "images_mapaPNALR/";
		
		// arreglo para almacenar la localidad, coordenadas e información ecológica de todas las localidades		
		$arrayLocalidades[$total-1] =  array(	"localidad" => "",	
																		 "coordenadasLocalidad" => "",
																		 "comentarios" => "",	
																		 "mapaVisitaLocalidad" => "");	

		while ($i < $total) 	{		  	
			$actual = getFila($res);
			
			$idVisita = $actual['visita_localidades_id'];
			$cGeo = "";  	$cUTM = "";		$localidad=0;  	$comentarios = "";   $mapaLocalidad="";
									
			consultarCoordenadas($idVisita, $cGeo, $cUTM, $mapaVisitaLocalidad);
			consultarVisitaLocalidad($idVisita, $localidad, $comentarios, $mapaLocalidad);
			
			$imagen_mapaVisita = $carpeta . $mapaVisitaLocalidad;  
			
			if ( !file_exists($imagen_mapaVisita) or ($mapaVisitaLocalidad == '') ){ 
				  $imagen_mapaVisita = $carpeta . "imagenGeneral.png";
			 }	
			$coordenadasLocalidad = "Coordenadas Geográficas: 
														<a class='fancybox' rel='group2' style='color: #36C;'  
															  href='" . $imagen_mapaVisita . "'  
															  title='" . $localidad  ."'>" .
															$cGeo . "</a> &nbsp; &#8226; &nbsp;  Coordenadas UTM: $cUTM";
						
			$arrayLocalidades[$i]["localidad"] =  $localidad;
			$arrayLocalidades[$i]["coordenadasLocalidad"] = $coordenadasLocalidad;
			$arrayLocalidades[$i]["comentarios"] = $comentarios; 
			$arrayLocalidades[$i]["mapaLocalidad"] = $mapaLocalidad;									  
			$i++;
		} // end while
		
		// ordenamos el arreglo alfabéticamente y ascendentemente por localidad
		sort($arrayLocalidades);
		
		// arreglo auxiliar en donde se almacenan los datos de la colección sin repeticiones del nombre de la localidad
		$arrayAux[$total-1] = array(	"localidad" => "",
														"coordenadasLocalidad" => "",
														"mapaLocalidad" => "");
		
		$i = 0; $k = 0; 
		while ($i < $total) {			
			$arrayAux[$k]["localidad"] = $arrayLocalidades[$i]["localidad"]; 	
			$arrayAux[$k]["coordenadasLocalidad"] = $arrayLocalidades[$i]["coordenadasLocalidad"] ."<br />".  
																						$arrayLocalidades[$i]["comentarios"];
			$arrayAux[$k]["mapaLocalidad"] = $arrayLocalidades[$i]["mapaLocalidad"]; 																																													
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
							
							$imagen_mapaLocalidad = $carpeta . $value["mapaLocalidad"] ;  
													
							if ( !file_exists($imagen_mapaLocalidad) or ($value["mapaLocalidad"] == '') ){ 
								  $imagen_mapaLocalidad= $carpeta . "imagenGeneral.png";
							 }						
							
							$localidadVisita = "<br />" . $i . ". 
															<a class='fancybox' rel='group3' style='color: #36C;'  
																href='" . $imagen_mapaLocalidad . "'  title='" . $value["localidad"]  ."'>"
																. $value["localidad"] . "</a><br />";   
							$i++; 
							$localidad = $value["localidad"];	
							$termine = true; 									
						}
				
				$margenIzq = "18px;";
				if ( $i > 10) $margenIzq = "28px;";
				
				if ( ($termine) && ($j>1)) { $visitas .=  "<span class='textoClaro'>| total sitios de colección: $j </span><br />"; $j=1; }
				$visitas = $visitas . "<li class='listaVisitas'> <strong>" 
									. $localidadVisita ."</strong> 
									<p style='margin-top:5px;margin-left:" . $margenIzq . "'>" .									
									$value["coordenadasLocalidad"];
									$visitas .= "</p></li>";
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
		
return $visitas;
}

function localidadMostrarEspecies($criterio) {   // despliega tabla de especies por localidad
	
	$res= localidadConsultarEspecies($criterio);
	$total = getNumFilas($res);	
	
	if ($total == 0) {
	?>            
        <div class="row">
                <div class="span9 alert alert-error">  <!--  alert-error crea una caja de mensaje de error o alerta -->
                        <h5> Para la localidad <span class="destacado"><?php echo  ucfirst($criterio); ?> 
                        </span>del Parque Nacional Archipiélago Los Roques no se tiene especies reportadas.</h5>
                </div>
        </div>
		
	<?php
	} else { // desplegando tabla
		
		if ($total == 1) {
			
			$actual = getFila($res);	
			$idEspecie = $actual['especies_id'];
			
			$idLocalidad = localidadConsultarId($criterio);				
			fichaResumenLocalidad($idLocalidad, $total);
				
			$res2= especieConsultar($idEspecie, 0);  // en especies.php,  0 indica que se consulta por cód. de especie
			$actual2 = getFila($res2);	
			
			fichaEspecie($actual2);
		}		
		else {   // se muestra la ficha de la única especie para esta consulta
			
			$nombreLocalidad = $criterio;
			$idLocalidad = localidadConsultarId($nombreLocalidad);				
			fichaResumenLocalidad($idLocalidad, $total); 
			?>	
            
            <!-- tabla de resultados de la consulta de especies por localidad  -->
            
           <div class="row"><!-- / *************    sección de contenido  **************** -->
           <div class="span8" id="ficha">
                           
                <table class="table table-striped">
                 <caption>Resultado: <strong> <?php echo $total; ?> </strong>especies encontradas en la localidad
                 </caption>
                <thead> 
                  <tr>
                          <th>N°</th>
                          <th>Especie</th>
                  </tr>	
                 </thead> 	
                 <tbody>
                 <?php  				
				$i = 1; $j = 1;
				while ($i <= $total) 	{
					$actual = getFila($res);	
					$especies = "";  
					$res2= especieConsultar($actual['especies_id'], 0);   // consultando los datos de la especie								
					$actual2 = getFila($res2);								
					$genero = $actual2['genero']; 
					
					if ($genero <>"")
					{			  			
            		?>						
                  <tr>
                    <td><?php echo $j . "."; ?></td>
                    <td>
                      <?php								
								$j++;
								$especies = "<a href='consultar.php?op=codEspecie&qsearch3=". $actual['especies_id'] .
														"&localidad=$nombreLocalidad'>" 
													 . "<span class='especie'>" . ucfirst($genero . " " .$actual2['epiteto_especifico'] ) . " ";
													 
								if (trim($actual2['epiteto_varietal']) != "") 
										$especies = $especies . "</span> var. <span class='especie'>" . $actual2['epiteto_varietal'] . " ";
										
                                if (trim($actual2['epiteto_forma']) != "") 
										$especies = $especies . "</span> f. <span class='especie'>" . $actual2['epiteto_forma']. 
										"</span>";

								$especies = $especies . " </span>&nbsp;&nbsp" . consultarAutor($actual2['especies_id']). "</a>"; 	
								
								$nuevoRegistro = "";
								if ( $actual2['nuevo_registro'] == 1 or $actual2['nuevo_registro_mostrar'] == 1 ) 
										$nuevoRegistro = " N.R. para Venezuela";
								elseif  ( $actual2['nuevo_registro'] == 2 or $actual2['nuevo_registro_mostrar'] == 2 ) 
										$nuevoRegistro = " N.R. para el PNALR";
								elseif  ( $actual2['nuevo_registro'] == 3 or $actual2['nuevo_registro_mostrar'] == 3 )
										 $nuevoRegistro = " N.R. para el Mar Caribe";  
			
								if ($nuevoRegistro <> "")
									$especies = $especies . "<span class='destacado'>  
												&nbsp;&nbsp; &raquo; $nuevoRegistro</span>"; 
																
								echo $especies;  //  se muestran los datos de la especie 
								?>
                      </td> 
                    </tr>
				<?php
                }  								
                $i++;
                } // end while				
			?>    
            </tbody> 
            </table>
        </div>  <!--   /div tabla de resultados -->
        
        <?php 
		$mapaLocalidad = "";
		$mapaLocalidad = localidadConsultarFoto($idLocalidad);    ?>        
        <div class="span4 "> 
         		<a class="fancybox"   
                	 href="images_mapaPNALR/<?php echo $mapaLocalidad; ?>" 
                		alt="<?php echo $nombreLocalidad; ?>" title="<?php echo $nombreLocalidad; ?>">                       
                    <div class="thumbnail galeriaLocalidad">               
                            <img src="images_mapaPNALR/<?php echo $mapaLocalidad; ?>"
                                class="fotoLocalidad" title="<?php echo $nombreLocalidad; ?>">                                     
                    </div>  
                </a>         
          </div> 
          
           <div class="span12 ">  
           <br />            
            <?php
			// mapa de la localidad		
			mostrarMapaLocalidades($idLocalidad);   // mapa.php
			?>
            </div>            
           
         </div> <!--   /row -->  
         <?php 
         }// else ficha unica o lista de subespecies		
		} //end if
		?>                 
    
    	<div class="row">
        <div class="span12 alert alert-info">  <!--  alert-info crea una caja de información-->
            <a href="consultar.php" class="readmore" title="nueva consulta"> 
                <img src="images/ico_buscar.gif" alt="nueva consulta" title="nueva consulta" class="ico"/>
                nueva consulta</a>
    	</div>
        </div> <!--   /row -->
        
    <?php
}	
?>