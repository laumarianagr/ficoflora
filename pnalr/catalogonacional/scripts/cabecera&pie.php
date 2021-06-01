<!--   includes con la información general para las secciones de la página en cabecera y pie de página -->

<?php function textoCabecera($page) {
	// cabecera de la página del index antes de autenticarse el usuario
    ?>
    <!--start: Container -->
    <div class="container">

        <!--start: Row -->
        <div class="row">
            <!--start: Logo -->
            <div class="logo span5">
                <a class="brand" href="index.php">
                    <img src="img/ficofloraVenezuela_logo4.png" alt="Ficoflora Venezuela logo"></a>
            </div>
            <!--end: Logo -->

            <!--start: Navigation -->
            <div class="span7">

                <div class="navbar navbar-inverse">
                    <div class="navbar-inner">
                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                        <div class="nav-collapse collapse">
                            <ul class="nav">
                                <li <?php if ($page=="index") echo " class='active'";?> ><a href="index_index.php" title="página Inicio">Inicio</a></li>
                                <li <?php if ($page=="proyecto") echo " class='active'";?> ><a href="proyecto.php" title="página Proyecto">Proyecto</a></li>
                                <li <?php if ($page=="catalogo") echo " class='active'";?> ><a href="catalogo.php" title="página Catálogo Ficoflora">Catálogo</a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Consultar<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="../ficoflora_consultas/public/buscar/especies" title="consultar por Especies">Especies</a></li>
                                        <li><a href="../ficoflora_consultas/public/buscar/taxonomia" title="consultar por Clasificación">Clasificación Taxonómica</a></li>
                                        <li><a href="../ficoflora_consultas/public/buscar/ubicacion" title="consultar por Ubicación geográfica">Ubicaciones</a></li>
                                        <li class="divider"></li>
                                        <li class="nav-header">Otros recursos</li>
                                        <li><a href="http://www.ciens.ucv.ve/ficofloravenezuela/pnalr/index.php" target="_blank" title="ir al Catálogo PNALR">Catálogo PNALR</a></li>
                                        <li <?php if ($page=="otroscatalogos") echo " class='active'";?> ><a href="otroscatalogos.php" title="referencias a Otros Catálogos">Otros Catálogos</a></li>
                                        <li <?php if ($page=="referenciasbibliograficas") echo " class='active'";?> ><a href="../ficoflora_consultas/public/buscar/referencias" title="consultar Referencias Bibliograficas">Referencias Bibliográficas</a></li>
                                        <li <?php if ($page=="proyecto_creditos") echo " class='active'";?> ><a href="proyecto.php#creditos" title="consultar Créditos Ficoflora Venezuela">Créditos</a></li>
                                    </ul>
                                </li>
                                <li <?php if ($page=="contactos") echo " class='active'";?> ><a href="contactos.php" title="página Contactos">Contactos</a></li>
                                <!--<li><a href="logout.php" alt="cerrar Sesión">Cerrar Sesión</a></li> -->

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--end: Navigation -->
        </div>
        <!--end: Row -->
    </div>
    <!--end: Container-->

    <!-- start: Page Title -->
    <div id="page-title">
        <div id="page-title-inner">
            <!-- start: Container -->
            <div class="container">			<!-- up green bar  -->

                <div class="left-inner-addon navbar-right">
                    <i class="icon-search"></i>
                    <input type="search" class="form-control" placeholder="buscar especie" />
                </div>
            </div>
            <!-- end: Container  -->
        </div>
    </div>
    <!-- end: Page Title -->
<?php //end cabecera
}

function footermenu() { // enlaces en el pie de página ?>

    <div id="footer-menu" class="hidden-tablet hidden-phone">

		<!-- start: Container -->
		<div class="container">

			<!-- start: Row -->
			<div class="row">

				<!-- start: Footer Menu Logo -->
				<div class="span2">
					<div id="footer-menu-logo">
						<a href="#"><img src="img/ficofloraVenezuela_ico.png" alt="Ficoflora logo" /></a>
					</div>
				</div>
				<!-- end: Footer Menu Logo -->

				<!-- start: Footer Menu Links-->
				<div class="span9">

					<div id="footer-menu-links">

						<ul id="footer-nav">
							<li><a href="index.php" alt="página Inicio">Inicio</a></li>
							<li><a href="proyecto.php" alt="página Proyecto">Proyecto</a></li>
							<li><a href="catalogo.php" alt="página Catálogo Ficoflora">Catálogo</a></li>
							<li><a href="../ficoflora_consultas/public/buscar/especies">Consultar</a></li>
							<li><a href="referenciasbibliograficas.php" alt="consultar Bibliografía">Referencias Bibliográficas</a></li>
							<li><a href="proyecto.php#creditos" alt="Créditos Ficoflora Venezuela">Créditos</a></li>
							<li><a href="contactos.php" alt="página Contactos">Contactos</a></li>
                            <li><a href="logout.php" class="close" alt="cerrar Sesión">Cerrar Sesión</a></li>
						</ul>

					</div>
				</div>
				<!-- end: Footer Menu Links-->

				<!-- start: Footer Menu Back To Top -->
				<div class="span1">

					<div id="footer-menu-back-to-top">
						<a href="#" title="subir" alt="subir"></a>
					</div>

				</div>
				<!-- end: Footer Menu Back To Top -->
			</div>
			<!-- end: Row -->
		</div>
		<!-- end: Container  -->
	</div>

    <?php //end footermenu
}

function footercopyright() { // créditos y estadísticas  en el pie de página ?>
<!-- start: Copyright -->
	<div id="copyright" >

		<!-- start: Container -->
		<div class="container">
			<!-- start: Row -->
			<div class="row">
				<!-- start: Footer credits -->
        			<p>
                        2015-<span id="agnoCopyright"></span> &copy; Proyecto Ficoflora Venezuela &
						<a href="" alt="Gómez, Carballo, García & Gil" title="Gómez, Carballo, García & Gil">G<sup>3</sup>C </a>
						&nbsp;&nbsp;&nbsp; :: &nbsp;&nbsp;&nbsp; designed by <a href="mailto:yusneyicarballo@gmail.com" alt="Yusneyi Carballo Barrera :: Desarrollo Soluciones Web" target="_blank">YCB</a> & <a href="http://bootstrapmaster.com" alt="Bootstrap Themes" target="_blank">Bootstrap Themes</a>
        			</p>
			</div>
		</div>
		<!-- end: Container  -->

	</div>
	<!-- end: Copyright -->
<?php //end footer copyright
}