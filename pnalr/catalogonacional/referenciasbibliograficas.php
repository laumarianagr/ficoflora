<!DOCTYPE html>
<html lang="en">
<head>

	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Ficoflora Venezuela | Referencias Bibliográficas</title>
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
	<!-- end: CSS -->

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- includes -->
    <?php
    include("scripts/conexion.php");
    include("scripts/cabecera&pie.php");
    include("scripts/get_referenciasbibliograficas.php");
    include("scripts/get_foto.php");

    abrirConexion();
    ?>
    <!-- end includes -->

</head>
<body>
<a name='inicio' id='inicio'></a>

    <!--start: Header -->
    <header>
        <?php textoCabecera("referenciasbibliograficas");  // en scripts > cabeceraypie.php ?>
    </header>
    <!--end: Header-->

	<!--start: Wrapper-->
	<div id="wrapper">
		<!--start: Container -->
    	<div class="container">
			<!--start: Row -->
	    	<div class="row">
		
				<div class="span8"><!-- start: Referencias -->
					<div id="about">
						<div class="title"><h3><i class="ico-book ico-color"></i>Referencias bibliográficas</h3></div>
                        <p align="center">
                            A continuación listamos las referencias bibliograficas citadas en Ficoflora Venezuela: <br/>
                        </p>
                        <p align="center">
                            <a href="#revistas" title="consultar Revistas">Revistas</a> &nbsp; &#8226; &nbsp;
                            <a href="#libros" title="consultar Libros">Libros</a> &nbsp; &#8226; &nbsp;
                            <a href="#trabajos" title="consultar Trabajos Académicos">Trabajos Académicos</a> &nbsp; &#8226; &nbsp;
                            <a href="#web" title="consultar Sitios Web">Sitios Web</a>
                        </p>
                        <?php
                        // consultas a la fuente de referencia
                        echo "<a name='revistas' id='revistas'></a>";
                        consultarReferencias("revistas");
                        $foto = "img/parallax-slider/4_v2.jpg";
                        $fuente = "<b><em>Turbinaria tricostata</em></b>, E.S.Barton";
                        $credito = "Santiago Gómez &copy;";
                        mostrarFoto($foto, $fuente, $credito);

                        echo "<a name='libros' id='libros'></a>";
                        consultarReferencias("libros");
                        $foto = "img/parallax-slider/11_v2.jpg";
                        $fuente = "<b>Parque Nacional Mochima</b>, Estados Anzoátegui y Sucre";
                        $credito = "Santiago Gómez &copy;";
                        mostrarFoto($foto, $fuente, $credito);

                        echo "<a name='trabajos' id='trabajos'></a>";
                        consultarReferencias("trabajos");
                        $foto = "img/parallax-slider/8_v2.jpg";
                        $fuente = "<b>Península de Araya</b>, Estado Sucre";
                        $credito = "Santiago Gómez &copy;";
                        mostrarFoto($foto, $fuente, $credito);

                        echo "<a name='web' id='web'></a>";
                        consultarReferencias("web");
                        $foto = "img/parallax-slider/10_v2.jpg";
                        $fuente = "<b>Parque Nacional Archipiélago Los Roques</b>, Territorio Insular Miranda";
                        $credito = "Santiago Gómez &copy;";
                        mostrarFoto($foto, $fuente, $credito);
                        ?>

					</div>	
					<!-- end: About Us -->
					
            		<!--start: Row -->

            		<!--end: Row   LEFT area   -->						
				</div>				
				
				<div class="span4">
					
					<!-- start: Sidebar -->
					<div id="sidebar">

						<!-- start: Tabs -->
						<div class="title"><h3>Colaboraciones</h3></div>

						<ul class="tabs-nav">
							<li><a href="#tab1"><i class="mini-ico-pencil"></i> ¿Cómo citarnos?</a></li>
							<li class="active"><a href="#tab2"><i class="mini-ico-plus"></i> Enviar reportes</a></li>
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

						<!-- start: Testimonials-->

						<div class="testimonial-container">

							<div class="title"><h3>Incorporaciones recientes</h3></div>

								<div class="testimonials-carousel" data-autorotate="3000">

									<ul class="carousel">

										<li class="testimonial">
											<div class="testimonials">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</div>
											<div class="testimonials-bg"></div>
											<div class="testimonials-author">Fuente, <span>dd/mm/aaaa</span></div>
										</li>

										<li class="testimonial">
											<div class="testimonials">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</div>
											<div class="testimonials-bg"></div>
											<div class="testimonials-author">Fuente, <span>dd/mm/aaaa</span></div>
										</li>
									</ul>

								</div>

							</div>

						<!-- end: Testimonials-->

					</div>
					<!-- end: Sidebar -->
					
				</div>
				
			</div>
			<!--end: Row-->
	
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
<?php  cerrarConexion(); /* se cierra la conexion  */ ?>