<!--   includes con la información general para las secciones de la página en cabecera y pie de página -->

<?php function barraNavegacion_opcionesComunes($page) {
// opciones barra de navegación superior
	
				//  **********  ***********  funcionalidades visitantes **********  **********  
?> 		  

              <li <?php if  ( ($page=="index") or ($page=="index_admin") )  echo " class='active'"; ?>>
              		<a href="index.php" title="ir a la Página Principal">Inicio</a></li>
              <li <?php if ($page=="proyecto") echo " class='active'"; ?>><a href="proyecto.php" 
              		title="ir a la Página Principal">Proyecto</a></li>
              <li <?php if ($page=="consultar") echo " class='active'"; ?>><a href="consultar.php" 
					title="ir a página de Consultas">Consultar</a></li>
              <li <?php if ($page=="referencias") echo " class='active'"; ?>><a href="referencias.php" 
					title="ir a página de Referencias Bibliográficas">Referencias</a></li>                    
              <li <?php if ($page=="creditos") echo " class='active'"; ?>><a href="creditos.php" 
              		title="ir a página de Créditos">Cr&eacute;ditos</a></li>
			
<?php }?>


<?php function barraNavegacion_opcionesPorPerfil($page) {
// opciones barra de navegación superior
			
			  //  **********  ***********  funcionalidades para perfil 3   **********  **********
			   if ( ($_SESSION["perfil"]==0 or $_SESSION["perfil"]==1 or 
						    $_SESSION["perfil"]==2 or $_SESSION["perfil"]==3)){ ?>
	
              <li class="dropdown<?php if ($page=="actualizar") echo " active"; ?>">   
              <!--   menu desplegable para opción Actualizar Información -->

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Actualizar
                        <b class="caret"></b> <!-- flecha del menu desplegable -->
                     </a>
                     <ul class="dropdown-menu">                     
							<?php
                            //  **********  ***********  funcionalidades para perfil 3   **********  **********
                             if (  $_SESSION["perfil"]==0 or $_SESSION["perfil"]==1 or 
								    $_SESSION["perfil"]==2 or $_SESSION["perfil"]==3) { ?>
								   
								   <li><a href="registrar.php">Registrar</a></li>
                            <?php   } 
                
                            //  **********  ***********  funcionalidades para perfil 0, 1 y 2   **********  **********
                             if ( $_SESSION["perfil"]==0 or $_SESSION["perfil"]==1 or $_SESSION["perfil"]==2){ ?>
								   
								   <li><a href="modificar.php">Modificar</a></li>                        
                                <?php   } 
                                
                                //  **********  ***********  funcionalidades para perfil 0   **********  **********
                                 if ( $_SESSION["perfil"]==0) { ?>
										 
										 <li><a href="importar.php">Importar</a></li> 
                                <?php   } 
                                ?>
						</ul>        
			  </li>
              <?php   }  ?>
              
               <?php
			  //  **********  ***********  funcionalidades para perfil 0 y 1   **********  **********
			   if ( $_SESSION["perfil"]==0 or $_SESSION["perfil"]==1) { ?>
                
              <li class="dropdown <?php if ($page=="respaldar") echo " active"; ?>">   
              <!--   menu desplegable para opción Respaldar Información -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Respaldar
                        <b class="caret"></b> <!-- flecha del menu desplegable -->
                     </a>
                     <ul class="dropdown-menu">                     
								<?php
                                //  **********  ***********  funcionalidades para perfil 0 y 1   **********  **********
                                 if ( $_SESSION["perfil"]==0 or $_SESSION["perfil"]==1) { ?>
									   
									   <li><a href="exportar.php">Exportar (xls o pdf)</a></li> 
									   <li><a href="respaldar.php">Respaldar (sql)</a></li>                         
                                <?php   } 

                                
                                //  **********  ***********  funcionalidades para perfil 0   **********  **********
                                 if ( $_SESSION["perfil"]==0) { ?>
										 
										 <li><a href="correlacionar.php">Correlacionar tablas</a></li> 
                                <?php   } 
                                ?>
						</ul>        
				</li>                
              <?php   }  ?>
                                  
			<?php
            //  **********  ***********  funcionalidades para perfil 0   **********  **********
             if (isset($_SESSION["autenticado"]) and 
                       ($_SESSION["perfil"]==0) ){ ?>
                       
                       <li <?php if ($page=="administrar") echo " class='active'"; ?>>
                              <a href="administrar.php">Administrar</a></li>
            <?php   } 
}?>


