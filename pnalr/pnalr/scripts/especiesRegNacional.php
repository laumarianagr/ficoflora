<?php 
/* procedimientos varios de gestión de ESPECIES, entre ella la ficha de información de la especie  */

function especieConsultarNombre($criterio) { // consulta el nombre de la especie con id $criterio
	$query = "SELECT id, nuevo_registro, epiteto_especifico, epiteto_varietal, 
					epiteto_forma, generos_id 
					FROM especies 
					WHERE   nuevo_registro=0  AND  id=$criterio"; 
	$res = ejecutarQuerySQL($query);	
	$actual = getFila($res);
	$nombreGenero = generoConsultarNombre($actual['generos_id']);
	$nombreEspecie = "<em>" . $nombreGenero . " ". $actual['epiteto_especifico']. "</em>";
		if ($actual['epiteto_varietal']<>"")  $nombreEspecie = $nombreEspecie . " var. <em>" . $actual['epiteto_varietal'] . "</em>";
		if ($actual['epiteto_forma']<>"")  $nombreEspecie = $nombreEspecie . " f. <em>" . $actual['epiteto_forma']. "</em>";
	
return  $nombreEspecie;
}

function especieConsultar($criterio, $op) { // consulta de la información de la especie

	if ($op==0)
	{ // se conoce el código de la especie
		$query = "SELECT id, nuevo_registro, epiteto_especifico, epiteto_varietal, 
						epiteto_forma, generos_id, autores_id, imagenes_id 
						FROM especies 
						WHERE   nuevo_registro=0  AND  id='".$criterio."'"; 
		$res = ejecutarQuerySQL($query);	
		$opQ=1;	
	}
	else
	{	
			$cont = contar_palabras($criterio);
			
			// construyendo las posibles consultas
			if ($cont == 1)  {
				// consulta asumiendo se suministro epíteto específico
				$query = "SELECT id, nuevo_registro, epiteto_especifico, epiteto_varietal, 
							epiteto_forma, generos_id, autores_id, imagenes_id 
							FROM especies 
							WHERE   nuevo_registro=0  AND  epiteto_especifico='".$criterio."'"; 
				$res = ejecutarQuerySQL($query);	
				$opQ=1;  // 1: epít. esp., me permite saber como debe ser el despliegue en el resumen de resultados
			}
			elseif ($cont == 2)  {
				$palabras = str_word_count($criterio, 1);
				//  echo "<br /> OJO  palabra 1: ". $palabras[0]. " &nbsp;&nbsp;&nbsp;|  &nbsp;&nbsp; 
									  // palabra 2: ". $palabras[1] . "<br />";
				
				$res2 = generoConsultar($palabras[0]);
				$total2 = getNumFilas($res2);	
				
				if ($total2 != 0) {
					
					
					//  echo "<br /> OJO primera palabra es género<br />";
					
					// consulta asumiendo se suministro genero +  epíteto específico
					$actual2 = getFila($res2);
					$idG = $actual2['id'];
					$query = "SELECT id, nuevo_registro, epiteto_especifico, epiteto_varietal, 
							epiteto_forma, generos_id, autores_id, imagenes_id 
							FROM especies 
							WHERE   nuevo_registro=0  AND  generos_id=$idG and 
							epiteto_especifico='".$palabras[1]."'"; 
					$res = ejecutarQuerySQL($query);
					$opQ=2;  // 2. género  + epít. esp. 
					
				} else {
					echo "<br />primera palabra no un género<br />";
					$res="";
					$opQ=3;  // 3. epít. esp.  + epít. var.
				}
			}
			
	} // end else	
			
return $res;
}

