<?php
// Exporta resultados de consultas por Localidad a formato .pdf
include ("conexion.php");	
include ("generarPdf_localidad_funciones.php");	
include ("generarPdf_taxonomia_funciones.php");	
include ("generarPdf_mpdf_funciones.php");	


abrirConexion();

	// recuperando valores enviados
	$criterio = $_REQUEST['id'];	
	$nombre = localidadConsultarNombre($criterio);	
	$html = pdfLocalidad($criterio, $nombre);
cerrarConexion(); // se cierra la conexion
				 
	$fecha = date('dMY');
	$nombreFile = "consultaLocalidad_" . $nombre . "_v". $fecha. ".pdf";
						
	$mpdf = crear();				
	encabezado_pie_marcaAgua($mpdf);
	estilos($mpdf);	
	generar($mpdf, $html, $nombreFile);
?>