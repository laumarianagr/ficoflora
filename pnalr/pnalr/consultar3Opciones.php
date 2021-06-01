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
    <meta name="description" content="Sistema de administración de datos del proyecto Ficoflora P.N. Archipiélago de Los Roques, Venezuela." />
<meta name="keywords" content="ficoflora, macroalgas, algas bénticas, algas marinas, botánica, Los Roques, taxonomía, sistemática de algas, phycoflora, macroalgae, benthic algae, seaweed, botany, taxonomy, systematics of algae, UCV, UPEL." />
<link rel="icon" type="image/png" href="favicon.ico" />

	<title>Proyecto Ficoflora Venezuela :: PNALR</title>
    
<!-- ******************  llamadas a scripts  ***************************** -->
    <!-- includes PHP -->
   <?php   
	 include ("scripts/conexion.php");	include ("scripts/cabecera&Pie.php");	 
	include ("scripts/tools.php"); 				include ("scripts/generos.php");	
	include ("scripts/especies.php");			include ("scripts/localidades.php");	
	include ("scripts/taxonomia.php");		include ("scripts/mapa.php");		
	
abrirConexion();
?>
    
    <!-- jQuery -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="bootstrap_v2.0.2/js/bootstrap.js"></script>
	<script src="js/jquery-ui-1.9.2.custom.min.js"></script>   
	<script src="js/jquery-select.js"></script>
    
    <!-- Bootstrap -->
    <link href="bootstrap_v2.0.2/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap_v2.0.2/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/bootstrap_customYCB.css" rel="stylesheet"> 
    <link href="css/jquery-ui-1.9.2.custom.min.css" rel="stylesheet">
    
    
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
	
    <div class="navbar navbar-fixed-top"><?php textoCabecera2("consultar");  // en scripts > cabeceraypie.php ?>
     </div>
    
    <div class="container">
            
			<?php 
            if ( !isset($_REQUEST["qsearch1"]) and !isset($_REQUEST["qsearch2"])  
																	   and !isset($_REQUEST["qsearch3"])  )
            { // entrando a la página, despliegue de formularios
			
				// se crean los arreglos para las listas de autocompletar
				$arregloG = arregloAutocompletar("genero");  // en taxonomia
				$arregloE = arregloAutocompletar("especie"); 
				$arregloL = arregloAutocompletar("localidad");
			?> 
            
            <script type="text/javascript">
			$(function(){
					  
				// lista de géneros
				var autocompletarG = new Array();
					<?php 
					 for($p = 0;$p < count($arregloG); $p++) { ?>
					   autocompletarG.push('<?php echo $arregloG[$p]; ?>');
					 <?php } ?>
					 
					$("#qsearch1").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
				   source: autocompletarG //Le decimos que nuestra fuente es el arreglo
				 });

				// lista de especies	
				var autocompletarE = new Array();
					<?php
					 for($p = 0;$p < count($arregloE); $p++){?>
					   autocompletarE.push('<?php echo $arregloE[$p]; ?>');
					 <?php } ?>
					 
					$("#qsearch2").autocomplete({ 
				   source: autocompletarE
				 });
				 
				 // lista de localidades	
				var autocompletarL = new Array();
					<?php
					 for($p = 0;$p < count($arregloL); $p++){?>
					   autocompletarL.push('<?php echo $arregloL[$p]; ?>');
					 <?php } ?>
					 
					$("#qsearch3").autocomplete({ 
				   source: autocompletarL
				 });
			  });  // fin listas autocompletar
			</script>
            
            <style type="text/css">
			<!-- 
			.boton { color: #036; font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size: 14px; }		
			-->
			</style>
            
                
      <div class="page-header"> <!-- ******** encabezado de página ******** -->
       	  <h1>Consultar</h1>
            <p class="smaller">A continuación puede realizar sus búsquedas por género, especie o localidad<br />
            <span class="smaller-en">{ you can then make their search by gender, species or location</span></p>
      </div>
      
      <div class="row"> <!-- / *************    sección de contenido  **************** -->
      
                <div class="span4"> <!-- / consulta por género -->
                    <div class="media">
                        <img class="media-object media-ima thumbnail pull-left" src="images/opcion5.png">
                        <div class="media-body">
                            <h2 class="media-heading">Género</h2>
                                <form class="form pull-left">
                                    <input name="qsearch1"  id="qsearch1" type="text" 
                                    		class="" placeholder="p.e. Ulva o Caulerpa  +Enter">
                                            
                                    <input name="op" id="op" type="hidden" value="genero"/>                                
                                </form>
                        </div>
                    </div>
                </div>
                
                <div class="span4"> <!-- / consulta por género -->
                    <div class="media">
                        <img class="media-object media-ima thumbnail pull-left" src="images/opcion1.png">
                        <div class="media-body">
                            <h2 class="media-heading">Especie</h2>
                                <form class="form pull-left">
                                    <input name="qsearch2"  id="qsearch2" type="text" 
                                    		class="" placeholder="p.e. Caulerpa peltata  +Enter">
                                            
                                     <input name="op" id="op" type="hidden" value="especie"/>
                                </form>
                        </div>
                    </div>
                </div>
                
                <div class="span4"> <!-- / consulta por género -->
                    <div class="media">
                        <img class="media-object media-ima thumbnail pull-left" src="images/opcionlocalidad.png">
                        <div class="media-body">
                            <h2 class="media-heading">Localidad</h2>
                                <form class="form pull-left">
                                    <input name="qsearch3"  id="qsearch3" type="text" 
                                    		class=""  placeholder="p.e. Gran Roque  +Enter">
                                   
                                   <input name="op" id="op" type="hidden" value="localidad"/>
                                </form>
                        </div>
                    </div>
                </div>
                
         </div>   <!-- /row sección de contenido  -->   

            <?php
            } else
            { // enviada la consulta
			
                        // recuperando valores enviados			
                        $op = $_REQUEST["op"];
                        
						if ( isset($_REQUEST["qsearch1"]))  $criterio = $_REQUEST["qsearch1"];
						if ( isset($_REQUEST["qsearch2"]))  $criterio = $_REQUEST["qsearch2"];
						if ( isset($_REQUEST["qsearch3"]))  $criterio = $_REQUEST["qsearch3"];							
                        
                        // determino para que se usara esta consulta por rif
                        switch ($op)
                        {
                            case "genero":
                                    generoMostrarEspecies($criterio);  // echo "<br /> consultar con genero $criterio <br /> ";
                            break;
                            
                            case "cod": // se conoce el código de la especie
                                    especieMostrar($criterio, 0);
                            break;
                            
                            case "especie": // se conoce en nombre de la especie
                                    especieMostrar($criterio, 1);
                            break;				
                            
                            case "localidad":
                                    localidadMostrarEspecies($criterio);
                            break;
                            
                            case "palabras":
                                echo " <br />Consulta por palabra clave, funcionalidad en desarrollo.";
                            break;
                            
                            case "quitsearch":
                                echo " <br />Consulta por caja de búsqueda rápida, funcionalidad en desarrollo.";
                            break;
                    
                            default:
                            echo "Opcion no contemplada"; 
                            break;
                        }
            } // fin verificación de consulta
            ?>
                
          <hr>  <!-- / hr división con el pie de página   --> 
          <footer><?php textoPie();  // en scripts > cabeceraypie.php ?></footer><!-- /hero-footer -->      
      </div> <!-- /container -->
</body>
</html> 
<?php  cerrarConexion(); /* se cierra la conexion  */ ?>