<?php function inicioSesion($page) {
	// formulario de inicio de sesión o identificación del usuario
	
			if (isset($_SESSION["autenticado"]) and ($_SESSION["autenticado"]=="si")) { ?>
                    <li class="especial"><p>| <?php echo $_SESSION["nombre"]; ?> </p></li>
                    <li class="especial"><a href="scripts/sesionCerrar.php" >Cerrar sesión</a></li>

			 <?php 
			 } elseif ($page == "index_admin")  {
			// formulario de inicio de sesión	 
			?> 
              <form  name="form" id="form" method="post"  class="navbar-form pull-right" 
              				action="scripts/autenticacion.php" onSubmit="true;">
                    <input type="text" class="span1" placeholder="usuario" id="usuario" name="usuario">
                    <input type="password" class="span1 " placeholder="clave" id="clave" name="clave">
                    <button class="btn" type="submit"><i class="icon-arrow-right"></i></button>
              </form> 
              <?php } ?>
			  
<?php }?>

<?php function textoCabecera1() {
	// cabecera de la página del index antes de autenticarse el usuario
	?>	
          <div class="navbar-inner">
                <div class="container" >           
                      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                      </a>          
                      <a class="brand" href="index.php">Ficoflora Parque Nacional Archipiélago Los Roques</a>
                </div>
          </div>
<?php }

function textoCabecera2($page) {
	// cabecera de la página y llamada a la barra de navegación superior indicando la página actual

	if ($page == "index_admin")  {
		$margenIzq="150px";
		if ( isset($_SESSION["autenticado"]) )
		if ( $_SESSION["perfil"]==0 )   { 
				$margenIzq="0px"; }  /* 5px */
 		elseif ( $_SESSION["perfil"]==1 )   { 
				$margenIzq="2px"; }  /* 95px */
 		elseif ( $_SESSION["perfil"]==2 or $_SESSION["perfil"]==3)  { 
				$margenIzq="120px"; }  /* 145px */
	}
	?>
    <div class="navbar-inner"> <!--  boostrapcollapsing responsive navbar  -->
    <div class="container">
         
        <!-- Be sure to leave the brand out there if you want it shown -->
        <a class="brand" href="index.php">Ficoflora P. N. Archipiélago Los Roques</a>
     
        <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </a>
                 
        <!-- Everything you want hidden at 940px or less, place within here -->
        <!-- elementos de la barra -->
        <div class="nav-collapse"> 
            <ul class="nav">
                <?php 
				barraNavegacion_opcionesComunes($page);  
				barraNavegacion_opcionesPorPerfil($page);
				inicioSesion($page); 
				?>
            </ul> 
            
        </div>
    </div>
    </div>         
<?php }


function textoPie1() {?>	
    <p style="text-align:left; margin-top: -8px">
    	
        Derechos reservados &copy; 2012 - 2019 &#8226;
        
        <!--   2012 - 2014 &#8226;   -->
        
        <a href="http://www.ucv.ve/" target="_blank" 
        		 alt="Universidad Central de Venezuela" title="Universidad Central de Venezuela" class="sinColor">
        UCV</a> ::
        <a href="http://www.ucv.ve/organizacion/fundaciones-asociaciones-y-centros/fundacion-instituto-botanico-de-venezuela.html" 
        alt="Fundaci&oacute;n Instituto Bot&aacute;nico de Venezuela Dr. Tob&iacute;as Lasser" 
        title="Fundaci&oacute;n Instituto Bot&aacute;nico de Venezuela Dr. Tob&iacute;as Lasser" 
        target="_blank" class="sinColor">FIBV</a> ::
        <a href="http://www.ipmjmsm.upel.edu.ve/" target="_blank" 
        	alt="Instituto Pedag&oacute;gico de Miranda Jos&eacute; Manuel Siso Mart&iacute;nez" 
            title="Instituto Pedag&oacute;gico de Miranda Jos&eacute; Manuel Siso Mart&iacute;nez" class="sinColor">UPEL</a></p>
            <!--   -->
        <p style="text-align:left">
        Producción de contenidos Santiago G&oacute;mez,  
        <a href="mailto:yusneyi.carballo@ciens.ucv.ve" target="_blank" class="sinColor">Yusneyi Carballo Barrera</a> y Mayra Garc&iacute;a<br />
        Desarrollado por <a href="mailto:yusneyi.carballo@ciens.ucv.ve" target="_blank" class="sinColor">Yusneyi Carballo Barrera</a>
    </p> 
      
<?php }?>

