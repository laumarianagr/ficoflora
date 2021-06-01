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
    <meta name="description" content="Inventario actualizado y georeferenciado de macroalgas bénticas marinas de Venezuela." />
<meta name="keywords" content="ficoflora, macroalgas, algas bénticas, algas marinas, botánica, Los Roques, taxonomía, sistemática de algas, phycoflora, macroalgae, benthic algae, seaweed, botany, taxonomy, systematics of algae, UCV, UPEL." />
<link rel="icon" type="image/png" href="favicon2.ico" />

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
	
        $('.carousel').carousel({
            interval: 11000,
			pause: 'hover'  
			});     
    });	
</script>

<body>
    <div class="navbar navbar-fixed-top navbar-inverse">
		<?php textoCabecera2("indexp");  // en scripts > cabeceraypie.php ?>
    </div>
    
    <div class="container">    
        <div class="row" id="hero"> <!-- / visión del proyecto  -->           
            <div id="myCarousel" class="carousel slide span3">
              <!-- Carousel items    *********  ELEMENTOS DE LA GALERÍA IZQUIERDA ******* -->
              <div class="carousel-inner">
                
                <div class="active item"><img  src="images_galeria/Turbinaria_y_Sargassum.png" 
                		alt="Turbinaria y Sargassum"  />     
                            <div class="carousel-caption">
                            	<span class="titleCarousel">Turbinaria y Sargassum</span>
                           </div> 
                </div>
                
                <div class="item"><img  src="images_galeria/Halimeda_opuntia.png" 
                		alt="Halimeda opuntia" />                             
                            <div class="carousel-caption">
                            	<span class="titleCarousel">Halimeda opuntia</span>
                           </div>
                </div>
               
               <div class="item"><img  src="images_galeria/Los_Roques_0.png" 
                		alt="Los Roques" />                             
                            <div class="carousel-caption">
                            	<span class="titleCarousel">PN Archipiélago Los Roques</span>
                           </div>
                </div>                
               
                <div class="item"><img  src="images_galeria/Ulva_intestinalis.png" 
                		alt="Ulva intestinalis" />                            
                            <div class="carousel-caption">
                            	<span class="titleCarousel">Phyllodictyon anastomosans</span>
                           </div>                          
                </div>
                
                <div class="item"><img  src="images_galeria/Los_Roques_5.png"
                		 alt="Los Roques" />                            
                            <div class="carousel-caption">
                            	<span class="titleCarousel">PN Archipiélago Los Roques</span>
                           </div> 
                </div>
               
                <div class="item"><img  src="images_galeria/Codium_taylorii.png" alt="Codium taylorii" />
                            <div class="carousel-caption">
                            	<span class="titleCarousel">Codium taylorii</span>
                           </div>                           
                </div>
              </div>
              <!-- Carousel nav 
              <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
              <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
              -->
            </div>
        
            <div class="span7" id="hero-texto">
                    <h2>Proyecto</h2>
                    <h1>Flora de Macroalgas Bénticas Marinas</h1>
              <h2>Parque Nacional Archipi&eacute;lago Los Roques</h2>
                    <p>Inventario  actualizado y georeferenciado de  macroalgas marinas, incluyendo colecciones de ambientes intermareales y submareales, claves taxonómicas, descripción morfoanatómica y distribución en mapas geográficos.          </p>
          </div>
          
              <div class="span1" id="hero-right">	
                    <a href="http://www.ucv.ve" title="Universidad Central de Venezuela" target="_blank"><img src="images/logoUCV.png" alt="sitio web UCV"  title="Universidad Central de Venezuela" style="padding-bottom:15px;" /></a>
                    <a href="http://www.upel.edu.ve/" title="Universidad Pedagógica Experimental Libertador" target="_blank"><img src="images/logoUPEL.png" alt="sitio web UPEL" title="Universidad Pedagógica Experimental Libertador" /></a>
            </div>
        </div>        
        
        <div class="row" id="proyecto"> <!-- / visión del proyecto  -->
          <div class="span12" style="text-align:center">
             <h2 style="font-size:200%;">Gracias, visítenos en</h2>
              <h1 style="font-size:300%;">
           	<a href="http://www.ciens.ucv.ve/ficofloravenezuela/index.php" title="FicoWeb PNALR">
            		http://www.ciens.ucv.ve/ficofloravenezuela/index.php</a></h1>
              <br /><br />
              <h2>&raquo; Catalogación&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo; Georreferenciación&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo; Divulgación&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo; Consulta web&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo; Recursos educativos</h2>
              <br />
      </div><!-- /row -->
          
        <div class="row"> <!-- / sección de fotos y logos inferiores  -->
            
       		<div class="span12" id="fotosPie"> <!-- /foto pnalr y  logos institucionales-->    
         			<img src="images/pnalr_foto1.jpg" style="height:50px;">
                    
                    <a href="http://www.ciens.ucv.ve/ciens/" target="_blank" title="Facultad de Ciencias UCV">
                    <img src="images/logoFacCiencias.png" alt="sitio web Facultad de Ciencias"></a>  
                    
                     <a href="http://www.ciens.ucv.ve/escueladecomputacion/inicio/index" target="_blank" 
                    		title="Escuela de Computación">
                    <img src="images/logoEscComputacion.png" alt="sitio web Escuela de Computación"></a>                   
                    
                    <a href="http://www.ucv.ve/organizacion/fundaciones-asociaciones-y-centros/fundacion-instituto-botanico-de-venezuela.html" target="_blank" title="Fundaci&oacute;n Instituto Bot&aacute;nico de Venezuela Dr. Tob&iacute;as Lasser">
                    <img src="images/logoFIBV.png" alt="sitio web FJBV"></a>
                  <a href="http://www.ciens.ucv.ve/ibexp/Index.htm" target="_blank" 
                  		title="Instituto de Biología Experimental"><img src="images/logoIBE.png"></a>                     
                    
                    <a href="http://www.ipmjmsm.upel.edu.ve/" target="_blank" title="Instituto Pedag&oacute;gico 
                    				de Miranda Jos&eacute; Manuel Siso Mart&iacute;nez">
                    <img src="images/logoIMP_JMSM.png" alt="sitio web IPM-JMSM"></a>
                    
                    <img src="images/pnalr_foto2.jpg" style="height:50px">
            </div>
</div><!-- /row -->
            
       
          <footer><hr />
          <?php textoPie();  // en scripts > cabeceraypie.php    css: bootstrap_customYCB  ?>
          </footer><!-- /hero-footer -->       
      </div> <!-- /container -->     
       
</body>
</html> 
<?php  cerrarConexion(); /* se cierra la conexion  */ ?>