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
	
    <div class="navbar navbar-fixed-top"><?php textoCabecera2("proyecto");  // en scripts > cabeceraypie.php ?>
     </div>
    
    <div class="container">
    	<div class="page-header"> <!-- ******** encabezado de página ******** -->
       	  <h1>Proyecto</h1>          
            <p class="smaller">Suministra a ficólogos, comunidad científica y público en general, información del inventario florístico de macroalgas bénticas realizado en el Parque Nacional Archipiélago Los Roques, Venezuela.<br />
            <span class="smaller-en">{ supplies to phycologists, scientific community and general public information about floristic inventory of benthic macroalgae made ​​in the Los Roques Archipelago National Park, Venezuela
            </span></p>
   	  </div>
      
        
         <div class="row"> <!-- / sección de contenido  -->
                <div class="span12">                      
                     <h2>Proyecto FONACIT LOCTI-PEI N° 2011001216, realizado con el  financiamiento del Fondo Nacional de Ciencia, Tecnología e Innovación y de la Facultad de Ciencias de la Universidad Central de Venezuela, además del apoyo de la Fundación Instituto Botánico de Venezuela "Tobías Lasser".
                       <br>
                       <br />            
                 </h2>
                </div>
             </div>   <!-- /row sección de contenido  -->       
      
      <div class="row"> <!-- / sección de contenido  -->
                <div class="span9" style="text-align:justify">
                    <p>
                    En Venezuela existe una importante diversidad de Algas Marinas Bénticas; sin embargo, carecemos de información florística y taxonómica actualizada de muchas regiones del país, tal es el caso del Parque Nacional Archipiélago Los Roques, cuya data es de hace dos o tres décadas, por otra parte existe una carencia de datos geográficos de las poblaciones naturales y su posible aprovechamiento.
                    </p>
                    <p>
El Parque Nacional Archipiélago Los Roques, es una de las áreas insulares más importantes de Venezuela, principalmente desde el punto de vista turístico.  Fue creado mediante el decreto oficial en fecha 18 de agosto de 1972 como uno de los 7 parques nacionales en ambiente marino.  Está situado al norte de la costa continental central de Venezuela a aproximadamente 120 Km al norte de Naiguatá.  Sus coordenadas geográficas lo ubican entre 11º 44' 45", 11º 48' 36" latitud norte y 66º 32' 44", 66º 52' 27" longitud oeste.  Es un archipiélago constituido por un complejo de arrecifes siendo  el primer parque marino-costero de Venezuela, abarcando una superficie de 221.120 hectáreas.  Está formado por aproximadamente 50 islas que forman un óvalo cercano a 36 Km en dirección este-oeste y 26 Km en dirección norte-sur (Novo 1997).
					</p><p>
Hasta el momento se ha publicado muy poca información ficoflorística actualizada sobre esta área  (Albornoz & Ríos, 1965; Ardito & Vera, 1997; Ganesan, 1989; García et al., 2013; Gessner & Hammer, 1967; Gómez, 1998; Gómez et al., 2013 a, Gómez et al., 2013b; Hammer & Gessner, 1967; Rodríguez, 1986b; Rodríguez, 1981; Rodríguez & Saito, 1985;  Taylor, 1976; Vera, 1993; Vera et al. 2011). De las referencias listadas anteriormente, casi la totalidad corresponde a estudios puntuales y un escaso número da información detallada sobre las localidades de colección. 
					</p><p>
Se puede establecer, en general, que la información ficoflorística publicada hasta ahora para Venezuela es pobre, tomando en consideración la amplia extensión de 2.800 Km lineales de costas continentales y las distintas islas y archipiélagos que conforman los parques nacionales marinos y las dependencias federales.  Sobre estas últimas, que generan la mayor parte de nuestra plataforma continental, se puede decir con toda seguridad que la información ficoflorística es aún más pobre.  Este conocimiento, junto con el ambiental, es fundamental dentro de la información básica que se debe tener a la mano cuando se emprenden investigaciones en otras áreas como la  ecológica, etnobotánica, proyectos de manejo turístico, ecoproductivos, inversión económica en áreas costeras,  etc.  Este estudio es una contribución al conocimiento de uno de estos aspectos básicos como lo es la actualización del conocimiento ficoflorístico de este archipiélago, y es un aporte general al estudio de la ficoflora de macroalgas bénticas marinas de Venezuela.<br>
					</p>
					<p>&nbsp; </p>
			      <h2> Resultados</h2>
					<ul>
					  <li>Más de 900 registros de colección, reportando 186 especies distribuidas de la siguiente manera:<br>
					    <br>
                        <ul>
                            <li>49 especies del Phylum Chlorophyta<br>
                              <br>
                            </li>
                            <li>  30 especies del Phylum Ochrophyta<br>
                              <br>
                            </li>
                          <li>107 especies del Phylum Rhodophyta
                            <br>
                            <br>
                          </li>
				        </ul>
					  </li>
					  <li>Veinte  (20) de estas especies son<strong> nuevos registros, diecinueve (19) para  Venezuela y una (1) para el Mar Caribe</strong>, las cuales podrán ser consultadas luego de ser válidamente publicadas.<br>
					    <br>
                      </li>
                      <li>Creación del libro <strong>&quot;Macroalgas Bénticas del Parque Nacional Archipiélago Los Roques, Venezuela. Guía Ilustrada&quot;</strong>
                            material educativo y divulgativo que está disponible para descarga en:<br /><br />
                            <a href="http://www.ciens.ucv.ve/ficofloravenezuela/documentos/CatalogoMacroalgasPNALR_Gomez_Garcia_Carballo-Barrera_Gil_EdiCienciasUCV_verWeb.pdf"
                                 title="Macroalgas Bénticas P.N. Archipiélago Los Roques Venezuela - Guía Ilustrada" target="_blank">
                                  <img src="http://www.ciens.ucv.ve/ficofloravenezuela/public/img_publicas/Macroalgas_PNALR_GuiaIlustrada.png" alt="Macroalgas P.N. Archipiélago Los Roques Venezuela - Guía Ilustrada" border="0">
                            </a>
                            <br>
                                Publicado por el <strong>Sello Editorial EdiCiencias UCV</strong>, Coordinación Académica, Facultad de Ciencias,
                                Universidad Central de Venezuela. Depósito Legal: DC2017001060, ISBN: 978-980-00-2859-9.
                        </li>
					</ul>
                </div>
                 
                <div class="span3" align="center">
                  <img src="images/algas1.png" class="thumbnail"/>
                  <p style="padding-top:40px;"> </p>
                  <img src="images/algas2.png"class="thumbnail" />
                 </div>                 
                 
         </div>   <!-- /row sección de contenido  --> 
         
       
          <footer><hr />
          <?php textoPieCreditos();  // en scripts > cabeceraypie.php    css: bootstrap_customYCB  ?>
          </footer><!-- /hero-footer -->       
      </div> <!-- /container -->     
       
</body>
</html> 
<?php  cerrarConexion(); /* se cierra la conexion  */ ?>