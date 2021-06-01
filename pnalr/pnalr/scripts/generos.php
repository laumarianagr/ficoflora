<?php 
/* procedimientos varios de gestión de GÉNEROS, codificados en php  */

function generoConsultarId($criterio) { // consulta de la información del género con id $criterio
	$query = "SELECT generos_id FROM colecciones WHERE especies_id=".$criterio;
	$res = ejecutarQuerySQL($query);
	$actual = getFila($res);
	
return  $actual['generos_id'];
}

function generoConsultarNombre($criterio) { // consulta el nombre del género con id $criterio
	$query = "SELECT generos_id, genero FROM  colecciones_generos WHERE generos_id=".$criterio;	
	$res = ejecutarQuerySQL($query);
	$actual = getFila($res);
return  $actual['genero'];
}


function generoConsultar($criterio) { // consulta de la información del género	 con id $criterio
	$query = "SELECT generos_id, genero FROM  colecciones_generos WHERE generos_id=".$criterio;
	$res = ejecutarQuerySQL($query);
			
return $res;
}


function generoConsultarPorNombre($criterio) { // consulta de la información del género	 con nombre $criterio
	$query = "SELECT generos_id, genero FROM  colecciones_especies WHERE genero='".$criterio."'";
	$res = ejecutarQuerySQL($query);
				
return $res;
}


function generoConsultarEspecies($criterio) { // consulta de las especies del género $criterio

	$donde =  " generos_id = $criterio ";

	$query = "SELECT id, especies_id, nuevo_registro, nuevo_registro_mostrar, generos_id, genero, 
							epiteto_especifico, epiteto_varietal, epiteto_forma 
							FROM  colecciones_especies 
							WHERE  $donde  
							ORDER BY genero,  
							epiteto_especifico, epiteto_varietal, epiteto_forma";  
	$res = ejecutarQuerySQL($query);
			
return $res;
}


function fichaResumenGenero($idGenero,$criterio, $total, $taxon)  { // muestra la ficha superior del género con cantidad de especies asociadas y  // clasificación taxonómica

?>
	<div class="well">  <!--  well crea una caja --> 
       
        <div class="icons">
        	<a class="btn icon" href="scripts/generarPdf.php?op=codGenero&amp;id=<?php echo  $idGenero;?>" 
            	target="_blank">
            	<img src="images/ico_pdf.png" alt="exportar a PDF" title="exportar a PDF"/></a>
            <!-- <a class="btn icon" href="#" target="_blank">   
            <img src="images/ico_excel.png" alt="exportar a Excel" title="exportar a Excel"  />
              </a>   -->    
        </div>
        
    	<div>
        <h1>Género <?php echo  ucfirst($criterio); ?> </h1>
        <?php echo  $taxon; ?>
        </div>
    </div>
<?php 
}


