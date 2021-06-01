<?php
// Exporta resultados de consultas por Género a formato .pdf
include ("conexion.php");	
include ("generarPdf_especie_funciones.php");	
include ("generarPdf_mpdf_funciones.php");	

abrirConexion();

	// recuperando valores enviados
	$criterio = $_REQUEST['id'];	
	$nombre = especieConsultarNombre($criterio);
	$nombre = str_replace("<em>","",$nombre); // para eliminar las italicas del nombre especie
	$nombre = str_replace("</em>","",$nombre);
		
	$html = pdfEspecie($criterio, $nombre);
	
cerrarConexion(); // se cierra la conexion
				 
	$fecha = date('dMY');
	$nombreFile = "consultaEspecie_" . $nombre . "_v". $fecha. ".pdf";	
						
	$mpdf = crear();				
	encabezado_pie_marcaAgua($mpdf);
	estilos($mpdf);	
	generar($mpdf, $html, $nombreFile);
?>