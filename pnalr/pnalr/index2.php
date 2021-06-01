<?php
session_start( ); // allows us to retrieve our key form the session

include ("scripts/conexion.php");	 abrirConexion(); ?>
<?php
if (!isset($_POST["usuario"])) {?>

	<form name="form" id="form" method="post" action="index2.php">
        <label for="usuario">usuario</label>
        <input type="text" name="usuario" id="usuario">
        <label for="clave">clave</label>
        <input type="password" name="clave" id="clave">
        <p><input type="submit" class="btn" name="enviar" id="enviar" value="Enviar"> </p>
      
  </form>
<?php 
} else {
				
		// verificación de la captcha
		$valCaptcha = (md5( $_POST[ 'code' ] ) == $_SESSION[ 'key' ]);
		
		// consulta del usuario
		  $usuario=$_POST["usuario"];  $clave=$_POST["clave"];
		  $query = "SELECT nombres, clave, perfil FROM usuarios WHERE nombres='".$usuario."' and clave='".$clave."'";
		  $res = ejecutarQuerySQL($query);
		  $total = getNumFilas($res);
		 
		 // validación de la captcha y del usuario
		 $mensaje = "";
		 if( !$valCaptcha ) {  
			 $mensaje = 	"<h1>Error en la validación</h1>
									  <p>El código de validación suministrado es incorrecto.</p>";
		 
		 } elseif ($total == 1) { // captcha y usuario correctos 
			  $actual = getFila($res);
			  $_SESSION["entrada"]="si"; $_SESSION["perfil"]=$actual["perfil"];
			  header('Location: indexp.php');			  
		  } else { ///acceso fallo, se solicita nuevamente la identificacion del usuario
			  $mensaje = 	"<h1>Error en la validación</h1>
									  <p>Usuario no registrado. <br />Usted no tiene permiso de acceso a esta aplicaci&oacute;n</p>";
		  }
		  if ($mensaje<>"") {			  
			  $_SESSION["entrada"]="no";
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
					  <!-- includes HP -->
					 <?php 
					  include ("scripts/cabecera&Pie.php");
					  ?>
					  
					  <!-- jQuery -->
					  <script src="js/jquery-1.9.1.js" type="text/javascript"></script>
					  
					  <!-- Bootstrap -->    
					  <link href="bootstrap_v2.0.2/css/bootstrap.css" rel="stylesheet">
					  <link href="bootstrap_v2.0.2/css/bootstrap-responsive.min.css" rel="stylesheet">
					  <link href="css/bootstrap_customYCB.css" rel="stylesheet">                               
					  <!-- Soporte navegadores -->
					  <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
					  <!--[if lt IE 9]>
						<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
					  <![endif]-->
					  
					  <!-- ******************  fin llamadas a scripts  ***************************** -->
				  
				  </head>
				  
				  <body>
				  
					  <div class="navbar navbar-fixed-top">
							  <?php textoCabecera1();  // en scripts > cabeceraypie.php ?>
					  </div>
					  
						  <div class="row" id="hero"> <!-- / visión del proyecto  -->
							   <div class="span2">&nbsp;</div>
							  <div class="span3" id="hero-imagen"><img src="images/algas2.png" title="Turbinaria y Sargassum, Gran Roque" />
							  </div>
						  
							  <div class="span5" id="hero-texto">
									  <br />
									  <?php echo $mensaje; // creado en la validación del usuario ?>
									  <p><a class="btn" href="index_ant.php">Intertar nuevamente</a><br />
							 </div>    
							 <div class="span2">&nbsp;</div>
							 </div> 

                <footer><hr />
                <?php textoPie();  // en scripts > cabeceraypie.php    css: bootstrap_customYCB  ?>
                </footer><!-- /hero-footer -->    
                
                </body>                
                </html> 
                <?php 
          } // fin del if de validación del captcha
}
cerrarConexion();
?>