<?php  /* procedimientos varios de co-rrelación de tablas importadas */

function correlacionarLocalidadesEspeciesMapa($op) { 
		// correlación de las especies con las localidades, permite actualizar la tabla localidades_distribucion

	$mens1=""; $mens2="";   $ini="&nbsp; &raquo; ";
		
	if ($op=="delete")
	{ // se sustituyen los datos de la tabla por los importados y se correlacionan
		
		// se eliminan los datos de la tabla
		$query ="TRUNCATE TABLE localidades_distribucion";
		$res = ejecutarQuerySQL($query);
		
		$query ="ALTER TABLE  localidades_distribucion AUTO_INCREMENT=1";
		$res = ejecutarQuerySQL($query);
		
		$query = "SELECT * FROM  especies_distribucion"; 
		$resOrigen = ejecutarQuerySQL($query);	
		$totalOrigen = getNumFilas($resOrigen);
		
		if ($totalOrigen == 0)
			  $mens1= "$ini La tabla especies_distribucion no tiene registros para correlacionar.<br />";
		
		else {
			  $mens1= "$ini La tabla especies_distribucion tiene actualmente $totalOrigen especies para procesar.<br />";
					  
			  $totalImp=0;  //   localidades_id    especies_id
			  
				while($fila = mysql_fetch_array($resOrigen)) {
					
						$idEspecie = $fila[1]; $n =count($fila)/2;  // el arreglo tiene 2 elementos por dato
						
						for ($i=2; $i < $n; $i++) { 
							$idLocalidad = $fila[$i];
							
							if ( $idLocalidad > 0 ) {  // hay presencia de la especie en la localidad			
								
								$queryDes = "INSERT INTO localidades_distribucion (localidades_id, especies_id) 
																VALUES ($idLocalidad , $idEspecie)";
								$resDes = ejecutarQuerySQL($queryDes);
								$totalImp++;
							}
						} // del for 
					} // del while
					
				$mens2 = "$ini Se insertaron $totalImp filas en la tabla de distribución de localidades. <br />";
				} // del if de $total cant de especies	

		// despliegue de resultados
		?>
	   <div class="post"><p class="postsearch">               
			<span class="destacado">Resultados del proceso: </span> <br />
			<span class="resultado">
				<?php echo $mens1; ?>
				<?php echo $mens2; ?>                      
			 </span>
		</p></div>        								
<?php 		
				
								
	} // del if $op delete

}// end función


