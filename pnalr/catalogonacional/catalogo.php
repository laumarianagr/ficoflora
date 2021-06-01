<!DOCTYPE html>
<html lang="en">
<head>

	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Ficoflora Venezuela | Catálogo Ficoflora</title> 
	<meta name="description" content="Catálogo de macroalgas bénticas marinas de Venezuela, validación taxonómica de registros, ilustración morfoanatómica, datos taxonómicos, ecológicos, geográficos, bibliográficos, mapas y fotografías."/>
	<meta name="keywords" content="ficoflora, macroalgas, algas bénticas marinas, catálogo de algas, sistemática de algas, phycoflora, macroalgae, marine benthic algae, algae catalog, systematic algae, UCV, FIBV, UPEL." />
    <meta name="author" content="Yusneyi Carballo Barrera (CENEAC UCV) :: Santiago Gómez Acevedo (IBE UCV). Web design & programming: Yusneyi Carballo Barrera"/>
	<link rel="icon" type="image/png" href="favicon.ico" />
	<!-- based templeate: Lukasz Holeczek from creativeLabs :: Bootstrap Themes http://bootstrapmaster.com -->
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: Facebook Open Graph -->
	<meta property="og:title" content=""/>
	<meta property="og:description" content=""/>
	<meta property="og:type" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:image" content=""/>
	<!-- end: Facebook Open Graph -->

    <!-- start: CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Droid+Sans:400,700">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Droid+Serif">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Boogaloo">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Economica:700,400italic">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Satisfy">
	<!-- end: CSS -->

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- includes -->
    <?php include("scripts/cabecera&pie.php"); ?>
    <!-- end includes -->

