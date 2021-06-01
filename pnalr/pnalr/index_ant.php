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
    include ("scripts/cabecera&Pie.php");
	
	?>
    
    <!-- jQuery -->
    <script src="js/jquery-1.10.2.js"></script>
    
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

<body onLoad="document.form.usuario.focus();">

	<div class="navbar navbar-fixed-top"><?php textoCabecera1();  // en scripts > cabeceraypie.php ?>
    </div>
    
    <div class="container">
    
        <div class="row borde" id="hero">
             <div class="span2">&nbsp;</div>
            <div class="span3 recuadro" id="hero-imagen">
            	<img src="images/algas2.png" title="Parque Nacional Archipi&eacute;lago Los Roques" />
            </div>
        
            <div class="span5" id="hero-texto">
                    <h2>Bienvenido</h2>                  

                    <form name="form" id="form" method="post" action="index2.php">
                      <label for="usuario">usuario
                      <input type="text" name="usuario" id="usuario"></label>
                      <label for="clave">clave
                      <input type="password" name="clave" id="clave"></label>
                      
                      <label for="code">
                      <img src="../captcha-code/captcha.php" border="0" /> <br />
                       indique el c&oacute;digo observado
                      <input type="text" name="code" width="25"/></label>
                      
                      <input type="submit" class="btn" name="enviar" id="enviar" value="Enviar"> 
                    </form>
           </div>    
           <div class="span2">&nbsp;</div>  
        </div>
       
          <footer><hr />
          <?php textoPie();  // en scripts > cabeceraypie.php    css: bootstrap_customYCB  ?>
          </footer><!-- /hero-footer -->            
          </div>       
</body>
</html> 