function correlacionarEspeciesColeccion() {
	// se correlacionan en la tabla coleccion importada la especie, buscando su id
		
		$ini="&nbsp; &raquo; ";
		
		$queryOrigen = "SELECT id, genero, epiteto_especifico, epiteto_varietal, epiteto_forma 
								FROM importados_colecciones ORDER BY epiteto_especifico";
								
		$resOrigen = ejecutarQuerySQL($queryOrigen);
		$totalOrigen = getNumFilas($resOrigen);
		$mens1 = "<br />$ini La cantidad de colecciones importadas cuyas especies deben correlacionarse es: $totalOrigen <br />";
		
		$i=1; $totalImp=0;  $totalnoImp=0;
		
		$mens2 = "<br />$ini Las siguientes especies no fueron encontradas en la base de datos Nacional. 
											Recuerde insertar primero la especie en el Registro Nacional y luego repetir este proceso de correlación: <br /><br />";	
		
		$noEncontradas = array();
		
		while ($i <= $totalOrigen) 	
		{
				$actualOrigen = getFila($resOrigen);
				$reg0 = $actualOrigen['id']; 
				$reg1 = $actualOrigen['genero'];						$reg2 = $actualOrigen['epiteto_especifico'];
				$reg3 = $actualOrigen['epiteto_varietal'];		$reg4 = $actualOrigen['epiteto_forma'];
			  	 		 
			  	// consultando el id del género
				$queryT1 = "SELECT id FROM generos WHERE genero = '".$reg1."' ORDER BY genero LIMIT 1";	
				$resT1 = ejecutarQuerySQL($queryT1);
				$actualT1 = getFila($resT1);
				$idGenero = $actualT1['id'];
				
				// consultando la especie 
				$queryT2 = "SELECT id, epiteto_especifico, epiteto_varietal, epiteto_forma, generos_id   
										FROM especies 
										WHERE 	epiteto_especifico = '".$reg2."' and epiteto_varietal = '".$reg3."' and 
														epiteto_forma = '".$reg4."' and generos_id = ".$idGenero."   
														ORDER BY epiteto_especifico LIMIT 1";
				 
				$resT2 = ejecutarQuerySQL($queryT2);
				$totalT2 = getNumFilas($resT2);
			  
			  if ($totalT2 == 0) {				  
				  array_push($noEncontradas, "$reg1 &nbsp $reg2 &nbsp $reg3 &nbsp $reg4"); 
			  }
			  else { // actualizando tabla colecciones importadas campo especies_id
				  $actualT2 = getFila($resT2);	
				  $idEspecie = $actualT2['id']; 
				  $queryDes="UPDATE  importados_colecciones SET especies_id = $idEspecie, generos_id = $idGenero 
				  						WHERE id = $reg0";
				  $resDes = ejecutarQuerySQL($queryDes);
				  $totalImp++;
			  }				  
			  $i++;
			} // end while
		
		$totalE = 0; $totalG = 0; $totalC = 0; 
		// a continuación se actualizan las tablas coleccion, coleccion_especies, coleccion_generos
		coleccionesActualizarEspecies($totalE) ;  // ambos en colecciones .php
		coleccionesActualizarGeneros($totalG) ;		
		coleccionesActualizar($totalC);
		
		// eliminando los duplicados en el registro $noEncontradas
		$noE = array_unique($noEncontradas);
		$n = count($noE);  $i = 0;  $j = 0;
		$mens22 = "";
		
		while ( $i < $n ) {
			if (@$noE[$i]  != "") {
			$j++;
			@$mens22 = $mens22 . $j . ".- " . $noE[$i] . " <br / >";			
			}
			$i++;  
		}	
		$mens2 = $mens2 . $mens22;
		if ($j == 0)  $mens2 = "";  // se reinicia el mensaje 2 correspondiente a especies no encontradas en la BDD
		
		$mens3 = "<br /> Se importaron $totalE especies y $totalG géneros distintos para las colecciones. <br /> 
										Se han importado $totalC especies a la tabla colecciones. <br />
										$j especies no fueron importadas por no estar registradas en la base de datos Nacional<br />
										o estar como registros sp. <br /> <br />";		
										
		// despliegue de resultados
		?>
	   <div class="post"><p class="postsearch">               
			<span class="destacado">Resultados del proceso: </span> <br />
			<span class="resultado">
				<?php echo $mens1; ?>
				<?php echo $mens2; ?>
                <?php echo $mens3; ?>                         
			 </span>
		</p></div>        								
<?php 		
}
				

