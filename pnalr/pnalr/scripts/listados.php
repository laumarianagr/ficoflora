<?php 
/* procedimientos varios para crear listados, codificados en php  */

function listarEspecies($criterio) { // lista de especies de la colección

		$query = "SELECT especies_id, nuevo_registro, nuevo_registro_mostrar, generos_id, genero, 
							epiteto_especifico, epiteto_varietal, epiteto_forma   
							FROM colecciones_especies
							ORDER BY genero";		
							
		$res = ejecutarQuerySQL($query);
		$total = getNumFilas($res);		
		?>

		<!-- tabla de resultados del listado por especie -->
        
       <div class="row"><!-- / *************    sección de contenido  **************** -->
       <div class="span12" id="ficha">
            
            <h1><span>Listado por Especie</span>
            </h1>	 
                  
            <table class="table table-striped" style="width:100%" id="listadoEspecies">
             <caption>Resultado: 
             				<strong> <?php echo $total; ?> </strong> especies
             </caption>
             
            <tr> <td id="celdaListado"><ol>  <!--  se crea la primera columna -->
            
            <?php 				
			$cantFilas = 64;
			$i = 1;  
            while ($i <= $total) 	{				
               $actual = getFila($res);	   
			   $para = "";
			   if ( $actual['nuevo_registro'] <> $criterio or $actual['nuevo_registro_mostrar'] <> $criterio ) {  
			   		if ($actual['nuevo_registro'] == 1 or $actual['nuevo_registro_mostrar'] == 1)  
							$para = " &nbsp;&raquo; N.R. Venezuela";
					elseif ($actual['nuevo_registro'] == 2 or $actual['nuevo_registro_mostrar'] == 2)  
							$para = " &nbsp; &raquo; N.R. PNALR";	
					elseif ($actual['nuevo_registro'] == 3 or $actual['nuevo_registro_mostrar'] == 3)
							$para = " &nbsp;&raquo; N.R. Mar Caribe";
			   }
               
				if ($i % $cantFilas == 0 )
					echo "</td><td id='celdaListado' width='33%'><ol>";  // se crea una columna cada cantFilas

				echo "<li type='1' value='$i'>
							<a href='consultar.php?op=codEspecie&qsearch3=" .$actual['especies_id'] . 
									"'  target='_blank'> 
							<span class='especie'>" . 
								$actual['genero'] . " " . $actual['epiteto_especifico'] . " ";
								if ($actual['epiteto_varietal']<>"") 
									echo " </span> var. <span class='especie'>" .$actual['epiteto_varietal'] . " ";
								if ($actual['epiteto_forma']<>"") 
									echo " </span> f. <span class='especie'>" .$actual['epiteto_forma']. "</span>";
							echo "</span>&nbsp;" . consultarAutor($actual['especies_id']) . "</a>"; 
							echo "<span class='destacado'>$para</span>"; 
											// indica si es nuevo registro para Vzla, el PNALR o el Mar Caribe
							echo "</li>";
              $i++;
            } // end while
            ?>
              </ol></td></tr>
            </tbody> 
            </table>	
        </div>  <!--   /div tabla de resultados --> 
        
        <div class="row">
        <div class="span12 alert alert-info">  <!--  alert-info crea una caja de información-->
            <a href="consultar.php" class="readmore" alt="nueva consulta" title="nueva consulta">
            		<img src="images/ico_buscar.gif" alt="nueva consulta" title="nueva consulta" class="ico"/>
                 	nueva consulta </a>                        
    	</div>
        </div> <!--   /row -->       
	<?php
}  // fin listado por especie



function generoContarEspecies($id) { // cuenta las especies colectadas del género $id
		//$donde =  " WHERE nuevo_registro = 0 AND genero = '". $id. "'";  en este caso no se muestran nuevos registros
		$donde =  " WHERE genero = '". $id. "'";

		/* criterio para algunos perfiles específicos de usuario
		if (isset($_SESSION["autenticado"]) and ( ($_SESSION["perfil"]==0)  or  ($_SESSION["perfil"]==1) )  )  {
		// determina si se incluyen los registros nuevos
		$donde =  " WHERE  genero = '". $id. "'";  }
		*/
				
		$query = "SELECT id, genero FROM colecciones_especies  
						    $donde  ORDER BY genero";	
		$res = ejecutarQuerySQL($query);	
				
return  getNumFilas($res);	
}

