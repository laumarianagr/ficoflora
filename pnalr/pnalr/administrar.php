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
	 include ("scripts/conexion.php");	include ("scripts/cabecera&Pie.php");	 		
	
abrirConexion();
?>
    
    <!-- jQuery -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="bootstrap_v2.0.2/js/bootstrap.js"></script>  
    <script src="js/functions.js" charset="ISO-8859-1"></script>
    
    <!-- Bootstrap -->
    <link href="bootstrap_v2.0.2/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap_v2.0.2/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/bootstrap_customYCB.css" rel="stylesheet"> 
    
    
    <!-- Soporte navegadores -->
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <!-- ******************  fin llamadas a scripts  ***************************** -->

</head>
<script>
  $(function () {
    $('.dropdown-toggle').dropdown();
  })
</script>

<body>
	
    <div class="navbar navbar-fixed-top"><?php textoCabecera2("administrar");  // en scripts > cabeceraypie.php ?>
     </div>
    
    <div class="container">
                
      <div class="page-header"> <!-- ******** encabezado de página ******** -->
          <h1>Administraci&oacute;n del Sitio Web (p&aacute;gina en desarrollo)</h1>
            <p class="smaller">Estas funcionalidades permiten la administraci&oacute;n de usuarios, la configuraci&oacute;n de  caracter&iacute;sticas para las tablas, listados y paginaci&oacute;n de resultados y consultar el registro de modificaciones del sitio web<br />
            <span class="smaller-en">{ these features allow the user administration features settings for tables, listings and pagination, and check the log for site changes</span></p>            
      </div>
      
      <div class="row"> <!-- / *************    sección de contenido  **************** -->
      	<div class="span12">
          <ul class="thumbnails">
          	<li class="galeriaOpciones"> 
            	<a href="" alt="administrar usuarios" class="thumbnail">
                	<img src="images/opcionusuario.png" alt="administrar usuarios"  title="administrar usuarios"  />
                <br />Usuarios</a>
            </li>
            <li class="galeriaOpciones"> 
            	<a href="" alt="administrar modificaciones" class="thumbnail">
                	<img src="images/opcion2.png" alt="administrar modificaciones"  title="administrar modificaciones" />
                <br />Registro (log) <br /> de Modificaciones</a>
            </li>
            <li class="galeriaOpciones"> 
            	<a href="" alt="administrar tablas y listados" class="thumbnail">
                	<img src="images/opciontabla.png" alt="administrar tablas y listados"  title="administrar tablas y listados"  />
                <br />Tablas y Listados</a>
            </li>
          </ul>
          </div> <!-- / fin galeria de opciones -->            
         </div>   <!-- /row sección de contenido  --> 
       
          <footer><hr />
          <?php textoPie();  // en scripts > cabeceraypie.php    css: bootstrap_customYCB  ?>
          </footer><!-- /hero-footer -->       
      </div> <!-- /container -->     
       
</body>
</html> 
<?php  cerrarConexion(); /* se cierra la conexion  */ ?>