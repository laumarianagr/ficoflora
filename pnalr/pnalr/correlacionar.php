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
	
    <div class="navbar navbar-fixed-top"><?php textoCabecera2("respaldar");  // en scripts > cabeceraypie.php ?>
     </div>
    
    <div class="container">
                
      <div class="page-header"> <!-- ******** encabezado de página ******** -->
          <h1>Correlacionar (página en desarrollo)</h1>
            <p class="smaller">Estas funcionalidades permiten importar datos desde hojas de c&aacute;lculo, correlacionar la información de las tablas involucradas en la base de datos o sustituir caracteres conflictivos como la '<br />
            <span class="smaller-en">{ these features allow you to import data from spreadsheets, correlate information from the tables involved in the database or replace conflicting characters like '</span></p>
            
          <div class="alert alert-error">  <!--  alert-error crea una caja de mensaje de error o alerta -->
                  <img src="images/ico_alerta_amarillo.gif" class="ico"/>
                  <b> Importante:	 </b>
                  Estas acciones posiblemente eliminar&aacute;n informaci&oacute;n. Se sugiere hacer un respaldo previo de seguridad de las tablas a trav&eacute;s de la base de datos.
          </div>
      </div>
      
      <div class="row"> <!-- / *************    sección de contenido  **************** -->
      	<div class="span12">
          <ul class="thumbnails">
          	<li class="galeriaOpciones"> 
            	<a href="correlacionarConfirm.php?op=delete&tb=c"  class="thumbnail" 
                			onclick="return confirm('¿Confirma la eliminación de los datos de la tabla Clases y su sustitución por los importados a la base de datos?')"><img src="images/opcion5.png" alt="correlacionar clases"  title="correlacionar clases" />
                <br />Clases</a>
            </li>
            <li class="galeriaOpciones"> 
            	<a href="correlacionarConfirm.php?op=delete&tb=o"  class="thumbnail" 
              				onclick="return confirm('¿Confirma la eliminación de los datos de la tabla Órdenes y su sustitución por los importados a la base de datos?')"> <img src="images/opcion4.png" alt="correlacionar órdenes"  title="correlacionar órdenes"/>
                <br />&Oacute;rdenes</a>
            </li>
            <li class="galeriaOpciones">
            	<a href="correlacionarConfirm.php?op=delete&tb=f"  class="thumbnail" 
                			onclick="return confirm('¿Confirma la eliminación de los datos de la tabla Familias y su sustitución por los importados a la base de datos?')"><img src="images/opcion3.png" alt="correlacionar familias"  title="correlacionar familias"/>
                <br />Familias</a>
            </li>
            <li class="galeriaOpciones">
            	<a href="correlacionarConfirm.php?op=delete&tb=g" class="thumbnail" 
                			onclick="return confirm('¿Confirma la eliminación de los datos de la tabla Géneros y su sustitución por los importados a la base de datos?')"><img src="images/opcion2.png" alt="correlacionar géneros"  title="correlacionar géneros" />
                <br />G&eacute;neros</a>
            </li>
            <li class="galeriaOpciones"> 
            	<a href="correlacionarConfirm.php?op=delete&tb=e" class="thumbnail" 
                			onclick="return confirm('¿Confirma la eliminación de los datos de la tabla Especies y su sustitución por los importados a la base de datos?')"><img src="images/opcion1.png" alt="registrar especies"  title="correlacionar especies" />
                <br />Especies</a>                
            </li>
            <li class="galeriaOpciones"> 
            	<a href="correlacionarConfirm.php?op=delete&tb=co" class="thumbnail"    onclick="return confirm('¿Confirma la eliminación de los datos de la tabla Colección y su sustitución por los importados a la base de datos?')">
              <img src="images/opcioncoleccion.png" alt="correlacionar colecciones"  title="correlacionar colecciones"/>
                <br />Colecciones</a>
            </li>
            <li class="galeriaOpciones">
            	<a href="correlacionarConfirm.php?op=update&tb=aa" class="thumbnail"  
                			onclick="return confirm('¿Confirma la sustitución de la comilla simple por * en la tabla Autores?')"><img src="images/opcionautores.png" alt="adaptar autores"  title="adaptar autores"  />
                <br />Sustituir ' por *</a>
            </li>
            <li class="galeriaOpciones">
            	<a href="correlacionarConfirm.php?op=update&tb=a"  class="thumbnail"   
                			onclick="return confirm('¿Confirma la eliminación de los Autores asociados en la tabla Especies y su sustitución por los importados a la base de datos?')"><img src="images/opcionautores.png" alt="correlacionar autores"  title="correlacionar autores"  />
                <br />Autores</a>
            </li>
            <li class="galeriaOpciones">
            	<a href="correlacionarConfirm.php?op=delete&tb=d" class="thumbnail"  
                  onclick="return confirm('¿Confirma la eliminación de los datos de las tablas de distribución por localidad y su sustitución por los importados a la base de datos?')"> <img src="images/opcionmapa.png" alt="correlacionar distribución especies/localidades"  title="correlacionar distribución especies/localidades"/>
                <br />Distrib. Especies<br /> y Localidades</a>
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