<?php
// Exporta resultados de consultas por Género a formato .pdf
include ("conexion.php");	
include ("generarPdf_genero_funciones.php");	
include ("generarPdf_mpdf_funciones.php");	

abrirConexion();

	// recuperando valores enviados
	$criterio = $_REQUEST['id'];	
	$nombre = generoConsultarNombre($criterio);	
	$html = pdfGenero($criterio, $nombre);
cerrarConexion(); // se cierra la conexion
				 
	$fecha = date('dMY');
	$nombreFile = "consultaGenero_" . $nombre . "_v". $fecha. ".pdf";
						
	$mpdf = crear();				
	encabezado_pie_marcaAgua($mpdf);
	estilos($mpdf);	
	generar($mpdf, $html, $nombreFile);
?>