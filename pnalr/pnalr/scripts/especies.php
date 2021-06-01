<?php 
/* procedimientos varios de gestión de ESPECIES, codificados en php  */

function especieConsultarNombre($id) { // consulta el nombre de la especie con id $criterio

        //$donde =  " nuevo_registro= 0 AND especies_id = $id ";
        $donde =  " especies_id = $id ";

		$query = "SELECT DISTINCT id, especies_id, nuevo_registro, generos_id, genero, 
							epiteto_especifico, epiteto_varietal, epiteto_forma   
							FROM colecciones 
							WHERE  $donde";
							
							
	$res = ejecutarQuerySQL($query);	
	$actual = getFila($res);
	
	$nombreEspecie = "<em>" . $actual['genero']. " ". $actual['epiteto_especifico']. "</em>";
		if (trim($actual['epiteto_varietal'])<>"")  $nombreEspecie = $nombreEspecie . " var. <em>" . $actual['epiteto_varietal'] . "</em>";
		if (trim($actual['epiteto_forma'])<>"")  $nombreEspecie = $nombreEspecie . " f. <em>" . $actual['epiteto_forma']. "</em>";
	
return  $nombreEspecie;
}


function especieConsultar($id) { // consulta de la información de la especie, se conoce el código de la especie		
		
		$donde =  " especies_id = $id ";
		
		$query = "SELECT  id, especies_id, nuevo_registro, nuevo_registro_mostrar, generos_id, genero, 
										epiteto_especifico, epiteto_varietal, epiteto_forma   
								FROM colecciones_especies 
								WHERE $donde"; 
								
		$res = ejecutarQuerySQL($query);
			
return $res;
}


function especieConsultarPorNombre($criterio) { // consulta de la información de la especie 
					// y la compara con el nombre completo pasado desde la lista de consulta

		$palabras = str_word_count($criterio, 1);
		$cont = contar_palabras($criterio); 
		
		$genero = $palabras[0];	$epiteto_especifico = $palabras[1];	 
		$epiteto_varietal = "";		$epiteto_forma = "";
		if ($cont > 2) { $epiteto_varietal = $palabras[2]; $epiteto_forma = $palabras[2]; }		
		
		
		$donde =  " genero = '". $genero . "' AND
							epiteto_especifico = '". $epiteto_especifico. "'     AND 
							(epiteto_varietal = '". $epiteto_varietal. "' OR epiteto_forma = '" .$epiteto_forma."') ";
		
		if (isset($_SESSION["autenticado"]) and ( ($_SESSION["perfil"]==0)  or  ($_SESSION["perfil"]==1) )  )  {
		// determina si se incluyen los registros nuevos
		$donde =  " epiteto_especifico = '". $epiteto_especifico. "'     AND 
							(epiteto_varietal = '". $epiteto_varietal. "' OR epiteto_forma = '" .$epiteto_forma."')"; 
		}
		
		$query = "SELECT  id, especies_id, nuevo_registro, nuevo_registro_mostrar, generos_id, genero, 
									epiteto_especifico, epiteto_varietal, epiteto_forma   
							FROM colecciones_especies 
							WHERE   $donde  
							ORDER BY especies_id"; 
							// solo se consultan las especie YA REPORTADAS, no los registros nuevos
		$res = ejecutarQuerySQL($query);
			
return $res;
}


function especieConsultarDescripcion($idEspecie) { // consulta la descripción de la especie id
		 
		$query = "SELECT  id, descripcion  
							FROM especies 
							WHERE  id = $idEspecie"; 							
		$res = ejecutarQuerySQL($query);	
		$actual = getFila($res);
		
		$descripcion = $actual['descripcion'];
		
		if ($actual['descripcion'] == "")  	{
				$descripcion = "Por agregar a la BDD.";
		}
			
return $descripcion;
}


function especieConsultarImagenPrincipal($id) { // consulta la foto principal o de hábito para el elemento id
		
		$query = "SELECT  especies_id, imagenes_id,  tipo, leyenda   
							FROM especies_imagenes 
							WHERE  especies_id = $id   AND  tipo = 'h'"; 							
		$res = ejecutarQuerySQL($query);
		
return $res;
}


