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
<link rel="icon" type="image/png" href="favicon.ico" />

	<title>Proyecto Ficoflora Venezuela :: PNALR</title>
    
<!-- ******************  llamadas a scripts  ***************************** -->
    <!-- includes PHP -->
   <?php   
	include ("scripts/conexion.php");			include ("scripts/cabecera&Pie.php");
	include ("scripts/tools.php"); 	 			include ("scripts/correlaciones.php");	
	include ("scripts/colecciones.php");	
	
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
	
    <div class="navbar navbar-fixed-top"><?php textoCabecera2("respaldar");  // en scripts > cabeceraypie.php ?>
     </div>
    
    <div class="container">
        <!-- content -->
	<div id="content-outer" class="clear"><div id="content-wrap">
	
		<div id="content">        
        	<div id="complete">          
	        <h3>Correlacionar &not;</h3>	        
            
            <?php 
			// recuperando parámetros
			$op = $_REQUEST["op"];   $tb = $_REQUEST["tb"];
			
			if ( ($tb=='e')  or ($tb=='g') or ($tb=='f') or ($tb=='c') or ($tb=='o')) 
				correlacionar($op,$tb);  // acciones en correlaciones.php
			else
				if ($tb=='co')
					correlacionarEspeciesColeccion();
				else
				if ($tb=='d')
					correlacionarLocalidadesEspeciesMapa($op);
				else
					if ($tb=='aa')
							adaptarAutores($op);
						else 
							if ($tb=='a')
								correlacionarAutores($op);
							else 
								echo "<span class='bandera'>Caso no considerado. Procedimiento no realizado.</span>"; 								
			?>            
            
            <span class="postlink">
                <a href="correlacionar.php" target="_parent" alt="regresar Correlaciones" title="regresar Correlaciones"><img src="images/ico_flechaizq.gif" alt="regresar ficha" title="regresar Correlaciones"/> regresar</a>
             </span>
        	</div> <!-- / fin galeria de opciones --> 
           
         </div>   <!-- /row sección de contenido  --> 
       
          <footer><hr />
          <?php textoPie();  // en scripts > cabeceraypie.php    css: bootstrap_customYCB  ?>
          </footer><!-- /hero-footer -->       
      </div> <!-- /container -->  
	
<!-- wrap ends here -->
</div>
       
</body>
</html> 
<?php  cerrarConexion(); /* se cierra la conexion  */ ?>