</head>
<body>

    <!--start: Header -->
    <header>
        <?php textoCabecera("catalogo");  // en scripts > cabeceraypie.php ?>
    </header>
    <!--end: Header-->
	
	<!--start: Wrapper-->
	<div id="wrapper">
		<!--start: Container -->
    	<div class="container">
			<!--start: Row -->
	    	<div class="row">
		
				<div class="span8"><!--start: LEFT area -->
					
					<!-- start: About Phycoflora Venezuela Digital Catalog Taxonomic -->
					<div id="about">
						<div class="title"><h3><i class="ico-stats ico-color"></i>Catálogo Taxonómico Digital Ficoflora Venezuela</h3></div>
						<p>
							En este proyecto interdisciplinario participan investigadores de la Biología y la Computación,
							a fin de recopilar y actualizar la información ficoflorística venezolana, elaborándose una base de datos de acceso público,
							de utilidad para  colegas ficólogos, docentes, estudiantes y el público en general.  
						</p>
						<p>
						   	Para la elaboración de este primer catálogo taxonómico digital de nuestra ficoflora, se han considerado más de <b>170 referencias 
							bibliográficas</b>, lo que ha permitido alimentar la base de datos mencionada con al menos <b>5.100 registros</b>.					
						</p>
					</div>	
					<!-- end: About -->
					
									
                	<!-- start photo -->	
                	<div class="box-shadow">
						 <img src="img/parallax-slider/8_v2.jpg" alt="Península de Paria" title="Península de Paria" class="photo" />
                	</div>
					<p class="fuente"><b>Península de Paria</b>, Estado Sucre, Venezuela  
					<span class="fotografo">| <i class="mini-ico-camera"></i> Santiago Gómez &copy; </span>
					</p>
                	<!-- end: photo -->	
					
					
					<!-- start: continue ... About Phycoflora Venezuela Digital Catalog Taxonomic -->
					<div id="about">
						<div class="title"><h3>Funcionalidades</h3></div>
					
						<p>
							Las principales funcionalidades incorporadas en este catálogo taxonómico digital son:
							<br /><br />
							<ul class="vigneta2">
								<li>Consulta de registros por cualquiera de las categorías taxonómicas, desde phylum hasta especie, por autor y 
								por localidad geográfica
								</li>
								<li>Listados con todos los registros reportados, para cualquiera de las categorías taxonómicas y por localidad
								</li>	
								<li>Referencias de las fuentes bibliográficas, hemerográficas y reportes incorporados
								</li>																									
								<li>Exportación de los resultados de las consultas y de la información de la ficha de las especies en formato de 
								documento portable (.pdf)
								</li>	
								<li>Generación dinámica de mapas, indicando la geo-referenciación de las especies
								</li>
								<li>Galería de fotografías
								</li>
								<li>Diseño adaptativo que permite acceder al catálogo digital desde distintos dispositivos.
								</li>						
							</ul>  
						</p>
											
					</div>	
					<!-- end: About -->					
            		<!--end: LEFT area   -->
				</div>	
				
				<div class="span4"> <!-- start: Sidebar  RIGHT  area -->
					<div id="sidebar">

                        <!-- start: Tabs -->
                        <div class="title"><h3>Colaboraciones</h3></div>

                        <ul class="tabs-nav">
                            <li class="active"><a href="#tab1"><i class="mini-ico-pencil"></i> ¿Cómo citarnos?</a></li>
                            <li><a href="#tab2"><i class="mini-ico-plus"></i> Enviar reportes</a></li>
                            <!-- <li><a href="#tab3"><i class="mini-ico-plus"></i> Tab 3</a></li>  -->
                        </ul>

                        <div class="tabs-container">
                            <div class="tab-content" id="tab1">
                                <h4>Web Ficoflora Venezuela (<span id="agno"></span>)</h4> <br />
                                Referencia: <br />
                                Web Ficoflora Venezuela. <span id="agno2"></span>. <b>Catálogo de la Ficoflora de Venezuela</b>.
                                Publicación electrónica. Universidad Central de Venezuela, Caracas.
                                Editores: Yusneyi Carballo-Barrera, Santiago Gómez, Mayra García & Nelson Gil.
                                Consultado el <span id="fecha"></span>,
                                en <a href="http://www.ciens.ucv.ve/ficofloravenezuela" target="_blank" title="Web Ficoflora Venezuela" alt="Web Ficoflora Venezuela">
                                    http://www.ciens.ucv.ve/ficofloravenezuela</a>
                            </div>

                            <div class="tab-content" id="tab2">
                                <p>
                                    Agradecemos su colaboración para mantener actualizado este catálogo nacional. <br />
                                    Puede enviarnos sus reportes de especies, artículos de investigación, fotografías,
                                    noticias o eventos escribiendo a: <br />
                                    <i class="ico-envelope"></i>
                                    <a href="mailto:santiago.gomez@ciens.ucv.ve" target="_blank">santiago.gomez@ciens.ucv.ve</a> <br />
                                    <i class="ico-envelope"></i>
                                    <a href="mailto:yusneyi.carballo@ciens.ucv.ve" target="_blank">yusneyi.carballo@ciens.ucv.ve</a><br />
                                    o mediante un mensaje en: <br />
                                    <i class="ico-envelope"></i>
                                    <a href="contactos.php" target="_parent">contactos</a>
                                </p>
                            </div>
                            <!-- <div class="tab-content" id="tab3">3. Lorem ipsum pharetra felis. Aliquam egestas consectetur elementum class aptent taciti sociosqu ad litora torquent perea conubia nostra lorem inceptos orem ipsum dolor sit amet, consectetur adipiscing elit.</div> -->
                        </div>
                        <!-- end: Tabs -->

                        <br />

						<!-- start: Skills -->
				       	<div class="title"><h3>Ya incorporamos</h3></div>
				       	<ul class="progress-bar">
				        	<li>
				            	<h5>Reportes ( +5.300 )</h5>
				            	<div class="meter"><span style="width: 100%"></span></div><!-- Edite width here -->
				          	</li>
				          	<li>
				            	<h5>Especies, incluyendo variedades y formas ( +580 )</h5>
				            	<div class="meter"><span style="width: 60%"></span></div><!-- Edite width here -->
				          	</li>
				          	<li>
				            	<h5>Referencias Bibliográficas ( +170 )</h5>
				            	<div class="meter"><span style="width: 70%"></span></div><!-- Edite width here -->
				          	</li>							
				          	<li>
				            	<h5>Geo-localizaciones y mapas ( +400 )</h5>
				            	<div class="meter"><span style="width: 100%"></span></div><!-- Edite width here -->
				          	</li>
				      	</ul>
				      	<!-- end: Skills -->

					</div>
					<!-- end: Sidebar   RIGHT area   -->					
				</div>
				
			</div>
			<!--end: Row-->
	
		</div>
		<!--end: Container-->
				
		<!--start: Container -->
    	<div class="container">	

					<!-- start: species profile -->
					<div id="speciesprofile">
						<div class="title"><h3>Ficha de la Especie</h3></div>
						<p>
							Cada una de las especies reportadas que están registradas en la base de datos "Ficoflora Venezuela" posee una ficha descriptiva, 
							en donde es clasificada, se listan los autores que la han reportado, las localidades y las fuentes bibliográficas citadas, 
							se muestran mapas con la geo-localización de la especie, sinonimia y una galería de fotografías cuando se 
							dispone de esta información.
						</p>
						<p>
							Dado que uno de los objetivos principales de la aplicación web es la preservación y la divulgación de la información, la ficha especie se puede 
							descargar y guardar en formato de documento portable o .pdf.
						</p>								
						<p>
							Las principales secciones y herramientas de la ficha especie se describen a continuación:
							<br /><br />
						</p>											
						<p>
							<span class="dropcap color1">1</span>
								 La sección de <b>encabezado</b> muestra la identificación del catálogo, suministra enlaces a las páginas del sitio y  
								 campos para la búsqueda por nombre de especie.
						</p>
						<p>
							<span class="dropcap color2">2</span>
								 Sección de <b>identificación</b> de la especie consultada, clasificación taxonómica con enlaces que permiten
								 la consulta de los niveles superiores y la opción de exportar o guardar como archivo .pdf.
						</p>
						<p>
							<span class="dropcap color3">3</span>
								 En la sección de <b>reportes</b> se indican los reportes de la especie en el país, en las respectiva fuente bibliográfica. 
								 Puede seleccionar cuántos reportes mostrar por página, filtrar por autor, localidad o año de la publicación, 
								 además de ordenar, ascendente o descendentemente, por año o autor del reporte.
						</p>										
						<p>
							<span class="dropcap dark">4</span>
								 Ficoflora Venezuela incorpora <b>mapas dinámicos</b> para mostrar la ubicación geográfica de la localidad,
								 desde la entidad federal que es la más amplia, siguiendo en orden descendente por localidades y lugares, hasta la ubicación 
								 más específica que es el sitio. Haciendo clic en el nombre de la ubicación o en el icono 								 
								 <img src="img/poi.png" alt="icono mostrar mapa" title="icono mostrar mapa" /> se muestra el mapa de la misma.
						</p>
						<p>
							<span class="dropcap dark">5</span>
								 En la sección <b>izquierda</b> se muestra la fotografía principal y enlaces al mapa con la ubicación en Venezuela 
								 de la especie, galería fotográfica, opción para exportar a .pdf, lista de especies del género, nueva búsqueda,
								 y sinonimia, si se tienen reportes con esta información.
						<p>
							<span class="dropcap color3">6</span>
								 La <b>galería</b> incluye fotos de hábito y/o de laboratorio que se pueden ampliar al hacer clic sobre ellas.
								 <br />
								 <span class="caligrafia">¿Tiene fotos que quiere compartir?</span> por favor 
								 <a href="contactos.php" alt="página Contactos">escríbanos</a>, en colaboración podemos suministrar un catálogo
								 lo más completo posible. 
						</p>
						<p>
							<span class="dropcap color2">7</span>
								 La sección de <b>referencias bibliográficas</b> muestra la información de las fuentes en donde se reportan 
								 las especies, incluyendo artículos, trabajos académicos y sitios web. 
								 Puede indicar cuántas referencias mostrar por página, filtrarlas por autor, año, parte del título, nombre de la
								 revista o cualquier otro dato de la referencia, además de ordenar, ascendente o descendentemente, 
								 por año o autor del reporte.  								 
						</p>	
						<p>
							<span class="dropcap color1">8</span>
								 Finalmente, <span class="caligrafia"> SE AGRADECE TODA AYUDA</span> que contribuya a divulgar esta iniciativa
								 y a posicionar al Catálogo Taxonómico Digital Ficoflora Venezuela como una referencia importante en 
								 la comunidad científica venezolana, citando adecuadamente el sitio web cuando sea consultado y utilice la  
								 información y recursos, sean listas de especies, listas de reportes, fotos o mapas.
						</p>

						<p>&nbsp;
						</p>						
						<p>
								 Para evitar la duplicación de información, no se citan en la sección bibliográfica otros catálogos publicados en 
								 Venezuela, esta lista está disponible en el menú superior > opción Consultar > "Otros recursos".
						</p>
						<p>
						   		 En los reportes encontrados en la bibliografía venezolana, existe amplia variabilidad en cuanto a nombres y sinónimos
								 válidos, así como en autoridades taxonómicas; es por esto que en el interés de homogeneizar al máximo posible la 
								 información presentada, todos los nombres y sinónimos taxonómicos válidos,  así como las autoridades se han corregido 
								 tomando como base lo establecido en el sitio web <a href="../www.algaebase.org" target="_blank" alt="ir a AlgaEBase"  title="ir a AlgaEBase">AlgaeBase</a>. 
								 Además, hemos tratado  de homogeneizar hasta donde es posible, la amplia diversidad reportada en localidades, lugares y sitios.
						</p>
						
					</div>					
							
					<div class="row">
						<p>
						   <br /><br />
						   En la siguiente figura puede observarse un ejemplo de nuestra ficha descriptiva de las especies:
						   <br />
						</p>				   					
    					<!-- star: photo -->
    					<div class="box-shadow">
    						 <img src="img/ficofloraVenezuela_ima1.png" alt="Ficha Especie de Ficoflora Venezuela" 
							 	  title="Ficha Especie de Ficoflora Venezuela" class="photo" style="border: 1px #999 solid;" />
                        	</div>
        					<p class="fuente"><b>Ficha de la especie <i>Acrochaetium microscopicum</i></b>, Catálogo Taxonómico Digital Ficoflora Venezuela.</span>
        					</p>
    						
    					</div>	
    					<!-- end: Species profile -->
					</div>				
					
			<hr>
		
		</div>
		<!--end: Container-->	

	</div>
	<!-- end: Wrapper  -->

    <!-- start: Footer Menu -->
    <?php footermenu();  // en scripts > cabeceraypie.php ?>
    <!-- end: Footer Menu -->

    <!-- start: Footer Copyright -->
    <?php footercopyright();  // en scripts > cabeceraypie.php ?>
    <!-- end: Footer Copyright -->

<!-- start: Java Script -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery-1.8.2.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/flexslider.js"></script>
<script src="js/carousel.js"></script>
<script src="js/jquery.cslider.js"></script>
<script src="js/slider.js"></script>
<script def src="js/custom.js"></script>
<script def src="js/functions.js"></script>
<!-- end: Java Script -->

</body>
</html>	