function fichaResumenEspecie($actual, &$especie, $lineas)  { 
// muestra la ficha superior identificando la especie, el autor y la clasificación taxonómica

		$nombreGenero = generoConsultarNombre($actual['generos_id']);
		$criterio = "<em>" . $nombreGenero . " ". $actual['epiteto_especifico']. "</em>";
		if ($actual['epiteto_varietal']<>"")  $criterio = $criterio . " var. <em>" . $actual['epiteto_varietal'] . "</em>";
		if ($actual['epiteto_forma']<>"")  $criterio = $criterio . " f. <em>" . $actual['epiteto_forma']. "</em>";
		
		$autor =  consultarAutor($actual['autores_id']);    // en taxonomia.php
		$taxon = consultarTaxon($actual['generos_id']);    // en taxonomia.php	
		
		$especie = $criterio; // se devuelve para mostrar en el proc. que invoca

?>      
        <div class="well">  <!--  well crea una caja de fondo gris -->
            <h1><span class="especie"><?php echo  ucfirst($criterio); ?></span>
            		<small><?php echo  $autor; ?></small>
            </h1>	
            <?php echo $taxon; ?>
    	</div>
<?php 
}


function fichaResumenEspecie2($especie, $idGenero, $total)  { 
// muestra la ficha superior identificando la especie y la clasificación taxonómica
		
		$criterio = "<em>" . ucfirst($especie). "</em>";
		$taxon = consultarTaxon($idGenero);    // en taxonomia.php	
		
		$especie = $criterio; // se devuelve para mostrar en el proc. que invoca

?>
        <div class="well">  <!--  well crea una caja de fondo gris -->
            <h1><span class="especie"><?php echo  ucfirst($criterio); ?></span>
            		<small><?php echo  $autor; ?></small>
            </h1>	
            <?php echo $taxon; ?>
    	</div>
<?php 
}


function fichaEspecie($actual) { 
// depliega la ficha informativa de una especie
?>
<!-- ******************   ********   FICHA DE LA ESPECIE  *********** ******************* -->
            
            <div class="row">
            <div class="span3" id="fichaSeccionIzquierda">  <!--  span izquierdo -->
            
           		<div class="image-block">
                      <img src="images/imagenX_gde.png" width="200" height="180" alt="imagen Especie" />
                </div>
                 <br /><br />                     
            
            <?php 
            $id = $actual['id']; 
			$tabla = "especies_distribucion";			
			$total = consultarHayDistribucion($id, $tabla, 'e');   // en mapa.php
			
			if ($total == 0) { // se despliega enlace al mapa
			?>
				<p>
                	<span class="etiqueta">Distribución Geográfica:</span><br />
                    	No se ha registrado la distribución geográfica para esta especie.
                </p>
            <?php	
			} else  {  // hay distribución o localidades registradas para esta especie
			?>                
                <span class="postlink">
                        <a href="mapas.php?op=e&amp;id=<?php echo $actual['id'];?>" target="_parent" alt="mapa de localizaciones de la especie" title="mapa de localizaciones de la especie">mapa de Distribución 
                        <img src="images/ico_flechader.gif" alt="ver mapa" title="ver mapa" /></a>
                </span> 
            
			<?php }   // end if consultarDistribución  ?>                  
            </div>  <!--  fin del span izquierdo -->
            
            <div class="span9" id="ficha">  <!--  span derecho -->    
           		<?php 
				$especie = "";
				fichaResumenEspecie($actual, $especie, 2);  // 2 indica que el autor aparece en la 2da línea ?>
                
        		<h1>Características</h1>
                En esta sección se colocarán los datos biológicos que resulten del examen morfoanatómico de los especímenes estudiados en el laboratorio. 
            </p>
            
            <h1>Información Ecológica</h1>
                Dada  la importancia de recopilar información florística y taxonómica actualizada de  este grupo de algas rojas en este parque nacional, se realizó un inventario  durante los años 2011 y 2012, incluyendo distintos ambientes y sustratos:  litorales rocosos, praderas de fanerógamas marinas, fondos arenosos, arrecifes  coralinos sumergidos y emergentes y manglares, a diferentes niveles de zona  intermareal hasta una profundidad de 20 m. Se identificaron 37 especies de  Ceramiales, agrupadas en 8 familias: Callithamniaceae  (3), Ceramiaceae (11), Dasyaceae  (1), Delesseriaceae (4), Rhodomelaceae (11), Sarcomeniaceae (1),  Spyridiaceae (1), Wrangeliaceae (5).
            </p> 
            
            <div class="content">  <!--   galeria inferior de imágenes -->
                  <ul class="thumbnails" style="margin-left:140px">
                      <li class="span2">
                          <img src="images/imagenGeneral_med1.png" alt="imagen Especie1" class="thumbnail"  />
                      </li>
                      <li class="span2">
                          <img src="images/imagenGeneral_med2.png" alt="imagen Especie2" class="thumbnail"  />
                      </li>
                      <li class="span2">
                          <img src="images/imagenGeneral_med3.png" alt="imagen Especie3" class="thumbnail"  />
                      </li>
                  </ul>
             </div> 
       </div>  <!--  fin del span derecho -->
       </div>  <!-- /row  fin de la ficha especie   ** ->
        
        <!-- ******************   ********  FIN DE LA FICHA DE LA ESPECIE  *********** ******************* -->	
	<?php 	
}


