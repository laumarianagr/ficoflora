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

    <link rel="icon" type="image/png" href="favicon3.ico" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-112775031-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-112775031-1');
    </script>

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
  })
</script>

<body>
	
    <div class="navbar navbar-fixed-top"><?php textoCabecera2("creditos");  // en scripts > cabeceraypie.php ?>
     </div>
    
    <div class="container">
    	<div class="page-header"> <!-- ******** encabezado de página ******** -->
       	  <h1>Créditos</h1>          
            <p class="smaller">Este proyecto combina la experiencia y los conocimientos interdisciplinarios de profesionales de la docencia, la investigación, la biología y la computación.<br />
            <span class="smaller-en">{ this  project combines the experience and expertise of professional interdisciplinary  teaching-research in biology and computation </span></p>
   	  </div>
      
      
        
         <div class="row"> <!-- / sección de contenido  -->
                <div class="span12">                      
                  <h2>Financiamiento</h2>
                     <h4>Fondo Nacional de Ciencia, Tecnología e Innovación (Proyecto FONACIT LOCTI-PEI N° 2011001216) y Facultad de Ciencias de la Universidad Central de Venezuela.</h4>
                  <h4>&nbsp;</h4>
                  <h2>Actividades de Laboratorio</h2>
                     <h4>Instituto Experimental Jardín Botánico &quot;Dr. Tobías Lasser&quot; (antes Fundación Instituto Botánico de Venezuela  &quot;Dr. Tobías Lasser&quot;): revisión y separación de muestras, toma de fotografías, descripciones morfoanatómicas, identificación taxonómica y preparación de excicatas.<br>
                       <br />            
                  </h4>
</div>
             </div>   <!-- /row sección de contenido  -->       
      
      <div class="row"> <!-- / sección de contenido  -->
                <div class="span12">
                    <h2>Investigadores</h2>
                    <br />
                 </div>
                
                <div class="span3">
                  <img src="images/foto_SantiagoGomez.png" alt="Santiago Gómez" class="thumbnail" />
                 <h2>Santiago G&oacute;mez Acevedo</h2>
                   <p>Bi&oacute;logo <br />
                        Taxonom&iacutea de Algas Marinas Tropicales <br />
                        IBE - UCV<br />
                        <a href="mailto:santiago.gomez@ciens.ucv.ve" title="enviar correo-e a Santiago Gómez">
                        		<img src="images/ico_correo3.gif" />
                        		santiago.gomez@ciens.ucv.ve</a>
                     <br />
                        <a href="mailto:chachacho@gmail.com" title="enviar correo-e a Santiago Gómez">
                        		<img src="images/ico_correo3.gif" />
                        		chachacho@gmail.com</a>
                      </p>
                </div>
                
                <div class="span3">
                  <img src="images/foto_YusneyiCarballo.png" alt="Yusneyi Carballo" width="94" height="87" class="thumbnail" />
                <h2>Yusneyi Carballo Barrera</h2>
                   <p>Computista <br />
                        Tecnologías Educativas y  Desarrollo de Aplicaciones Web <br />
                        CENEAC - UCV <br />
                        <a href="mailto:yusneyi.carballo@ciens.ucv.ve" title="enviar correo-e a Yusneyi Carballo Barrera">
                        		<img src="images/ico_correo3.gif" />
                        		yusneyi.carballo@ciens.ucv.ve</a>
                     <br />
                        <a href="mailto:yusneyicarballo@gmail.com" title="enviar correo-e a Yusneyi Carballo Barrera">
                        		<img src="images/ico_correo3.gif" />
                        		yusneyicarballo@gmail.com</a>
                      </p>
                </div>                
                
                
                <div class="span3"><img src="images/foto_MayraGarcia.png" alt="Mayra García" width="94" height="87" class="thumbnail" />
       <h2>Mayra Garc&iacute;a Ortiz</h2>
                   <p>Bi&oacute;loga <br />
                        Taxonomía de Algas Marinas Tropicales <br />
                        FIBV - UCV<br />
                        <a href="mailto:mayra.garcia@ucv.ve " title="enviar correo-e a Mayra García">
                        		<img src="images/ico_correo3.gif" />
                        		mayra.garcia@ucv.ve</a>                                
                     <br />
                        <a href="mailto:garciaes@gmail.com" title="enviar correo-e a Mayra García">
                        		<img src="images/ico_correo3.gif" />
                        		garciaes@gmail.com</a>                        
                      </p>
                </div>
                
                
                <div class="span3"><img src="images/foto_NelsonGil.png" alt="Nelson Gil" width="94" height="87" class="thumbnail" />
              <h2>Nelson Gil Luna</h2>
                   <p>Bi&oacute;logo <br />
                        Taxonom&iacutea de Algas Marinas Tropicales <br /> 
                        IPM - UPEL<br />
                        <a href="mailto:biociencia@gmail.com" title="enviar correo-e a Nelson Gil">
                        		<img src="images/ico_correo3.gif" />
                        		biociencia@gmail.com</a>
                      </p>
                </div>

         </div>   <!-- /row sección de contenido  --> 
         
         <div class="row"> <!-- / sección de contenido  -->
                <div class="span12">
                <h2>Créditos</h2>
                   <ul class="list">
                        <li> <b>	Trabajo de campo y colección de muestras:  </b>
           				Santiago Gómez Acevedo, Mayra García Ortiz, Nelson Gil Luna y Yusneyi Carballo Barrera</li>
                        <li><b> Análisis de laboratorio e identificación  de especies: </b> Mayra García Ortiz y Santiago Gómez Acevedo</li>
                        <li><b> Descripción de especies,  fotografías y mapas: </b> Santiago Gómez Acevedo, Mayra García Ortiz y Yusneyi Carballo Barrera</li>
                        
                        <li> <b>	Conceptualización de la base de datos: </b>
                                     Yusneyi Carballo Barrera, Santiago Gómez Acevedo y Mayra García Ortiz</li>
                        
                        <li> <b>	Desarrollo del sitio web, diseño de la base de datos y generador de mapas de localización de especies: </b>
                                        Yusneyi Carballo Barrera
                        </li>                        
                  </ul>                    
                 </div>



           <div class="span12">
             <br />
             <h2>Agradecimientos</h2>
              <ul class="list">
                   <li>Fundación Científica Los Roques</li>

           	       <li>Línea Turística Aerotuy</li>

                   <li>Arrecife Divers y Posada JuanFer (Gran Roque)   </li>

                   <li>También es importante mencionar a aquellas personas que de una u otra manera prestaron un apoyo importante, sin el cual este trabajo no hubiese tenido el alcance esperado y logrado:                                                                            Sra. Blanca Machado (Fundación Científica Los Roques),
                     Sr. Gianmarco Assandria (Arrecife Divers, Caracas),
                     Sr. Maurizio Legori y Sr. Juan Carlos Bastidas (Arrecife Divers, Gran Roque),
                      Sr. Jesús José "Morocho" Andarcia (Lanchero en Los Roques).</li>

                  <li>Al Sello Editorial EdiCiencias UCV, Coordinación Académica de la Facultad de Ciencias de la Universidad Central de Venezuela,
                      por el apoyo y patrocinio en la publicación de la obra <br>
                      <b>"Macroalgas Bénticas Marinas del Parque Nacional Archipiélago Los Roques, Venezuela. Guía Ilustrada" <br>
                      &copy; 2017, Santiago Gómez Acevedo, Mayra García Ortiz, Yusneyi Carballo Barrera, Nelson Gil Luna</b>
                      <br>
                      DEPÓSITO LEGAL: DC2017001060, ISBN: 978-980-00-2859-9
                      <br>
                      <a href="http://www.ciens.ucv.ve/ficofloravenezuela/documentos/CatalogoMacroalgasPNALR_Gomez_Garcia_Carballo-Barrera_Gil_EdiCienciasUCV_verWeb.pdf"
                         title="Macroalgas Bénticas P.N. Archipiélago Los Roques Venezuela - Guía Ilustrada" target="_blank">
                          <img src="http://www.ciens.ucv.ve/ficofloravenezuela/public/img_publicas/Macroalgas_PNALR_GuiaIlustrada.png" alt="Macroalgas P.N. Archipiélago Los Roques Venezuela - Guía Ilustrada" border="0">
                      </a>
                  </li>
              </ul>
           </div>

           <div class="span12">
             <br />
             <h2>Herramientas utilizadas</h2>
              <ul class="list">
                   <li>
                     <b>	Mapas  </b><br />
       				 Mapa general de Venezuela, generado con MapInfo Professional, versión 7.5, de <a href="http://www.mapinfo.com/" target="_blank">MapInfo Corporation</a><br />
				   Mapas de las localidadades en el PNALR, generados con  MapSource, versión 6.16.3, de <a href="http://www.garmin.com/es-ES/maps" target="_blank">Garmín Mapas Ltd </a></li>

                <li>
                     <b>	Herramientas de Software y Librerías  </b><br />
			      <a href="http://www.php.net/" target="_blank">PHP</a>, <a href="http://www.mysql.com/" target="_blank">MySQL</a>, <a href="http://www.w3schools.com/css/css3_intro.asp" target="_blank">CSS3</a>, <a href="http://getbootstrap.com" target="_blank">Bootstrap</a>, <a href="http://www.mpdf1.com/mpdf/index.php" target="_blank">mPDF</a>, <a href="http://www.jquery.com/" target="_blank">jQuery</a>,  <a href="http://www.jqueryui.com/" target="_blank">jQuery UI</a>, <a href="http://www.fancybox.net/" target="_blank">FancyBox galleria</a>, <a href="http://www.adobe.com/la/products/photoshop.html" target="_blank">Photoshop</a>, <a href="http://www.motic.com/en/" target="_blank">Motic Images Plus</a></li>                                             
             </ul>                    
             </div>
             </div>   <!-- /row sección de contenido  -->  
             
        <div class="row"> <!-- / sección de fotos y logos inferiores  -->
            
       		<div class="span12" id="fotosPie"> <!-- /foto pnalr y  logos institucionales--><a href="http://www.ucv.ve/" target="_blank" title="Universidad Central de Venezuela">
            <img src="images/logoUCV_peq.png" alt="sitio web UCV"></a>  
                                        
                    <a href="http://www.ciens.ucv.ve/ciens/" target="_blank" title="Facultad de Ciencias UCV">
                    <img src="images/logoFacCiencias.png" alt="sitio web Facultad de Ciencias"></a>  
                    
                    <a href="http://www.ciens.ucv.ve/escueladecomputacion/inicio/index" target="_blank" title="Escuela de Computación">
                    <img src="images/logoEscComputacion.png" alt="sitio web Escuela de Computación"></a>
                    
                    <a href="http://www.ucv.ve/organizacion/fundaciones-asociaciones-y-centros/fundacion-instituto-botanico-de-venezuela.html" target="_blank" title="Fundaci&oacute;n Instituto Bot&aacute;nico de Venezuela Dr. Tob&iacute;as Lasser">
                    <img src="images/logoFIBV.png" alt="sitio web FJBV"></a>
                  <a href="http://www.ciens.ucv.ve/ibexp/Index.htm" target="_blank" title="Instituto de Biología Experimental"><img src="images/logoIBE.png"></a>                     
                    
                    <a href="http://www.ipmjmsm.upel.edu.ve/" target="_blank" title="Instituto Pedag&oacute;gico de Miranda Jos&eacute; Manuel Siso Mart&iacute;nez">
                    <img src="images/logoIMP_JMSM.png" alt="sitio web IPM-JMSM"></a>
                    
            <a href="http://www.upel.edu.ve/" title="Universidad Pedagógica Experimental Libertador" target="_blank"><img src="images/logoUPEL.png" alt="sitio web UPEL" title="Universidad Pedagógica Experimental Libertador" /></a></div>
</div><!-- /row -->             
       
          <footer><hr />
          <?php textoPieCreditos();  // en scripts > cabeceraypie.php    css: bootstrap_customYCB  ?>
          </footer><!-- /hero-footer -->           

      </div> <!-- /container -->     
       
</body>
</html> 
<?php  cerrarConexion(); /* se cierra la conexion  */ ?>