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
	
    <div class="navbar navbar-fixed-top"><?php textoCabecera2("actualizar");  // en scripts > cabeceraypie.php ?>
     </div>
    
    <div class="container">
                
      <div class="page-header"> <!-- ******** encabezado de página ******** -->
          <h1>Modificar (página en desarrollo)</h1>
            <p class="smaller">Estas funcionalidades permiten actualizar la informaci&oacute;n de una especie o su taxonom&iacute;a, localidades, autores  y colecciones<br />
            <span class="smaller-en">{ these features allow you to update the information of a species or their taxonomy, locations, authors and collections</span></p>            
            <div class="alert alert-error">  <!--  alert-error crea una caja de mensaje de error o alerta -->
                    <img src="images/ico_alerta_amarillo.gif" class="ico"/>
                    <b> Importante:	 </b>
                    Estas acciones modificar&aacute;n la informaci&oacute;n de la base de datos. Se sugiere hacer una revisi&oacute;n previa para los registros a incorporar en fuentes bibliogr&aacute;ficas confiables.
            </div>            
      </div>        
        
	<?php 
    if (isset($_SESSION["autenticado"]) and @($_SESSION["autenticado"] =="si" ) and ($_SESSION["perfil"] == 3)) {
    ?>     
          <div class="row"> <!-- / *************    sección de contenido  **************** -->
            <div class="span12">
                <ul class="thumbnails"> <!--   fila 1, especies y su taxonomía  --> 
                <li class="galeriaOpciones"> 
                    <a href="" alt="registrar colección" class="thumbnail">
                        <img src="images/opcioncoleccion.png" alt="registrar colección"  title="registrar colección"  />
                    <br />Colecci&oacute;n</a>
                </li>
              </ul>     
          </div> <!-- / fin galeria de opciones -->           
         </div>   <!-- /row sección de contenido  -->         
        
   <?php
	} 
	else 
	{
		if (isset($_SESSION["autenticado"]) and @($_SESSION["autenticado"] =="si" ) and 
			(($_SESSION["perfil"] == 1)  or ($_SESSION["perfil"] == 2))) { 
        ?>              
        <!--   ****************   sección REGISTRAR completa   ************************* -->
      
      <div class="row"> <!-- / *************    sección de contenido  **************** -->
      	<div class="span12">
        	<ul class="thumbnails"> <!--   fila 1, especies y su taxonomía  -->   
            <li class="galeriaOpciones">
            	<a href="correlacionarConfirm.php?op=update&tb=a"  class="thumbnail"   
                			onclick="return confirm('¿Confirma la eliminación de los Autores asociados en la tabla Especies y su sustitución por los importados a la base de datos?')"><img src="images/opcionautores.png" alt="correlacionar autores"  title="correlacionar autores"  />
                <br />Autor</a>
            </li>
            <li class="galeriaOpciones">
            	<a href="" alt="registrar localidad" class="thumbnail">
                	<img src="images/opcionlocalidad.png" alt="registrar localidad"  title="registrar localidad"  />
                <br />Localidad</a>
            </li>             
            <li class="galeriaOpciones"> 
            	<a href="" alt="registrar colección" class="thumbnail">
                	<img src="images/opcioncoleccion.png" alt="registrar colección"  title="registrar colección"  />
                <br />Colecci&oacute;n</a>
            </li>
          </ul>
          
          <ul class="thumbnails"> <!--   fila 2, especies y su taxonomía  -->          
            <li class="galeriaOpciones">
            	<a href="" alt="registrar especie" class="thumbnail">
                	<img src="images/opcion1.png" alt="registrar especie"  title="registrar especie" onclick="MM_popupMsg('formularios de registros de datos desarrollo...')" />
                <br />Especie</a>                
            </li>            
            <li class="galeriaOpciones">
            	<a href="" alt="registrar género" class="thumbnail">
                	<img src="images/opcion2.png" alt="registrar género"  title="registrar género" />
                <br />G&eacute;nero</a>
            </li>
            <li class="galeriaOpciones">
            	<a href="" alt="registrar familia" class="thumbnail">
                	<img src="images/opcion3.png" alt="registrar familia"  title="registrar familia"/>
                <br />Familia</a>
            </li>            
            <li class="galeriaOpciones"> 
            	<a href="" alt="registrar orden" class="thumbnail">
                	<img src="images/opcion4.png" alt="registrar orden"  title="registrar orden"/>
                <br />&Oacute;rden</a>
            </li>
          	<li class="galeriaOpciones">
            	<a href="" alt="registrar clase" class="thumbnail">
                	<img src="images/opcion5.png" alt="registrar clase"  title="registrar clase" />
                <br />Clase</a>
            </li>
            <li class="galeriaOpciones"> 
            	 <a href="" alt="registrar división" class="thumbnail">
                 	<img src="images/opcion6.png" alt="registrar división"  title="registrar división" />
                <br />Divisi&oacute;n o<br /> Phillum</a>
            </li>
          </ul>
          </div> <!-- / fin galeria de opciones -->            
         </div>   <!-- /row sección de contenido  --> 
       <?php }
	   }?>
       
          <footer><hr />
          <?php textoPie();  // en scripts > cabeceraypie.php    css: bootstrap_customYCB  ?>
          </footer><!-- /hero-footer -->       
      </div> <!-- /container -->     
       
</body>
</html> 
<?php  cerrarConexion(); /* se cierra la conexion  */ ?>