function especieConsultarImagenesSecundarias($id) { // consulta las fotos complementarias para la especie id
		
		$query = "SELECT  especies_id, imagenes_id,  tipo, leyenda 
							FROM especies_imagenes 
							WHERE  especies_id = $id   AND  tipo = 'g'"; 							
		$res = ejecutarQuerySQL($query);
		
return $res;
}


function especieConsultarLocalidades($idEspecie) { 
// consulta las localidades en donde se ha reportado el elemento id
		 
		$query = "SELECT  localidades_id, especies_id, referencias_id 
							FROM localidades_distribucion 
							WHERE  especies_id = $idEspecie AND referencias_id <>'' AND localidades_id > 0 "; 							
		$res = ejecutarQuerySQL($query);		
		$total = getNumFilas($res);
		
		if ($total == 0)  	{
				$localidades = "";
		}
		else {	
			$localidades = localidadConsultarCitasxAutor($res, $idEspecie);  // en citas.php	
		}		
return $localidades;
}


function especieMostrarRegistrosNuevos($criterio) { // consulta especies reportadas como Nuevos Registros
// 1: nuevos Reg Venezuela,    2: nuevos Reg PNALR,    3: Mar caribe
		
		$donde =  " nuevo_registro = $criterio OR nuevo_registro_mostrar = $criterio ";
		
		if (isset($_SESSION["autenticado"]) and ( ($_SESSION["perfil"]==0)  or  ($_SESSION["perfil"]==1) ) )  {
		// ESTE CASO aplica para mostrar registros de nivel superior, perfil admin e investigador
		
			if ($criterio == 1)  // $criterio = 1 Venezuela, incluye los del Mar Caribe
				{ $donde =  " nuevo_registro = $criterio OR  nuevo_registro = 3 or 
									   nuevo_registro_mostrar = $criterio OR  nuevo_registro_mostrar = 3";  }   
			elseif ($criterio == 2)  // $criterio = 2 PNALR, incluye Venezuela y el Mar Caribe
				{ $donde =  " nuevo_registro = $criterio OR  nuevo_registro = 1 OR  nuevo_registro = 3 OR 
									   nuevo_registro_mostrar = $criterio OR  nuevo_registro_mostrar = 1 OR  
									   nuevo_registro_mostrar = 3";  } 
				elseif ($criterio == 3)  // $criterio = 3 Mar Caribe
				{ $donde =  " nuevo_registro = $criterio OR  nuevo_registro_mostrar = $criterio ";  }   		
		
		} else {  // esta opción aplica para mostrar lo específicamente solicitado
		
				if ($criterio == 1)  // $criterio = 2 Venezuela, incluye los del Mar Caribe
				{ $donde =  " nuevo_registro = $criterio OR nuevo_registro_mostrar = $criterio";  }   
			elseif ($criterio == 2)  // $criterio = 2 PNALR, incluye Venezuela y el Mar Caribe
				{ $donde =  " nuevo_registro = $criterio OR  nuevo_registro_mostrar = $criterio ";  } 
				elseif ($criterio == 3)  // $criterio = 3 Mar Caribe
				{ $donde =  " nuevo_registro = $criterio OR  nuevo_registro_mostrar = $criterio ";  }   		
		
		}// enf if verificación perfil

		$query = "SELECT  DISTINCT especies_id, nuevo_registro, nuevo_registro_mostrar, genero, 
									epiteto_especifico, epiteto_varietal, epiteto_forma  
							FROM colecciones 
							WHERE $donde 
							ORDER BY genero"; 
							// solo se consultan las especie  REPORTADAS como Registros Nuevos
							
		$res = ejecutarQuerySQL($query);
			
return $res;
}


function fichaResumenEspecie($actual, &$especie, $lineas)  { 
// muestra la ficha superior identificando la especie, el autor y la clasificación taxonómica
		
		$saltoLinea = "";
		$criterio = "<em>" . $actual['genero'] . " ". $actual['epiteto_especifico']. "</em>";
		if ($actual['epiteto_varietal']<>"")  {
				$criterio = $criterio . " var. <em>" . $actual['epiteto_varietal'] . "</em>";
				$saltoLinea = "<br />"; 
			}
		if ($actual['epiteto_forma']<>"")  {
				$criterio = $criterio . " f. <em>" . $actual['epiteto_forma']. "</em>";
				$saltoLinea = "<br />"; 
			}
		
		$idE= $actual['especies_id'];
		$idGenero = generoConsultarId($idE);
		$autor =  consultarAutor($idE);    // en taxonomia.php
		$taxon = consultarTaxon($idGenero);    // en taxonomia.php	
		
		$especie = $criterio; // se devuelve para mostrar en el proc. que invoca

?>
<title></title>

        <div class="well">  <!--  well crea una caja de fondo gris -->    
       
            <div class="icons">
                <a class="btn icon" href="scripts/generarPdf.php?op=codEspecie&amp;id=<?php echo $idE;?>" 
                    target="_blank">
                    <img src="images/ico_pdf.png" alt="exportar a PDF" title="exportar a PDF"/></a>
            </div>
            
            <h1><span class="especie"><?php echo  ucfirst($criterio); ?></span>
            		<small>&nbsp;<?php echo $autor; ?></small>
            </h1>	
            <?php echo $taxon;
			
			$nuevoRegistro = "";
			
			if ( $actual['nuevo_registro'] == 1 or $actual['nuevo_registro_mostrar'] == 1 ) 
				$nuevoRegistro = " Venezuela";
			elseif  ( $actual['nuevo_registro'] == 2 or $actual['nuevo_registro_mostrar'] == 2 ) 
				$nuevoRegistro = " el Parque Nacional Archipiélago Los Roques";
			elseif  ( $actual['nuevo_registro'] == 3 or $actual['nuevo_registro_mostrar'] == 3 ) 
				$nuevoRegistro = " el Mar Caribe";
			
			if ($nuevoRegistro <> "")
				echo "<h3 class='destacado' style='padding-top: 15px; '>  Nuevo registro para $nuevoRegistro</h3>";
		?>
		</div>
<?php 
}


function fichaResumenEspecie2($especie, $idGenero, $total)  { 
// muestra la ficha superior identificando la especie y la clasificación taxonómica
		
		$criterio = "<em>" . ucfirst($especie). "</em>";
		$taxon = consultarTaxon($idGenero);    // en taxonomia.php	
		$res= especieConsultarPorNombre($especie);
		$actual = getFila($res);
		$idE=  $actual['especies_id'];
		$autor=  consultarAutor($idE);
				
		$especie = $criterio; // se devuelve para mostrar en el proc. que invoca

?>
        <div class="well">  <!--  well crea una caja de fondo gris -->        
       
            <div class="icons">
                <a class="btn icon" href="scripts/generarPdf.php?op=codEspecie&amp;id=<?php echo  $criterio;?>" 
                    target="_blank">
                    <img src="images/ico_pdf.png" alt="exportar a PDF" title="exportar a PDF"/></a>
            </div>
        
            <h1><span class="especie"><?php echo  ucfirst($criterio); ?></span>
            		<small>&nbsp;<?php //echo  $autor; ?></small>
            </h1>
			<?php echo $taxon; ?>
    	</div>
<?php 
}


function listadoEspeciesNuevosRegistros($res, $total, $criterio)  { 
	// lista las especies reportadas como nuevos registros
	
	$localidad = "";
		
	switch ($criterio)
	{
		case "1": 
				$localidad = " <b>Venezuela</b>";
				//$para = "&nbsp;&nbsp;&nbsp; &raquo; N. R. Venezuela";
		break;
		
		 case "2":
				$localidad = " el <b>Parque Nacional Archipiélago Los Roques </b>";
				//$para = "&nbsp;&nbsp;&nbsp; &raquo; N. R. PNALR"; 		
		break;		
		
		 case "3":
				$localidad = " el <b>Mar Caribe </b>";
				//$para = "&nbsp;&nbsp;&nbsp; &raquo; N. R. Mar Caribe"; 		
		break;		
		
		default:
		echo "Opcion no contemplada"; 
		break;
	}
	
	?>		
		<!-- tabla de resultados de la consulta de especies por nuevos registros   -->
        
       <div class="row"><!-- / *************    sección de contenido  **************** -->
       <div class="span8" id="ficha">
            <table class="table table-striped">
             <caption>Resultado: <strong> <?php echo $total; ?> </strong>especies reportadas como nuevos registros para <?php echo $localidad; ?></caption>
            <thead> 
              <tr>
                      <th>N°</th>
                      <th>Especie</th>
              </tr>	
             </thead> 	
             <tbody>  		
            <?php 				
            $i = 1;            
            while ($i <= $total) 	{
               $actual = getFila($res);
			   
			   $para = " &nbsp;&nbsp; &raquo; P.N. Los Roques";
			   if ($actual['nuevo_registro'] <> $criterio or $actual['nuevo_registro_mostrar'] <> $criterio) { 
			   		// muestra la localidad para los registros nuevos superiores
			   		if ($actual['nuevo_registro'] == 1  or $actual['nuevo_registro_mostrar'] == 1 ) 
						$para = " &nbsp;&nbsp; &raquo; Venezuela";
					elseif ($actual['nuevo_registro'] == 3  or $actual['nuevo_registro_mostrar'] == 3 ) 
						$para = " &nbsp;&nbsp; &raquo; Mar Caribe";					
			   }
			   			   		  		  			
            ?>
                    <tr>
                      <td><?php echo $i . "."; ?></td> 
                      <td>
                      <?php 							
							echo "<a href='consultar.php?op=codEspecie&qsearch3=" .$actual['especies_id'] . 
											"' target='_blank' >";
                            echo "<span class='especie'>" . $actual['genero'] . " "; 
                            echo $actual['epiteto_especifico'] . " ";
                            if ($actual['epiteto_varietal']<>"") echo " </span> var. <span class='especie'>" .$actual['epiteto_varietal'] . " ";
                            if ($actual['epiteto_forma']<>"") echo " </span> f. <span class='especie'>" .$actual['epiteto_forma']. "</span>";
                            echo "</a>";
							echo "&nbsp;" . consultarAutor($actual['especies_id']); 
							echo "<span class='destacado'>$para </span>"; 
											// indica si es nuevo registro para Vzla, el PNALR o el Mar Caribe	
							?>
                      </td> 
                    </tr>
            <?php 
              $i++;
            } // end while
            ?>
            </tbody> 
            </table>	
        </div>  <!--   /div tabla de resultados -->
        
        <div class="span4"> 
            <?php  galeriaEspeciesGenero();  // en script/galerias.php  ?>
          </div>  
         </div> <!--   /row -->
        
        <div class="row">
        <div class="span12 alert alert-info">  <!--  alert-info crea una caja de información-->
            <a href="consultar.php" class="readmore" alt="nueva consulta" title="nueva consulta">
            		<img src="images/ico_buscar.gif" alt="nueva consulta" title="nueva consulta" class="ico"/>
                 	nueva consulta </a> 
    	</div>
        </div> <!--   /row --> 
      
	<?php
}


function fichaEspecie($actual) { 
// depliega la ficha informativa de una especie
?>
<!-- ******************   ********   FICHA DE LA ESPECIE  *********** ******************* -->
                        
            <?php
            $idEspecie = $actual['especies_id']; 
			$idGenero = $actual['generos_id'];  
			$tabla = "especies_distribucion";			
			$total = consultarHayDistribucion($idEspecie, $tabla, 'e');   // en mapa.php
			?>
           
            <div class="span3" id="fichaSeccionIzquierda">  <!--  span izquierdo -->            
			<?php  galeriaEspeciesImagenPrincipal($idEspecie);  // en script/galerias.php  ?>

			<?php 
			if ($total == 0) { // se despliega enlace al mapa
			?>
				<p>
                	<span class="etiqueta">Distribución Geográfica:</span><br />
                    	<span class="destacado">No se ha registrado la distribución geográfica para esta especie.</span>
                </p>
            <?php	
			} else  {  // hay distribución o localidades registradas para esta especie
			?>                
                        <a href="mapas.php?op=e&amp;id=<?php echo $idEspecie;?>" target="_blank"  
                        	alt="mapa de localizaciones de la especie" title="mapa de localizaciones de la especie">
                            	<img src="images/ico_imagen.gif" alt="ver mapa" title="ver mapa" class="ico" />
                                mapa de distribución</a>
				<br />  <br />   
			<?php }   // end if consultarDistribución  ?>                   

                <a class="fancybox" rel="group4"  
                	 href="images_mapaPNALR/MapaCosteroVenezuela_ubicPNALR_2.png" 
                		alt="Ubicación geográfica PNALR y Venezuela" title="Ubicación geográfica del Parque Nacional Archipiélago Los Roques y Venezuela">
                        <img src="images/ico_imagen.gif" alt="Ubicación PNALR y Venezuela" 
                        	title="Ubicación geográfica PNALR y Venezuela" class="ico"/> 
                            ubicación geográfica PNALR</a>                             

                            
                 <br />  <br />                 
                <a href="consultar.php?op=codGenero&amp;id=<?php echo $idGenero; ?>" target="_parent" 
                		alt="especies del género" title="especies del género">                        
                        <img src="images/ico_nivelarriba.gif" alt="especies del género" 
                        	title="especies del género" class="ico"/> especies del género</a> 
                            
 
                 <br />  <br />  
                <a href="#galeria" target="_parent" alt="ir a la galería" title="ir a la galería">
                     <img src="images/ico_galeria.gif" alt="ir a la galería" title="ir a la galería" class="ico"/>
                 	galería </a>

                            
                <br />  <br /> 
                <a href="consultar.php?q=0;" target="_parent" alt="nueva consulta" title="nueva consulta">
                     <img src="images/ico_buscar.gif" alt="nueva consulta" title="nueva consulta" class="ico"/>
                 	nueva consulta </a> 
                    <br /> <br /> 
                                                      
            </div>  <!--  fin del span izquierdo -->
            
            <div class="span9" id="ficha">  <!--  span derecho -->    
           		<?php 
				$especie = "";
				fichaResumenEspecie($actual, $especie, 2);  // 2 indica que el autor aparece en la 2da línea ?>
                
        	 
             <h1>Descripción</h1>
             <p style="text-align:justify">
             <?php echo especieConsultarDescripcion($idEspecie); ?>
              </p>
             
           
            <h1>Información Geográfica y Ecológica</h1>
         	<?php 
						/* $localidades = especieConsultarLocalidades($idEspecie); */
						$localidades = "";
						$visitas = localidadesConsultarVisitas($idEspecie);	/* en localidades.php */
						$especieSoloCitas = consultarCitasReportes($idEspecie);  /* en citas.php */					
			?>
                       
           <h2>Colectada para el proyecto en</h2>
                    <ol class="listaLocalidades" id="localidades"> <?php echo $visitas; ?></ol> 

			<?php 	if ($localidades <> "" or $especieSoloCitas <> "")  { ?>
            <br />
            <h2>Especie reportada adicionalmente en</h2>
            <?php } ?>    

			<?php if ($localidades <> "" )  { ?>
                    <ol class="listaLocalidades" id="localidades"> <?php  echo $localidades; ?></ol>
            <?php } ?>   
            
			<?php 	if ($especieSoloCitas <> "" )  {  ?>
              <ol class="listaLocalidades" id="localidades"> <?php echo $especieSoloCitas; ?></ol>
            <?php } ?>   
           
           
           
           <!-- ******  galería inferior de imágenes ********* -->
           		<?php  galeriaEspeciesImagenesInferiores($idEspecie);  // en script/galerias.php  ?>
                                
                
              <h1>Referencias</h1>
             <p>
            <?php 
			if (consultarCitas($idEspecie) == "" or consultarCitas($idEspecie) == "No hay referencias registradas para esta especie.")
				echo "Por agregar a la BDD.";
			else {			
			echo citasBibliograficas($idEspecie); /* en citas.php */ ?>
             <br /> <br />
             </p>
             <?php }?>                 
            
        </div>  <!--  fin del span derecho -->
        
        <!-- ******************   ********  FIN DE LA FICHA DE LA ESPECIE  *********** ******************* -->	
	<?php 	
}


function especieMostrar($criterio, $op, $localidad) {   // despliega la ficha de información de la especie	
		
	
	if ($op == 0) {  // 0: se consulta conociendo el codigo especie
	
			$res= especieConsultar($criterio);
			$res2= especieConsultar($criterio);
			$total = getNumFilas($res);
	}	
	elseif ($op == 1) { // 1: se consulta conociendo el nombre de la especie
			$res= especieConsultarPorNombre($criterio);  //echo "<br /> por nombre en especie Mostrar ";
			$res2= especieConsultarPorNombre($criterio);
	}	
	elseif ($op == 2) { // se consultan nuevos registros 
			$res= especieMostrarRegistrosNuevos($criterio); 
			$total = getNumFilas($res);
	
			if ($total == 0) {
			?>					
				<div class="row">
						<div class="span9 alert alert-error">  <!--  alert-error crea una caja de mensaje de error o alerta -->
								<h5> No tenemos registros nuevos reportados.</h5>
						</div>
				</div>
				
			<?php
			} 
			else { // desplegando tabla con listado de registros nuevos
				listadoEspeciesNuevosRegistros($res, $total, $criterio);

			}
	}
	
	if ( ($op == 0) or ($op == 1) ) {	
	
	$total = getNumFilas($res);
	if ($total == 0) {
	?>
            
        <div class="row">
                <div class="span9 alert alert-error">  <!--  alert-error crea una caja de mensaje de error o alerta -->
                        <h5> No tenemos registros para la especie <span class="destacado"><?php echo  ucfirst($criterio); ?> 
                        </span>en el Parque Nacional <br />Archipiélago Los Roques.</h5>
                </div>
        </div>
		
	<?php
	} else { // desplegando tabla
	
		$actual2 = getFila($res2);	
		$idGenero =generoConsultarId($actual2['especies_id']);
	
		if ($total == 1) {  // se muestra la ficha de la especie
			$actual = getFila($res);	
			fichaEspecie($actual);
		}
		
		else {     // se muestra la lista de una especie com varios epítetos de forma o variedad 			
			fichaResumenEspecie2($criterio, $idGenero ,$total);
			 ?>  
                
                <!-- tabla de resultados de la consulta de subespecies por especie  -->
        
               <div class="row"><!-- / *************    sección de contenido  **************** -->
               <div class="span12">
                <table class="table table-striped">
                 <caption>Resultado: <strong> <?php echo $total; ?> </strong>especies encontradas</caption>
                 <thead> 
                  <tr>
                          <th>N°</th>
                          <th>Especie</th>
                          <th><img src="images/ico_pdf.png" width="47" height="57" alt="exportar a pdf" /></th>
                  </tr>	
                  </thead>
                  
                  <tbody>
                <?php  				
            	$i = 1;
                while ($i <= $total) 	{
                  $actual = getFila($res);			
                ?>
                        <tr>
                          <td><?php echo $i . "."; ?></td>
                          <td colspan="2">
                          <?php 						
                                echo "<a href='consultar.php?op=codEspecie&qsearch3=" .$actual['especies_id'] ."'>";
                                echo "<span class='especie'>" . ucfirst($criterio) . " ";  
                                //echo $actual['epiteto_especifico'] . " ";  ya $criterio lo está incluyendo
                                if (trim($actual['epiteto_varietal']) <> "") echo " </span> var. <span class='especie'>" .$actual['epiteto_varietal'] . " ";
                                if (trim($actual['epiteto_forma']) <> "") echo " </span> f. <span class='especie'>" .$actual['epiteto_forma']. "</span>";
                                echo "</a>";
                                echo "&nbsp;" . consultarAutor($actual['especies_id']); ?>
                          </td>
                        </tr>
                <?php 
                  $i++;
                } // end while
                ?>
            	</tbody>
           </table>
        </div>  <!--   /div tabla de resultados -->
 
         </div> <!--   /row -->
	<?php }  // end ficha especie ?> 
    
    
    	<div class="row">        
        <div class="span12 alert alert-info"> 
			<?php            
                $res= especieMostrarRegistrosNuevos($criterio);  
            ?>        
                 
                <a href="consultar.php?op=codGenero&amp;id=<?php echo $idGenero; ?>" target="_parent" 
                		alt="especies del género" title="especies del género">                        
                        <img src="images/ico_nivelarriba.gif" alt="especies del género" 
                        	title="especies del género" class="ico"/>especies del género</a>
            
            <?php if ($localidad <>"") { // habilitamos el enlace de regresar al listado de especies por localidad ?> 
            
            &nbsp;&nbsp;&nbsp;
            
            <a href="consultar.php?op=localidad&amp;id=<?php echo $localidad; ?>" target="_parent" 
            	alt="regresar a la localidad" title="regresar a la localidad">
                   	<img src="images/ico_localidad.gif" alt="regresar a la localidad" title="regresar a la localidad"
                    	class="ico"/>regresar a la localidad</a>
            
            <?php }?>
            
            &nbsp;&nbsp;&nbsp;
            <a href="consultar.php?q=0;" target="_parent" alt="nueva consulta" title="nueva consulta">
            	 <img src="images/ico_buscar.gif" alt="nueva consulta" title="nueva consulta" class="ico"/>
                 	nueva consulta </a>
        </div>        
        </div> <!--   /row -->       
	
	<?php
	} // end if op 0 o 1
	}	
}	
?>