function correlacionar($op,$tb) { // correlación tablas, $op indica tipo de cambio en la tabla

	$mens1=""; $mens2=""; $mens3=""; $mens4=""; $mens5="";  $ini="&nbsp; &raquo; ";
	
	// determino para tablas y campos
	switch ($tb)
	{
		case "e":
				$tablaDes="especies";   $tablaOrigen="importados_especies";  $tablaT1="generos"; 
				$camposOrigen="genero, epiteto_especifico, epiteto_varietal, epiteto_forma"; 
				$campoOrigen1="genero";	$campoOrigen2="epiteto_especifico";
				$campoOrigen3="epiteto_varietal"; $campoOrigen4="epiteto_forma";
				$camposT1="id, genero"; $campoT1="id"; $campoT2="genero";
				$camposDes="epiteto_especifico, epiteto_varietal, epiteto_forma, generos_id";
				break;
		
		case "g":
				$tablaDes="generos";   $tablaOrigen="importados_generos";  $tablaT1="familias"; 
				$camposOrigen="familia, genero"; $campoOrigen1="familia"; $campoOrigen2="genero";
				$camposT1="id, familia"; $campoT1="id"; $campoT2="familia";
				$camposDes="genero, familias_id";
				break;
		
		case "f": 
				$tablaDes="familias";   $tablaOrigen="importados_familias";  $tablaT1="ordenes"; 
				$camposOrigen="orden, familia"; $campoOrigen1="orden"; $campoOrigen2="familia";
				$camposT1="id, orden"; $campoT1="id"; $campoT2="orden";
				$camposDes="familia, ordenes_id";
				break;			
		
		case "c":
				  $tablaDes="clases";   $tablaOrigen="importados_clases";  $tablaT1="divisiones"; 
				  $camposOrigen="division, clase"; $campoOrigen1="division"; $campoOrigen2="clase";
				  $camposT1="id, division"; $campoT1="id"; $campoT2="division";
				  $camposDes="clase, divisiones_id"; 		
				  break;
		
		case "o":
				$tablaDes="ordenes";   $tablaOrigen="importados_ordenes";  $tablaT1="clases"; 
				$camposOrigen="clase, orden"; $campoOrigen1="clase"; $campoOrigen2="orden";
				$camposT1="id, clase"; $campoT1="id"; $campoT2="clase";
				$camposDes="orden, clases_id";
				break;

		default:
				echo "Opcion no contemplada."; 
				break;
	}		
			
			
	if ($op=="delete")
	{ // se sustituyen los datos de la tabla por los importados y se correlacionan
		
		$query = "SELECT id FROM $tablaDes"; 
		$res = ejecutarQuerySQL($query);	
		$total = getNumFilas($res);
		
		// se eliminan los datos de la tabla
		$query ="TRUNCATE TABLE $tablaDes";
		$res = ejecutarQuerySQL($query);
		
		$query ="ALTER TABLE $tablaDes AUTO_INCREMENT=1";
		$res = ejecutarQuerySQL($query);
		
		$mens1= "$ini La tabla $tablaDes tiene actualmente $total registros a verificar.<br />";
		
		if ($total == 0)
			$mens1= "$ini La tabla $tablaDes no tiene registros para correlacionar.<br />";
		
		$queryOrigen = "SELECT $camposOrigen FROM $tablaOrigen ORDER BY $campoOrigen1"; 										
		$resOrigen = ejecutarQuerySQL($queryOrigen);
		$totalOrigen = getNumFilas($resOrigen);
		$mens2= "$ini La cantidad de registros importados que deben correlacionarse es $totalOrigen.<br />";
		
		$i=1; $totalImp=0;  $totalnoImp=0;
		
		$mens3="<br />$ini Las(los) siguientes $tablaT1 no fueron encontrados en la base de datos. Se debe registrar primero la(el) $campoT2 y luego repetir este proceso de correlación. <br />";	
		
		while ($i <= $totalOrigen) 	
		{					
		  $actualOrigen = getFila($resOrigen);			
		  $reg1 = $actualOrigen[$campoOrigen1];	$reg2 = $actualOrigen[$campoOrigen2];
		  
		  if($tb=="e") { // campos adicionales de la especie
			  $reg3 = $actualOrigen[$campoOrigen3];	$reg4 = $actualOrigen[$campoOrigen4];
			  }	
			  	 		 
		  // consultando el id para correlación 
		  
		  $queryT1 = "SELECT id FROM $tablaT1 WHERE $campoT2 = '".$reg1."' 
		  							ORDER BY $campoT2 LIMIT 1";	
		  $resT1 = ejecutarQuerySQL($queryT1);
		  $totalT1 = getNumFilas($resT1);		  
		  
		  if ($totalT1==0) {
			  $mens3 .= "&nbsp;&nbsp; .- $reg1 <br />";
			  $totalnoImp++;				  
		  }
		  else { // actualizando tabla destino
			  $actualT1 = getFila($resT1);	
			  $id = $actualT1['id'];		
			  
			  if($tb=="e") { // campos adicionales para la especie
			  		$queryDes = "INSERT INTO $tablaDes ($camposDes) VALUES ('$reg2', '$reg3', '$reg4', $id)";
			  }	
			  else {
			  		$queryDes = "INSERT INTO $tablaDes ($camposDes) VALUES ('$reg2', $id)";				
		  		}
			  $resDes = ejecutarQuerySQL($queryDes);
			  $totalImp++;
		  }				  
		  $i++;
		} // end while					
		
		if ($totalnoImp==0) $mens3=""; else "&raquo; ". $mens3;
		$mens4  = "<br />$ini Se realizó la correlación exitosa de ".($totalImp -$totalnoImp) ."  registros. <br />";
		
		if ($totalOrigen==$totalImp) 
			$mens5  = "<strong>$ini Todos los registros de la tabla $tablaDes fueron correlacionados con su $campoT2. </strong><br />";	
		else
			$mens5  = "<strong>$ini ". ($totalOrigen-$totalImp) ." registros de la tabla $tablaDes no fueron correlacionados con su $campoT2.</strong> <br />";	
			
		// despliegue de resultados
		?>
	   <div class="post"><p class="postsearch">               
			<span class="destacado">Resultados del proceso: </span> <br />
			<span class="resultado">
				<?php echo $mens1; ?>
				<?php echo $mens2; ?>
                <?php echo $mens4; ?>
				<?php echo $mens3; ?>				
				<?php echo $mens5; ?>                            
			 </span>
		</p></div>                 
		<?php
		} // end if op = delete	

}// end función

		  
function correlacionarAutores($op) { // correlación autores y especies, $op indica tipo de cambio en la tabla

	$mens1=""; $mens2=""; $mens3=""; $mens4=""; $mens5=""; $mens6="";  $ini="&nbsp; &raquo; ";
	
	if ($op=="update")
	{ // se completan los datos de la tabla con el id correspondiente al autor
		
		$query = "SELECT id FROM especies"; 
		$res = ejecutarQuerySQL($query);	
		$total = getNumFilas($res);		
		
		$mens1= "$ini La tabla especies tiene actualmente $total registros a modificar.<br />";
		
		if ($total == 0)
			$mens1= "$ini La tabla especies no tiene registros para correlacionar con autores.<br />";
			
		$queryOrigen = "SELECT genero, epiteto_especifico, epiteto_varietal, epiteto_forma, autor 
										FROM  importados_especies_autores ORDER BY genero"; 
										
		$resOrigen = ejecutarQuerySQL($queryOrigen);
		$totalOrigen = getNumFilas($resOrigen);
		$mens2= "$ini La cantidad de registros importados que deben correlacionarse es $totalOrigen.<br />";
		
		$i=1; $totalImp=0;  $totalnoImp=0; $totalnoAutor=0; 
		
		$mens3="<br />$ini Los siguientes autores no fueron encontrados en la base de datos. Se debe registrar primero al autor y luego repetir este proceso de correlación. <br />";		
		
		$mens6="<br />$ini No se ha indicado el autor(es) de las siguientes especies. Si es un autor nuevo, debe registrarlo primero en la tabla autor y luego repetir este proceso de correlación. <br />";	
		
		while ($i <= $totalOrigen) 	
		{					
		  $actualOrigen = getFila($resOrigen);											
										
		  $reg1 = $actualOrigen['genero'];					$reg2 = $actualOrigen['epiteto_especifico'];		
		  $reg3 = $actualOrigen['epiteto_varietal'];	$reg4 = $actualOrigen['epiteto_forma'];	
		  $reg5 = $actualOrigen['autor'];	
		  
		  if ($reg5=='')  { // especies sin autor asignado
		  		$mens6 .= "&nbsp;&nbsp; .- $reg1 <i>$reg2 $reg3 $reg4</i> <br />";
				$totalnoAutor++;
		  }		  
		  	
		  // consultando el id del autor
		  
		  // se sustituyen las comillas simples dentro del nombre del autor por * 
		  $reg5 = str_replace("'", '*', $reg5 );
		  
		  $queryT1 = "SELECT id, autor FROM autores WHERE autor = '".$reg5."' ORDER BY autor LIMIT 1";	
		  $resT1 = ejecutarQuerySQL($queryT1);
		  $totalT1 = getNumFilas($resT1);
		  
		  if ($totalT1==0 and $reg5 !='') {
			  $mens3 .= "&nbsp;&nbsp; .- $reg5 <br />";
			  $totalnoImp++;				  
		  }
		  else { // actualizando tabla destino
			  $actualT1 = getFila($resT1);	
			  $idAutor = $actualT1['id'];
			  
			  // ahora cobsultando el id del género
			  $queryT1 = "SELECT id, genero FROM generos WHERE genero = '".$reg1."' ORDER BY genero LIMIT 1";	
			  $resT1 = ejecutarQuerySQL($queryT1);
			  $actualT1 = getFila($resT1);	
			  $idGenero = $actualT1['id'];
			  
			  // se actualiza la tabla especies 
			  $queryDes = "UPDATE especies SET autores_id=$idAutor 
			  						WHERE epiteto_especifico='$reg2' AND epiteto_varietal='$reg3' AND 
									epiteto_forma='$reg4' AND generos_id=$idGenero";
              $resDes = ejecutarQuerySQL($queryDes);
			  $totalImp++;
		  }				  
		  $i++;
		} // end while					
		
		if ($totalnoImp==0) $mens3=""; else "&raquo; ". $mens3;
		$mens4  = "<br />$ini Se realizó la correlación exitosa de ".($totalImp -$totalnoAutor) ."  registros. <br />";
		
		if ($totalOrigen==$totalImp) 
			$mens5  = "<strong>$ini Todos los registros de la tabla especies fueron correlacionados con sus autores. </strong><br />";	
		else
			$mens5  = "<strong>$ini ". ($totalOrigen-$totalImp) ." registros de la tabla especies no fueron correlacionados con sus autores.</strong> <br />";	
			
		// despliegue de resultados
		?>
	   <div class="post"><p class="postsearch">               
			<span class="destacado">Resultados del proceso: </span> <br />
			<span class="resultado">
				<?php echo $mens1; ?>
				<?php echo $mens2; ?>
                <?php echo $mens4; ?>
				<?php echo $mens3; ?>
                <?php echo $mens6; ?>				
				<?php echo $mens5; ?>                            
			 </span>
		</p></div>                 
		<?php
		} // end if op = delete	

}// end función
		

