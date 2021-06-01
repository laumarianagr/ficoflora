<?php
// Funciones asociadas a Género utilizadas para crear el pdf con los resultados de las consultas
include ("generarPdf_especie_funciones.php");	

function generoConsultarNombre($criterio) { // consulta el nombre del género con id $criterio
	$query = "SELECT generos_id, genero FROM  colecciones_generos WHERE generos_id=".$criterio;	
	$res = ejecutarQuerySQL($query);
	$actual = getFila($res);
return  $actual['genero'];
}

function generoConsultarEspecies($criterio) { // consulta de las especies del género $criterio
	
	$donde =  " nuevo_registro = 0 AND generos_id = $criterio ";	
	
	if (isset($_SESSION["autenticado"]) and ( ($_SESSION["perfil"]==0)  or  ($_SESSION["perfil"]==1) ) )  {
	// determina si se incluyen los registros nuevos
	$donde =  " generos_id = $criterio "; 
	}	
	
	$query = "SELECT especies_id, generos_id, nuevo_registro, nuevo_registro_mostrar 
							FROM  colecciones_especies 
							WHERE $donde 
							ORDER BY genero, 
							epiteto_especifico, epiteto_varietal, epiteto_forma"; 
	$res = ejecutarQuerySQL($query);
			
return $res;
}

function generoConsultarFotosEspecies($criterio) { // consulta las fotos principales de las especies del género
		
		// se crea el arreglo de fotos de especies del género
		$res2 = especieConsultarImagenPrincipal($especieId);
		$actual2 = getFila($res2);
		$arrayFotosEspecies[($i-1)]["especieNombre"]= $nombreEspecie;		
		$arrayFotosEspecies[($i-1)]["especieImagen"]= $actual2['imagenes_id'];	
		$arrayFotosEspecies[($i-1)]["especieLeyenda"]= $actual2['leyenda'];								

return $arrayFotosEspecies;
}


function pdfGenero($criterio, $nombreGenero) {
	
	$res = generoConsultarEspecies($criterio);
	$taxon = consultarTaxon($criterio);  	 // en generarPdf_taxonomia_funciones;		
	
	// identificación del listado					
	$listado ="<br /><div><h1>Género ". ucfirst($nombreGenero) . "<br />
							  <span style='font-size: 60%'>" . $taxon ."</span>
							  </h1>
					</div>";
	
	// tabla del listado
	$total = getNumFilas($res);
	$listado = $listado .
					"<table>
							<caption>
								Resultado: <strong> $total </strong>especies encontradas para el género
							</caption>
							<thead> 
							  <tr>
									  <th>N°</th>
									  <th style='text-align:left'>Especie</th>
							  </tr>	
							 </thead> 	
							 <tbody>";
							 	
		  $i = 1;  
		  $fotosGenero = "";          
		  while ($i <= $total) 	{
				$actual = getFila($res);
				$idE = $actual['especies_id'];
				
				$nombreEspecie = especieConsultarNombre($idE);	 // en generarPdf_especie_funciones;	
				$autor = consultarAutorEspecie($idE);	 // en generarPdf_autor_funciones;	
				
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
						 
				// en generarPdf_especie_funciones;
				$fotosGenero .= especieConsultarImagenPrincipal($idE, $nombreEspecie);
				if ($i % 5 == 0) $fotosGenero .= "</tr><tr>";
				
				$sombra="";
				if ($i % 2 == 0) $sombra=" class='sombra' ";
						
				$listado = $listado .
								"<tr $sombra>
									  <td style='text-align:center'>".$i . ".</td>
									  <td>" . $nombreEspecie . "&nbsp;&nbsp;" .$autor . $nuevo . "</td> 
									</tr>";
				$i++;
			  } // end while
			  
			  $listado = $listado . 
							"</tbody> 
					 </table>";
			 
			 // tabla de las fotos de las especies del género
			  $listado = $listado . 
					 "<table style='padding-top:15px;' >
						<tr>" .
						$fotosGenero 
						. "</tr>
					</table>";
	
	return	$listado;
}
?>