function listarGeneros() { // lista de géneros de la colección

		$query = "SELECT DISTINCT genero 
							FROM colecciones_especies
							ORDER BY genero";		
							
		$res = ejecutarQuerySQL($query);
		$total = getNumFilas($res);		
		?>

		<!-- tabla de resultados del listado por género -->
        
       <div class="row"><!-- / *************    sección de contenido  **************** -->
       <div class="span12" id="ficha">
            <h1><span>Listado por Género</span>
            </h1>	 
                  
            <table class="table table-striped" style="width: 100%">
             <caption>Resultado: 
             				<strong> <?php echo $total; ?> </strong> géneros
             </caption>
             
            <tr> <td id="celdaListado"><ol>  <!--  se crea la primera columna -->
              
            <?php 
			$cantFilas = 14;
			$i = 1;
			while ($i <= $total) 	{				
               $actual = getFila($res);			   
			   $cont = generoContarEspecies($actual['genero']);
			   
				if (  ($i-1) % $cantFilas == 0 and ($i-1 > 0) )
					echo "</td><td id='celdaListado'><ol>";  // se crea una columna cada cantFilas

				echo "<li type='1' value='$i'>  
							<a href='consultar.php?op=genero&id=" .$actual['genero'] ."' target='_blank'>".
							$actual['genero'].  " <span class='textoClaro'> (".  $cont . ") </span></a></li>";
              $i++;
            } // end while
            ?>
              </ol></td></tr>          
            </tbody> 
            </table>	
        </div>  <!--   /div tabla de resultados --> 
               
        <div class="row">
        <div class="span12 alert alert-info">  <!--  alert-info crea una caja de información-->
            <a href="consultar.php" class="readmore" alt="nueva consulta" title="nueva consulta">
            		<img src="images/ico_buscar.gif" alt="nueva consulta" title="nueva consulta" class="ico"/>
                 	nueva consulta </a>                                     
    	</div>
        </div> <!--   /row -->       
	<?php
}  // fin listado por géneros


function localidadContarEspecies($id) { // cuenta las especies colectadas en la localidad 

		$query = "SELECT especies_distribucion.id, especies_distribucion.especies_id, 
							colecciones_especies.especies_id, nuevo_registro,
							nuevo_registro_mostrar   
							FROM especies_distribucion 
							INNER JOIN colecciones_especies 
							ON especies_distribucion.especies_id = colecciones_especies.especies_id 							
						 WHERE  `$id`> 0";
							// esto busca en las columnas con nombre de cayo, con valor > 0
		$res = ejecutarQuerySQL($query);
				
return  getNumFilas($res);	
}


function listarLocalidades($criterio) { // lista de Localidades de la colección
							
		$query = "SELECT DISTINCT localidades_id  
							FROM visita_localidades";		
							
		$res = ejecutarQuerySQL($query);
		$total = getNumFilas($res);		
		?>

		<!-- tabla de resultados del listado por localidades -->
        
       <div class="row"><!-- / *************    sección de contenido  **************** -->
        <div class="span12" id="ficha">
            <h1><span>Listado por Localidades</span>
            </h1>	 
                  
            <table class="table" style="width: 100%">
             <caption>Resultado: 
             				<strong> <?php echo $total; ?> </strong> localidades </caption>

             <tbody>  		
            <?php 				
            $cantFilas = 5;
			$i = 0;
			// arreglo para almacenar la localidad, coordenadas e información ecológica de todas las localidades		
			$arrayLocalidades[$total-1] = 					array(	"localidad_nombre" => "",
																		    				"localidad" => "");	
            while ($i < $total) 	{				
                $actual = getFila($res);
				$arrayLocalidades[$i]["localidad"] = localidadConsultarNombreTec($actual['localidades_id']);				
				$arrayLocalidades[$i]["localidad_nombre"] = localidadConsultarNombre($actual['localidades_id']);
				$i++;
			}
			asort($arrayLocalidades);
            
			?>            
            <tr> <td id="celdaListado"><ol>  <!--  se crea la primera columna -->
            <?php
			$i = 1;		
			foreach($arrayLocalidades as $key => $value)  {  
				
				$localidad= $value["localidad"];
				$localidad_nombre= $value["localidad_nombre"];
				$cont = localidadContarEspecies($localidad);
				
				if (  ($i-1) % $cantFilas == 0 and ($i-1 > 0) )
					echo "</td><td id='celdaListado'><ol>";  // se crea una columna cada cantFilas
			    
				echo "<li type='1' value='$i'>
									<a href='consultar.php?op=localidad&localidad=" . $localidad .
									"'  target='_blank'>" .  
									$localidad_nombre . " <span class='textoClaro'> (".  $cont . ") </span></a></li>";
           		$i++; 	  
			} // end foreach
            ?>
            
            </ol></td></tr>
            </tbody> 
            </table>	
        </div>  <!--   /div tabla de resultados --> 
               
        <div class="row">
        <div class="span12 alert alert-info">  <!--  alert-info crea una caja de información-->                
            <a href="consultar.php" class="readmore" alt="nueva consulta" title="nueva consulta">
            		<img src="images/ico_buscar.gif" alt="nueva consulta" title="nueva consulta" class="ico"/>
                 	nueva consulta </a>                        
    	</div>
        </div> <!--   /row -->       
	<?php
}  // fin listado por localidades



/* ***************** LISTADOS   *********************************** */
// se identifica el tipo de listado a mostrar 

function listarDatos($op) {

if ($op == "")  {
	echo "se desconoce el tipo de listado, valor enviado";	

} else {		

		$criterio = "";
		switch ($op)
		{
			case "1": 
					$criterio = "Listado por G&eacute;nero: ";
					listarGeneros($criterio);		
			break;
			
			case "2": 			
					$criterio = "Listado por Especie: ";
					listarEspecies($criterio);			
			break;
			
			case "3": 
					$criterio = "Listado por Localidades: ";
					listarLocalidades($criterio);				
			break;
			
			default:
			echo "Opcion no contemplada"; 
			break;
		}
	}
}
?>	