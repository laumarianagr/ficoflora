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
	include ("scripts/conexion.php");			include ("scripts/cabecera&Pie.php");	
	include ("scripts/tools.php");
	include ("scripts/generos.php");			include ("scripts/especies.php");
	include ("scripts/localidades.php");		include ("scripts/galerias.php");
	include ("scripts/taxonomia.php");		    include ("scripts/citas.php");
	include ("scripts/mapa.php");				include ("scripts/listados.php");
	
abrirConexion();
?>
    
    <!-- jQuery -->
    <script src="js/jquery-1.10.2.js"></script>
	<script src="bootstrap_v2.0.2/js/bootstrap.js"></script>
	<script src="js/jquery-ui-1.9.2.custom.min.js"></script>   
	<script src="js/jquery-select.js"></script>    
    
    <!-- Add fancyBox -->
    <link rel="stylesheet" href="js/galleria_fancyBox_v2.1.5/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <script type="text/javascript" src="js/galleria_fancyBox_v2.1.5/source/jquery.fancybox.pack.js?v=2.1.5"></script>
    
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

<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox();
	});
	
	$(".fancybox").fancybox({
    helpers : {
        title: {
            type: 'float'
        }
    }
});
</script>
    
<!-- ******************  fin llamadas a scripts  ***************************** -->