function adaptarAutores($op) { // adapta el campo autor limpiándolo de caracteres problemáticos

	$mens1=""; $mens2=""; $mens3=""; $ini="&nbsp; &raquo; ";
	
	if ($op=="update")
	{ // se completan los datos de la tabla con el id correspondiente al autor
		
		$query = "SELECT id, autor FROM autores ORDER BY autor"; 
		$res = ejecutarQuerySQL($query);	
		$total = getNumFilas($res);		
		
		$mens1= "$ini La tabla autores tiene actualmente $total registros a verificar.<br />";
		
		if ($total == 0)
			$mens1= "$ini La tabla autores no tiene registros para verificar.<br />";
		
		$i=1; $total2=0; 
		
		$mens2="<br />$ini Se sustituyó la comilla simple en los siguientes autores: <br />";	
		
		while ($i <= $total) 	
		{					
		  $actual = getFila($res);
		  $id = $actual['id'];  $autor = $actual['autor'];		  
		  
		  // se sustituyen las comillas simples dentro del nombre del autor por *		  
		  $autor2 = str_replace("'", "*", $autor,$num );
		   
		  if ($num>0) {
				$mens2 .= "&nbsp;&nbsp; .- $autor <br />";
			  	$total2++;
				// se actualiza la tabla especies
				$queryDes = "UPDATE autores SET autor='$autor2' WHERE id=$id";
				$resDes = ejecutarQuerySQL($queryDes);
		  }				   
		  $i++;
		} // end while					
		
		if ($total2==0) $mens2=""; else $ini. $mens2;
		$mens3  = "$ini Se realizó la sustitución de comillas en ".($total2) ."  autores. <br />";
		
		// despliegue de resultados
		?>
	   <div class="post"><p class="postsearch">               
			<span class="destacado">Resultados del proceso: </span> <br />
			<span class="resultado">
				<?php echo $mens1; ?>
                <?php echo $mens3; ?> 
				<?php echo $mens2; ?>				                          
			 </span>
		</p></div>                 
		<?php
		} // end if op = delete	

}// end función
?>		    