function listadoEspeciesxGenero($total, $actual, $res, $criterio)  { // lista las especies del género $criterio
	?>		
		<!-- tabla de resultados de la consulta de especies por género  -->
        
       <div class="row"><!-- / *************    sección de contenido  **************** -->
       <div class="span9" id="ficha">
            <table class="table table-striped">
             <caption>Resultado:  
			 <?php 
			 $mens= " especie encontrada para el g&eacute;nero";
			 if ($total>1) 
			 	$mens= " especies encontradas para el g&eacute;nero";
			 echo "<strong>". $total . "</strong>".$mens; ?>
             </caption>
            <thead> 
              <tr>
                      <th>N°</th>
                      <th>Especie</th>
              </tr>	
             </thead> 	
             <tbody>  		
            <?php 				
            $i = 1; 			
			// arreglo de fotos de especies del género
			$arrayFotosEspecies[$total-1]=  array( "especieNombre" => "",
																			   "especieImagen" => "",
																			   "especieLeyenda" => "");	
            
			while ($i <= $total) 	{
              $actual = getFila($res);	
			  $nombreEspecie = "";
			 $especieId = $actual['especies_id'];	
            ?>
                    <tr>
                      <td><?php echo $i . "."; ?></td>
                      <td>
                      <?php 
                            echo "<a href='consultar.php?op=codEspecie&qsearch3=" .$especieId ."'>";
                            echo "<span class='especie'>" . ucfirst($criterio) . " ";  
							$nombreEspecie = "<span class='especie'>" . ucfirst($criterio) . " ";
                            echo $actual['epiteto_especifico'] . "</span> ";
							$nombreEspecie .= $actual['epiteto_especifico'] . "</span> ";
                            if ($actual['epiteto_varietal']<>"")  { 
								echo " var. <span class='especie'>" .$actual['epiteto_varietal'] . "</span>";
								$nombreEspecie .= " var. <span class='especie'>" .$actual['epiteto_varietal'] . "</span>";
							}
                            if ($actual['epiteto_forma']<>"")  {
								echo " f. <span class='especie'>" .$actual['epiteto_forma']. "</span>";
								$nombreEspecie .= " f. <span class='especie'>" .$actual['epiteto_forma']. "</span>";
							}
                            echo "</a>";
							echo "&nbsp;" . consultarAutor($especieId); 							
							
							// señala los nuevos registros
							if  ($actual['nuevo_registro'] == 1 or $actual['nuevo_registro_mostrar'] == 1)
							echo "<b class='destacado'>&nbsp;&nbsp;&nbsp; &raquo; Nuevo registro Venezuela</b>";
							elseif  ($actual['nuevo_registro'] == 2 or $actual['nuevo_registro_mostrar'] == 2)
							echo " <b class='destacado'>&nbsp;&nbsp;&nbsp; &raquo; Nuevo registro PNALR</b>";
							elseif  ($actual['nuevo_registro'] == 3 or $actual['nuevo_registro_mostrar'] == 3)
							echo " <b class='destacado'>&nbsp;&nbsp;&nbsp; &raquo; Nuevo registro Mar Caribe</b>";
							
							// se crea el arreglo de fotos de especies del género
							$res2 = especieConsultarImagenPrincipal($especieId);
							$actual2 = getFila($res2);
							$arrayFotosEspecies[($i-1)]["especieNombre"]= $nombreEspecie;		
							$arrayFotosEspecies[($i-1)]["especieImagen"]= $actual2['imagenes_id'];	
							$arrayFotosEspecies[($i-1)]["especieLeyenda"]= $actual2['leyenda'];								
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
        
        
        <div class="span3">   <!--   /div imagenes especies del género  -->
            <ul class="thumbnails">
                    <?php 
							$imagen = "";
							$carpeta = "images_especies/";
								  $num = rand(0, count($arrayFotosEspecies)-1);
								  $imagen = $carpeta . ucfirst($arrayFotosEspecies[($num)]["especieImagen"]) . ".jpg";
								  
								  // se verifica si existe imagen general para esta especie
								  if (!file_exists($imagen)) { 
									  $imagen = $carpeta . "imagenGeneral.jpg";
								  }	
								  ?>		                            
                                    <li class="span2">                
                                        <div class="thumbnail galeriaGenero">                            
                                           <img src="<?php echo $imagen; ?>" 
                                                    alt="<?php echo $arrayFotosEspecies[($num)]["especieImagen"]; ?>" 
                                                    title="<?php echo $arrayFotosEspecies[($num)]["especieImagen"]; ?>" />
                                            <p class="leyendaFoto">        
												<?php echo $arrayFotosEspecies[($num)]["especieNombre"]; ?>
                                            </p>
                                        </div>         
                                    </li> 
         	</ul> <br />
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


function generoMostrarEspecies($criterio, $op) {    // despliega tabla de especies por género

	if ($op == 0) {  // 0: se consulta conociendo el codigo del género
			$res= generoConsultar($criterio);
			$res2= generoConsultar($criterio);
			$nombreGenero = generoConsultarNombre($criterio);
	}
	if ($op == 1) { // 1: se consulta conociendo el nombre del género
			$res= generoConsultarPorNombre($criterio); 
			$res2= generoConsultarPorNombre($criterio);
			$nombreGenero = $criterio;			
	}
		
	$total = getNumFilas($res);	

	if ($total == 0) {	 // el género no está registrado		
	?>		
           <div class="row">
                <div class="span9 alert alert-error">  <!--  alert-error crea una caja de mensaje de error o alerta -->
                        <h5> El género <span class="destacado"><?php echo  ucfirst($nombreGenero); ?> no tiene especies  registradas</span> para el Parque Nacional Archipiélago Los Roques.</h5>
                </div>
            </div>
	
	<?php
	} else { // se consultan las especies del género
	
		$actual = getFila($res);
		$idGenero = $actual['generos_id'];
		$res= generoConsultarEspecies($idGenero);
		$total = getNumFilas($res); 
		
			
		if ($total == 0) {	// el género no tiene especies registradas		
				?>
              <div class="row">
                <div class="span9 alert alert-error">  <!--  alert-error crea una caja de mensaje de error o alerta -->
                        <h5> El género <span class="destacado"><?php echo  ucfirst($nombreGenero); ?> no tiene especies  registradas</span> para el Parque Nacional Archipiélago Los Roques.</h5>
                </div>
            </div>
				
				<?php
				} else { // se consultan sus especies y se despliega la tabla					
				
					$taxon = consultarTaxon($idGenero);    // en taxonomia.php
					
					fichaResumenGenero($idGenero, $nombreGenero, $total, $taxon);
					
					listadoEspeciesxGenero($total, $actual, $res, $nombreGenero);	
					
				} // del if buscar especies
		
	} //end if buscar género
	?> 
    <?php
}	
?>