</head>
<body>
	
    <div class="navbar navbar-fixed-top"><?php textoCabecera2("consultar");  // en scripts > cabeceraypie.php ?>
     </div> 
       
           <div class="container">
             
			<?php 
            if ( !isset($_REQUEST["id"]) and 
			     !isset($_REQUEST["localidad"]) and 
				 !isset($_REQUEST["qsearch1"]) and !isset($_REQUEST["qsearch2"])  
																	   and !isset($_REQUEST["qsearch3"]) 
																	   and !isset($_REQUEST["qsearch4"]) 
																	   and !isset($_REQUEST["qsearch5"]) )
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
               
      <div class="page-header"> <!-- ******** encabezado de página ******** -->
       	  <h1>Consultar</h1>
            <p class="smaller">A continuaci&oacute;n puede realizar sus b&uacute;squedas por g&eacute;nero, especie o localidad<br />
            <span class="smaller-en">{ You can then make their search by genus, species or location</span>
            </p>
        </div> 
      
      <div class="row"> <!-- / *************    sección de contenido, consultas  **************** -->
      
                <div class="span4"> <!-- / consulta por género -->
                    <div class="media">
                        <img class="media-object media-ima thumbnail pull-left" src="images/opcion5.png">
                        <div class="media-body">
                            <h2 class="media-heading">Género</h2>
                                <form class="form pull-left">
                                    <input name="qsearch1"  id="qsearch1" type="text"> 
                                    	<!-- placeholder="p.e. Ulva o Caulerpa  +Enter" -->
                                     <br />Indique el g&eacute;nero y pulse Enter
                                            
                                    <input name="op" id="op" type="hidden" value="genero"/>                                
                                </form>
                        </div>
                    </div>
                </div>
                
                <div class="span4"> <!-- / consulta por especie -->
                    <div class="media">
                        <img class="media-object media-ima thumbnail pull-left" src="images/opcion1.png">
                        <div class="media-body">
                            <h2 class="media-heading">Especie</h2>
                                <form class="form pull-left">
                                    <input name="qsearch2"  id="qsearch2" type="text">
                                    	<!-- placeholder="p.e. Caulerpa peltata  +Enter" -->
                                     <br />Indique la especie y pulse Enter
                                            
                                     <input name="op" id="op" type="hidden" value="especie"/>
                                </form>
                        </div>
                    </div>
                </div>
                
                <div class="span4"> <!-- / consulta por localidad -->
                    <div class="media">
                        <img class="media-object media-ima thumbnail pull-left" src="images/opcionlocalidad.png">
                        <div class="media-body">
                            <h2 class="media-heading">Localidad</h2>
                                <form class="form pull-left">
                                    <input name="qsearch3"  id="qsearch3" type="text">
                                    	<!-- placeholder="p.e. Gran Roque  +Enter" -->
                                     <br />Indique la localidad y pulse Enter
                                   
                                   <input name="op" id="op" type="hidden" value="localidad"/>
                                </form>
                        </div>
                    </div>
                </div>                
                </div>   <!-- /row sección de contenido  -->   

              <div class="row"> <!-- / *************    fila intermedia de separación **************** --> 
                <div class="span12"> &nbsp;  </div>              
               </div>                       
                
                <div class="row"> <!-- / *************    sección de contenido, listados  **************** -->  
               
                
               <?php 			  
			  //  **********  ***********  funcionalidades para todos los perfiles  **********  **********
				?>           
                <div class="span4"> <!-- / listados por género, especie o localidad    -->                    
                    <div class="media">
                        <img class="media-object media-ima thumbnail pull-left" src="images/opcionbdd.png">
                        <div class="media-body">
                    <h2 class="media-heading">Listados</h2>
                                <form class="form pull-left" id="formListados">
                                   <input type="radio" name="qsearch5" id="qsearch5" value="1" onClick="submit();"> 
                                   por G&eacute;nero &nbsp;
                                            
                                   <input type="radio" name="qsearch5" id="qsearch5" value="2"   onClick="submit();"> 
                                   por Especie &nbsp;
                                            
                                   <input type="radio" name="qsearch5" id="qsearch5" value="3"  onClick="submit();"> 
                                   por Localidad
                                         
                                   <input name="op" id="op" type="hidden" value="listados"/>
                                </form>
                        </div>                        
                    </div>
                </div>
                
                           
                <div class="span8"> <!-- / listados de nuevos registros -->                    
                    <div class="media">
                        <img class="media-object media-ima thumbnail pull-left" src="images/opcion3.png">
                        <div class="media-body">
                            <h2 class="media-heading">Nuevos Registros</h2>
                                <form class="form pull-left" id="formNR">

                                  <input type="radio" name="qsearch4" id="qsearch4" value="2" onClick="submit();"> 
                                   			PNALR &nbsp;
                                            
                                   <input type="radio" name="qsearch4" id="qsearch4" value="1" onClick="submit();"> 
                                   			Venezuela &nbsp;

                                    <!--
                                    Se activará cuando haya un reporte de un nuevo registro para el Mar Caribe

                                   <input type="radio" name="qsearch4" id="qsearch4" value="3" onClick="submit();"> 
                                   			Mar Caribe

                                    -->
                                         
                                   <input name="op" id="op" type="hidden" value="registrosnuevos"/>
                                </form>
                        </div>                        
                    </div>
                </div>                                                           
         </div>   <!-- /row sección de contenido  -->            

            <?php
            } else { // enviada la consulta	 ?>	
			      <div class="row"> <!-- / *************    sección de contenido  **************** -->
            <?php
                        // recuperando valores enviado
						
						$op = $_REQUEST["op"];
						$localidad = "";  
						
						if ( isset($_REQUEST["localidad"]) )   {
							$criterio = $_REQUEST["localidad"];  // recuperamos localidad para listado de especies x localidad
						}
						
						if ( isset($_REQUEST["id"]) )   {
							$criterio = $_REQUEST["id"];  // id de la especie/género/ localidad a mostrar	
						}
						else {
							if ( isset($_REQUEST["qsearch1"]))  $criterio = $_REQUEST["qsearch1"];
							if ( isset($_REQUEST["qsearch2"]))  $criterio = $_REQUEST["qsearch2"];
							if ( isset($_REQUEST["qsearch3"]))  $criterio = $_REQUEST["qsearch3"];	
							if ( isset($_REQUEST["qsearch4"]))  $criterio = $_REQUEST["qsearch4"];		
							if ( isset($_REQUEST["qsearch5"]))  $criterio = $_REQUEST["qsearch5"];													
						}
                        
                        // determino para que se usará esta consulta
                        
						switch ($op)
                        {
                            case "codGenero": // se conoce el código del género
                                    generoMostrarEspecies($criterio, 0);
                            break;
							
							 case "genero":// se conoce el nombre del género
									generoMostrarEspecies($criterio, 1);  
                            break;
                            
                            case "codEspecie": // se conoce el código de la especie
                                    especieMostrar($criterio, 0, $localidad);
                            break;
                            
                            case "especie": // se conoce en nombre de la especie
                                    especieMostrar($criterio, 1, $localidad);
                            break;				
                            
                            case "localidad":
									localidadMostrarEspecies($criterio);
                            break;											
                            
                            case "registrosnuevos":                                    
									$op = 2;
									especieMostrar($criterio, $op, $localidad); 
									// criterio: 1: Reg Venezuela, 2: Reg PNALR, 3: Mar Caribe
                            break;

                            case "listados": 
									listarDatos($criterio); 
									// criterio: 1: por Género, 2: por Especie, 3: por Localidad
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
						?>	
			      </div> <!-- / *************    sección de contenido  **************** -->
            <?php		
            } // fin verificación de consulta
            ?>
            
            
          <footer><hr />          
          <?php textoPie();  // en scripts > cabeceraypie.php    css: bootstrap_customYCB  ?>
          </footer><!-- /hero-footer -->       
      </div> <!-- /container -->     
       
</body>
</html> 
<?php  cerrarConexion(); /* se cierra la conexion  */ ?>