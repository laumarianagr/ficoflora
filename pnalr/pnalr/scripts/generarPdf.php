<?php
// Redirecciona a cada caso de exportación de resultados de consultas a formato .pdf

	// recuperando valores enviados
		$op = $_REQUEST['op'];
	  	$criterio = $_REQUEST['id'];
	  
	  // determino el pdf a generar segun el cod recibido
	  switch ($op)
	  {
		  case 'codGenero':
				 header("Location: generarPdf_genero.php?id=$criterio");
		  break;
		  
		  case 'codEspecie':
				header("Location: generarPdf_especie.php?id=$criterio");
		  break;				
		  
		  case 'codLocalidad':
				header("Location: generarPdf_localidad.php?id=$criterio");
		  break;
  
		  default:
		  echo 'Opcion no contemplada'; 
		  break;
	  }
?>