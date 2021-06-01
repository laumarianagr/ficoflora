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
    <script type="text/javascript">
		function MM_popupMsg(msg) { //v1.0
		  alert(msg);
		}
	</script>
    
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
	
    <div class="navbar navbar-fixed-top"><?php textoCabecera2("respaldar");  // en scripts > cabeceraypie.php ?>
     </div>
    
    <div class="container">
                
      <div class="page-header"> <!-- ******** encabezado de página ******** -->
          <h1>Respaldar (p&aacute;gina en desarrollo)</h1>
            <p class="smaller">Estas funcionalidades permiten hacer un respaldo (<em>backup</em>) de  informaci&oacute;n relacionada con colecciones, especies, tablas, as&iacute; como la base de datos completa en formato .sql<br />
            <span class="smaller-en">{ These features allow to backup of information related to collections, species, tables and the full database in.sql</span></p>            
      </div>
      
      <div class="row"> <!-- / *************    sección de contenido  **************** -->
      	<div class="span12">
          <ul class="thumbnails">
          	<li class="galeriaOpciones">             
            	<a href="" alt="respaldar colecciones" class="thumbnail">
                	<img src="images/opcioncoleccion.png" alt="respaldar colecciones"  title="respaldar colecciones" onclick="MM_popupMsg('por desarrollar ...')" />
                <br />Colecciones</a>
            </li>
            <li class="galeriaOpciones"> 
            	<a href="" alt="respaldar especies" class="thumbnail">
                	<img src="images/opcion1.png" alt="respaldar especies"  title="respaldar especies"   />
                <br />Especies</a>
            </li>
            <li class="galeriaOpciones"> 
            	<a href="" alt="respaldar tablas" class="thumbnail">
                	<img src="images/opciontabla.png" alt="respaldar tablas"  title="respaldar tablas"  />
                <br />Tablas</a>
            </li>
            <li class="galeriaOpciones"> 
            	<a href="" alt="respaldar base de datos" class="thumbnail">
                	<img src="images/opcionbdd.png" alt="respaldar base de datos"  title="respaldar base de datos"  />
                <br />Base de Datos</a>
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