function especieMostrar($criterio, $op) {// despliega la ficha de información de la especie

	$res= especieConsultar($criterio, $op);
	$res2= especieConsultar($criterio, $op);
	
	$total = getNumFilas($res);	
	$i = 0;
	
	if ($total == 0) {
	?>
            
        <div class="row">
                <div class="span9 alert alert-error">  <!--  alert-error crea una caja de mensaje de error o alerta -->
                        <h5> No tenemos registros para la especie <span class="destacado"><?php echo  ucfirst($criterio); ?> </span>en el Parque Nacional <br />Archipiélago Los Roques.</h5>
                </div>
        </div>
		
	<?php
	} else { // desplegando tabla
	
		$actual2 = getFila($res2);	
	
		if ($total > 1) {
			
				$idGenero = $actual2['generos_id'];
				fichaResumenEspecie2($criterio, $idGenero ,$total);  ?>    
        
                <!-- tabla de resultados de la consulta -->                          
                <table id="resultados" class="listado">
                  <tr>
                          <th>N°</th>
                          <th>Especie</th>
                          <!--   <th>Imagen</th>   -->
                  </tr>	
                  </tr>			
                
                <?php 
                while ($i < $total) 	{
                  $actual = getFila($res);			
                ?>
                        <tr <?php if ($i % 2 == 0) echo " class='altrow' "; ?> >
                          <td><?php echo $i+1 . "."; ?></td>
                          <td>
                          <?php 						
                                echo "<a href='consultar.php?op=cod&qsearch3=" .$actual['id'] ."'>";
                                echo "<span class='italic'>" . ucfirst($criterio) . " ";  
                                //echo $actual['epiteto_especifico'] . " ";  ya $criterio lo está incluyendo
                                if ($actual['epiteto_varietal']<>"") echo " </span> var. <span class='italic'>" .$actual['epiteto_varietal'] . " ";
                                if ($actual['epiteto_forma']<>"") echo " </span> f. <span class='italic'>" .$actual['epiteto_forma']. "</span>";
                                echo "</a>";
                                echo "&nbsp;<span class='autor'>" . consultarAutor($actual['autores_id']) . "</span>"; ?>
                          </td>  
                          <!-- 
                            <td style="text-align:center"><img src="images/imagenX_peq.png" class="imagenListado" /></td>
                            -->
                        </tr>
                <?php 
                  $i++;
                } // end while
                ?>
                </table>
        
        <?php }
		else {   // se muestra la ficha de la especie
		
			$actual = getFila($res);	
			fichaEspecie($actual);
		?>
        
<?php }?>  
	
	<?php
	} //end if
	?>   
    
    	<div class="row">
        <div class="span12 alert alert-info">  <!--  alert-info crea una caja de información-->
            <a href="consultar.php" class="readmore" title="nueva consulta">nueva consulta 
                <img src="images/ico_flechader.gif" alt="nueva consulta" title="nueva consulta" /> </a>
    	</div>
        </div> <!--   /row -->
        
    <?php
}	
?>