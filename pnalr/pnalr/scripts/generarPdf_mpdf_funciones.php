<?php
// Funciones asociadas a mpdf y su inicialización 

include ("../mpdf_v5.7/mpdf.php");	

function crear() {	
 return (new mPDF('utf-8', 'Letter', 0, '', 18, 18, 15, 15, 6, 6, '') ); //  Initialise an instance of mPDF class
						// margin_left, right, top, bottom, header, footer, P:Portrait / L:Landscape
}

function encabezado() {	
	$encabezado = "<div class='encabezado'>
									PROYECTO FICOFLORA VENEZUELA 
										<span class='destacado'> &raquo; Parque Nacional Archipiélago Los Roques </span>
								</div>";
	return	$encabezado;
}

function pie() {
	$pie ="<table class='tablaPie'>
				<tr>
					<td width='70%'>2012 - {DATE Y} &copy; G3C { Santiago Gómez, Yusneyi Carballo-Barrera, Mayra García y Nelson Gil }</td>
					<td width='30%' style='text-align:right'>Fecha consulta: {DATE d-m-Y} &nbsp; &nbsp; 
							{PAGENO} / {nbpg}</td>
				</tr></table>";
	
	return	$pie;
}


function encabezado_pie_marcaAgua($mpdf) {
		
		$mpdf->SetHTMLHeader(encabezado());
		$mpdf->SetHTMLFooter(pie());
		
		$mpdf->SetWatermarkText('Proyecto Ficoflora Venezuela (c) G3C', 0.20, 300);
		$mpdf->watermark_font = 'DejaVuSansCondensed';
		$mpdf->showWatermarkText = true;
}

function estilos($mpdf) {
			
		$stylesheet = file_get_contents('../mpdf_v5.7/mpdf.css');
		$mpdf->WriteHTML($stylesheet,1);
}

function generar($mpdf, $html, $nombreFile) {	

      $mpdf->WriteHTML($html); // se solicita la creación del pdf con el contenido en $mpdf
	  $mpdf->Output($nombreFile, 'D'); // se dispara la creación del pdf llamando a ventana de abrir / guardar
exit;
}
?>