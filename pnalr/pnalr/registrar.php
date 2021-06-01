<?php
include ("scripts/sesionIniciar.php");
iniciar();
?>
<!DOCTYPE html>
<html lang="es">
<head>	
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
    <meta name="author" content="Yusneyi Carballo Barrera (CENEAC UCV) :: Santiago Gómez Acevedo (IBE UCV) :: Mayra García Ortíz (FIBV UCV) :: Nelson Gil Luna (IPM JMSM). Adaptation by Yusneyi Carballo Barrera - compuefectiva.com">
    <meta name="description" content="Inventario actualizado y georreferenciado de macroalgas bénticas marinas de Venezuela, incluyendo colecciones de ambientes intermareales y submareales, claves taxonómicas, descripción morfoanatómica y distribución en mapas geográficos." />
<meta name="keywords" content="ficoflora, macroalgas, algas bénticas, algas marinas, botánica, Los Roques, taxonomía, sistemática de algas, phycoflora, macroalgae, benthic algae, seaweed, botany, taxonomy, systematics of algae, UCV, UPEL." />
<link rel="icon" type="image/png" href="favicon.ico" />

	<title>Proyecto Ficoflora Venezuela :: PNALR</title>
    
<!-- ******************  llamadas a scripts  ***************************** -->
    <!-- includes PHP -->
   <?php   
	 include ("scripts/conexion.php");			include ("scripts/cabecera&Pie.php");	 
	 include ("scripts/taxonomia.php");			include ("scripts/registrar.php");
	 
abrirConexion();
?>
    
    <!-- jQuery -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="bootstrap_v2.0.2/js/bootstrap.js"></script>  
    <script src="js/functions.js" charset="ISO-8859-1"></script>
	<script src="js/jquery-ui-1.9.2.custom.min.js"></script>   
	<script src="js/jquery-select.js"></script>
    <script src="js/jquery-datepicker.js"></script>
    <script src="ckeditor/ckeditor.js"></script>
    
    <!-- Bootstrap -->
    <link href="bootstrap_v2.0.2/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap_v2.0.2/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/jquery-ui-1.9.2.custom.min.css" rel="stylesheet"> 
    <link href="css/bootstrap_customYCB.css" rel="stylesheet">
    
    <!-- Soporte navegadores -->
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <!-- ******************  fin llamadas a scripts  ***************************** -->

</head>
<script>
  $(function () {  // funciones jQuery
    $('.dropdown-toggle').dropdown();
	
	$('#myTab a').click(function (e) {
    e.preventDefault();
     $(this).tab('show'); 
	 })
	 
	 $( "#fechaColeccion" ).datepicker({
		 	showOn: 'both',
			buttonImage: 'js/calendar.gif',
			buttonImageOnly: true
	});       
  })
  
  $(document).ready(function() {
    $('#comentarios').rta('bold, italic');
	});
</script>
<body>
	
    <div class="navbar navbar-fixed-top"><?php textoCabecera2("actualizar");  // en scripts > cabeceraypie.php ?>
     </div>
     
    <div class="container">    
                
      <div class="page-header"> <!-- ******** encabezado de página ******** -->
          <h1>Registrar (página en desarrollo)</h1>
            <p class="smaller">Estas funcionalidades le permitirán incluir en la base de datos nueva informaci&oacute;n asociada a una especie o su taxonom&iacute;a, localidades, autores  y colecciones<br />
            <span class="smaller-en">{ these features enable you to include in the new database information associated with a species or their taxonomy, locations, authors and collections</span></p>
        <div class="alert alert-error">  <!--  alert-error crea una caja de mensaje de error o alerta -->
                    <img src="images/ico_alerta_amarillo.gif" class="ico"/>
                    <b> Importante:	 </b>
                    Estas acciones modificar&aacute;n la informaci&oacute;n de la base de datos. Se sugiere hacer una revisi&oacute;n previa para los registros a incorporar en fuentes bibliogr&aacute;ficas confiables.
            </div>            
      </div>
        
      <div class="row"> <!-- / *************    sección de contenido, fichas de registro  **************** -->
      	<div class="offset1 span11">           
        
	<?php 
    if (isset($_SESSION["autenticado"]) and @($_SESSION["autenticado"] =="si" ) and ($_SESSION["perfil"] == 3)) {
				
		// ****************   sección REGISTRAR para el usuario tipo auxiliar   ************************* 
    ?>    
          <ul class="nav nav-tabs" id="myTab">
                <li><a href="#coleccion">Colecci&oacute;n</a></li>
         	</ul> 
   <?php
	} 
	else 
	{
		if (isset($_SESSION["autenticado"]) and @($_SESSION["autenticado"] =="si" ) and 
			(($_SESSION["perfil"] == 1)  or ($_SESSION["perfil"] == 2))) { 
			
		// ****************   sección REGISTRAR con todas las opciones    ************************* 			
        ?>
                   
          <ul class="nav nav-tabs" id="myTab">
                <li><a href="#autor">Autor</a></li>
                <li><a href="#coleccion">Colecci&oacute;n</a></li>
                <li><a href="#localidad">Localidad</a></li>
          		<li class="active"><a href="#especie">Especie</a></li>
                <li><a href="#genero">G&eacute;nero</a></li>
                <li><a href="#familia">Familia</a></li>
                <li><a href="#orden">Orden</a></li>
                <li><a href="#clase">Clase</a></li>
                <li><a href="#division">Divisi&oacute;n o Phylum</a></li>
         	</ul> 
            
            <div class="tab-content"> 
                <div class="tab-pane" id="autor"><?php registrarAutor();?></div>
                <div class="tab-pane" id="coleccion"><?php registrarColeccion();?></div>
                <div class="tab-pane" id="localidad"><?php registrarLocalidad();?></div>
                <div class="tab-pane active" id="especie"><?php registrarEspecie();?></div>
                <div class="tab-pane" id="genero"><?php registrarGenero();?></div>
                <div class="tab-pane" id="familia"><?php registrarFamilia();?></div>
                <div class="tab-pane" id="orden"><?php registrarOrden();?></div>
                <div class="tab-pane" id="clase"><?php registrarClase();?></div> 
                <div class="tab-pane" id="division"><?php registrarDivision();?></div>               
			</div>            
                           
       <?php } ?>
       	 </div>
       </div>   <!-- /row sección de contenido  --> 
	<?php } ?>
       
          <footer><hr />
          <?php textoPie();  // en scripts > cabeceraypie.php    css: bootstrap_customYCB  ?>
          </footer><!-- /hero-footer -->       
      </div> <!-- /container -->     
       
</body>
</html> 
<script>
  CKEDITOR.replace( 'comentarios' , {
	toolbar: [  //	  '/',	 Line break - next group will be placed in new line.
		[ 'Bold', 'Italic','NumberedList', 'BulletedList' , 'SpecialChar'] ,
		[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] ,
	]
});
</script>
  
<?php  cerrarConexion(); /* se cierra la conexion  */ ?>