<?php function textoPie1_Creditos() {?>	
    <p style="text-align:left; margin-top: -8px">Derechos reservados &copy; 2012 - 2019 &#8226;
        <a href="http://www.ucv.ve/" target="_blank" 
        		 alt="Universidad Central de Venezuela" title="Universidad Central de Venezuela" class="sinColor">
        UCV</a> ::
        <a href="http://www.ucv.ve/organizacion/fundaciones-asociaciones-y-centros/fundacion-instituto-botanico-de-venezuela.html" 
        alt="Fundaci&oacute;n Instituto Bot&aacute;nico de Venezuela Dr. Tob&iacute;as Lasser" 
        title="Fundaci&oacute;n Instituto Bot&aacute;nico de Venezuela Dr. Tob&iacute;as Lasser" 
        target="_blank" class="sinColor">FIBV</a> ::
        <a href="http://www.ipmjmsm.upel.edu.ve/" target="_blank" 
        	alt="Instituto Pedag&oacute;gico de Miranda Jos&eacute; Manuel Siso Mart&iacute;nez" 
            title="Instituto Pedag&oacute;gico de Miranda Jos&eacute; Manuel Siso Mart&iacute;nez" class="sinColor">UPEL</a></p>
<?php }?>


<?php function textoPie2() {?>	 
        <p style="text-align:right; font-weight:bold;">Proyecto FONACIT LOCTI-PEI N° 2011001216, desarrollado con el apoyo y financiamiento del Fondo Nacional de Ciencia, Tecnología e Innovación de Venezuela y de la Facultad de Ciencias de la UCV.
        </p>
<?php }?>

 <?php function textoPieEnlaces() {?>
                    <p style="text-align:right; margin-top: -6px">
                        <a href="index.php" title="Ir a la página Principal">Inicio</a> | 
                        <a href="consultar.php" title="Ir a la página de Consultas">Consultar</a> |	
                        <a href="creditos.php" title="Créditos del proyecto">Cr&eacute;ditos</a> |
                      </p>
<?php }?>


<?php function textoPieEstadisticas() {?>

    <!-- Begin ShinyStat code -->
    <script type="text/javascript" src="http://codice.shinystat.com/cgi-bin/getcod.cgi?USER=FicofloraWeb"></script>
            <noscript>
                <h6><a href="http://www.shinystat.com/es/">
                        <img src="http://www.shinystat.com/cgi-bin/shinystat.cgi?USER=FicofloraWeb" alt="Auditor web" style="border:0px" /></a></h6>
            </noscript>
    <!-- End ShinyStat code -->


    <!-- Contador de visitas websmultimedia
            &nbsp;&nbsp;
            <a href="http://www.websmultimedia.com/contador-de-visitas-gratis" 
            	title="Contador De Visitas Gratis">
            <img style="border: 0px solid; display: inline; font-size:12px" alt="contador de visitas" 
            	src="http://www.websmultimedia.com/contador-de-visitas.php?id=181131"></a>
                
        <!-- Fin Contador de visitas    ant id=180934 -->

<?php }?>


<?php function textoPieComoCitar() {?>



<?php }?>

<?php function textoPie() {?>
 
          <div class="row">
                  <div class="span6 pull-left">
                        <?php 
						textoPie1();  // en scripts > cabeceraypie.php
                        ?>
                </div>
                 
                 <div class="span6 pull-right">
                     <?php  if ( isset($_SESSION["entrada"]) or @($_SESSION["entrada"]=="si") ) {  ?>
                              <?php textoPieEnlaces();  ?>
                    <?php } ?>
                    <?php textoPie2();  // en scripts > cabeceraypie.php ?>
                </div>

                  <div class="span12" style="text-align: center">
                  <?php
                  textoPieEstadisticas();
                  ?>
                </div>

              <div class="span12" style="text-align: center">
                  <?php
                  textoPieComoCitar();
                  ?>
              </div>
          </div>
          
<?php }?>

<?php function textoPieCreditos() {?>
 
              <div class="row">
                  <div class="span8 pull-left">
                        <?php 
						textoPie1_Creditos();  // en scripts > cabeceraypie.php
						?>
                 </div>
               
                <div class="span4 pull-right">
                      <?php textoPieEnlaces();  ?>
                </div>

              <div class="span12" style="text-align: center">
                  <?php
                  textoPieEstadisticas();
                  ?>
              </div>
<?php }?>