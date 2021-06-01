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
	include ("scripts/tools.php"); 				
	include ("scripts/generos.php");			include ("scripts/especies.php");
	include ("scripts/localidades.php");		include ("scripts/taxonomia.php");
	include ("scripts/citas.php");				include ("scripts/mapa.php");
	
abrirConexion();
?>
    
    <!-- jQuery -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="bootstrap_v2.0.2/js/bootstrap.js"></script>
    
    <!-- Add fancyBox -->
    <link rel="stylesheet" href="js/galleria_fancyBox_v2.1.5/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <script type="text/javascript" src="js/galleria_fancyBox_v2.1.5/source/jquery.fancybox.pack.js?v=2.1.5"></script>    
    
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

<script type="text/javascript">
  $(function () {
    $('.dropdown-toggle').dropdown();
  })
	
$(".fancybox").fancybox({
    helpers : {
        title: {
            type: 'float'
        }
    }
	 //,  'modal' : false, 	 'maxWidth': '40%', 	 'width': '50%', 	 'topRatio': 0, 	 'leftRatio': 0.9, 	 'overlayOpacity': 0.50
})
</script>
</head>

<body>
	
    <div class="navbar navbar-fixed-top"><?php textoCabecera2("consultar");  // en scripts > cabeceraypie.php ?>
     </div>
    
    <div class="container">  
        
      <div class="row"> <!-- / *************    sección de contenido  **************** -->
      <div class="span12" id="ficha"> <!-- / consulta el mapa por  género o especie   -->
			<?php 
                    $id = $_REQUEST["id"];  // id de la especie/género a mostrar
                    $opcion = $_REQUEST["op"];  // opción mapa, e: distribución por especie, l: por localidad, g: por género
                                                    
                    $res= especieConsultar($id, 0);
                    $actual = getFila($res);
                    
                    if       ($opcion == 'e')  { $tabla="especies_distribucion";  $caso= " la especie ";  $caso2= " esta especie "; }
                    elseif ($opcion == 'l') { $tabla="localidades_distribucion"; $caso= " la localidad ";  $caso2= " esta localidad "; } 
                    elseif ($opcion == 'g') { $tabla="generos_distribucion"; $caso= " el género ";  $caso2= " este género "; }
                    
                    $total = consultarHayDistribucion($id, $tabla, $opcion);   // en mapa.php
                    
                    $estilo = " style='margin: 10px 0px 0px 30px; font-size: 110%; color:#000;' ";
                    if ( $total == 0 ) { 
                            echo "<span $estilo>No se ha registrado la distribución geográfica para $caso2.</strong></span>";								
                    }
                    else {	
                            if  ($opcion == 'e')  { 
								  fichaResumenEspecie($actual, $especie,1);   
									  // 1 indica que el autor debe aparece junto a especie
									$mapaPDF = "";
									mostrarMapaEspecies($id, $tabla); 
								  }
                            elseif ($opcion == 'l')   { 
									mostrarMapaLocalidades($id, $tabla); }
                            elseif ($opcion == 'g')  { 
									echo "<br /> Mapa de distribución por género, por diseñar. ";}	
                    }				
                ?>
         	</div>        
        
        <div class="span12 alert alert-info">  <!--  alert-info crea una caja de información-->
            <a href="consultar.php?op=codEspecie&id=<?php echo $id; ?>" target="_parent" 
            	alt="regresar a la especie" title="regresar a la especie">
                        <img src="images/ico_nivelanterior.gif" alt="regresar a la especie" 
                        	title="regresar a la especie" class="ico"/>regresar a la especie</a>  
                                       
            &nbsp;&nbsp;&nbsp;
            <a href="consultar.php?q=0;" target="_parent" alt="nueva consulta" title="nueva consulta">
            	 <img src="images/ico_buscar.gif" alt="nueva consulta" title="nueva consulta" class="ico"/>
                 	nueva consulta </a>                                       
        
        	</div>
       </div>
         
          <footer><hr />
          <?php textoPie();  // en scripts > cabeceraypie.php    css: bootstrap_customYCB  ?>
          </footer><!-- /hero-footer -->       
      </div> <!-- /container -->     
       
</body>
</html> 
<?php  cerrarConexion(); /* se cierra la conexion  */ ?>