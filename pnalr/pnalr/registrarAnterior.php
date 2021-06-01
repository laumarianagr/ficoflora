<?php 
session_start();
if ( !isset($_SESSION["entrada"]) or @($_SESSION["entrada"]=="no") )
	header("Location: index.php");	
?>
<!DOCTYPE html>
<html lang="es">
<head>	
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
    <meta name="author" content="Yusneyi Carballo Barrera (CENEAC UCV) :: Santiago Gómez Acevedo (IBE UCV) :: Mayra García Ortíz (FIBV UCV) :: Nelson Gil Luna (IPM JMSM). Adaptation by Yusneyi Carballo Barrera - compuefectiva.com">
    <meta name="description" content="Sistema de administración de datos del proyecto Ficoflora P.N. Archipiélago de Los Roques, Venezuela." />
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
          <h1>Registrar (página en desarrollo)</h1>
            <p class="smaller">Estas funcionalidades le permitirán incluir en la base de datos nueva informaci&oacute;n asociada a una especie o su taxonom&iacute;a, localidades, autores  y colecciones<br />
            <span class="smaller-en">{ these features enable you to include in the new database information associated with a species or their taxonomy, locations, authors and collections</span></p>            
      </div>
            
        <div class="row">
                <div class="span12 alert alert-error">  <!--  alert-error crea una caja de mensaje de error o alerta -->
                        <img src="images/ico_alerta_amarillo.gif" class="ico"/>
                        <b> Importante:	 </b>
                        Estas acciones modificar&aacute;n la informaci&oacute;n de la base de datos. Se sugiere hacer una revisi&oacute;n previa para los registros a incorporar en fuentes bibliogr&aacute;ficas confiables.
                </div>
        </div>        
        
	<?php 
    if (isset($_SESSION["autenticado"]) and @($_SESSION["autenticado"] =="si" ) and ($_SESSION["perfil"] == 3)) {
    ?>     
          <div class="row"> <!-- / *************    sección de contenido  **************** -->
            <div class="offset4 span6">
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
      	<div class="offset2 span8">
        	<ul class="thumbnails"> <!--   fila 1, especies y su taxonomía  -->   
            <li class="galeriaOpciones">
            	<a href="../registro.php?op=reg&t=autor"  class="thumbnail" title="registrar autor" target="_parent"><img src="images/opcionautores.png" alt="registrar autor"  title="registrar autor"  />
                <br />Autor</a>
            </li>
            <li class="galeriaOpciones">
            	<a href="../registro.php?op=reg&t=localidad"  class="thumbnail" title="registrar localidad" target="_parent">
                	<img src="images/opcionlocalidad.png" alt="registrar localidad"  title="registrar localidad"  />
                <br />Localidad</a>
            </li>             
            <li class="galeriaOpciones"> 
            	<a href="../registro.php?op=reg&t=colección"  class="thumbnail" title="registrar colección" target="_parent">
                	<img src="images/opcioncoleccion.png" alt="registrar colección"  title="registrar colección"  />
                <br />Colecci&oacute;n</a>
            </li>
          </ul>
          
          <ul class="thumbnails"> <!--   fila 2, especies y su taxonomía  -->          
            <li class="galeriaOpciones">
            	<a href="../registro.php?op=reg&t=especie"  class="thumbnail" title="registrar especie" target="_parent">
                	<img src="images/opcion1.png" alt="registrar especie"  title="registrar especie" onclick="MM_popupMsg('formularios de registros de datos desarrollo...')" />
                <br />Especie</a>                
            </li>            
            <li class="galeriaOpciones">
            	<a href="../registro.php?op=reg&t=género"  class="thumbnail" title="registrar género" target="_parent">
                	<img src="images/opcion2.png" alt="registrar género"  title="registrar género" />
                <br />G&eacute;nero</a>
            </li>
            <li class="galeriaOpciones">
            	<a href="../registro.php?op=reg&t=familia"  class="thumbnail" title="registrar familia" target="_parent">
                	<img src="images/opcion3.png" alt="registrar familia"  title="registrar familia"/>
                <br />Familia</a>
            </li> 
            <li class="galeriaOpciones"> 
            	<a href="../registro.php?op=reg&t=orden"  class="thumbnail" title="registrar orden" target="_parent">
                	<img src="images/opcion4.png" alt="registrar orden"  title="registrar orden"/>
                <br />Orden</a>
            </li>
          	<li class="galeriaOpciones">
            	<a href="../registro.php?op=reg&t=clase"  class="thumbnail" title="registrar clase" target="_parent">
                	<img src="images/opcion5.png" alt="registrar clase"  title="registrar clase" />
                <br />Clase</a>
            </li>
            <li class="galeriaOpciones"> 
            	 <a href="../registro.php?op=reg&t=división"  class="thumbnail" title="registrar división o phillum" target="_parent">
                 	<img src="images/opcion6.png" alt="registrar división o phillum"  title="registrar división o phillum" />
                <br />Divisi&oacute;n o<br /> Phillum</a>
            </li>
          </ul>
          </div> <!-- / fin galeria de opciones -->            
         </div>   <!-- /row sección de contenido  --> 
       <?php }
	   }?>
       	
                
          <hr>  <!-- / hr división con el pie de página   --> 
          <footer><?php textoPie();  // en scripts > cabeceraypie.php ?></footer><!-- /hero-footer -->      
      </div> <!-- /container -->
</body>
</html> 
<?php  cerrarConexion(); /* se cierra la conexion  */ ?>