<?php 
/* procedimientos que despliegan las distintas galerías y tablas de imágenes con fotos de especies  */

function galeriaEspeciesGenero() { 
// utilizada en la parte superior derecha del listado de especies por género

		//$fotos;
		//consultarFotos($i-1, $fotos);
?>
      <ul class="thumbnails">
          <li class="span2">                
              <div class="thumbnail">
                      <img src="images/opcion1.png" alt="">               
              </div>         
          </li>               
          
          <li class="span2">
            <div class="thumbnail">
                    <img src="images/opcion5.png" alt="">
            </div>
          </li>
      </ul>
<?php
}

function galeriaEspeciesImagenPrincipal($idEspecie) { 
// imagen principal de la especie utilizada en la parte sup. izq. de la ficha de especie
?>

      <div class="image-block">
           <?php
           
           $resIma = especieConsultarImagenPrincipal($idEspecie); // al inicio de especies
		   $nombre = especieConsultarNombre($idEspecie);
		   
           $totalIma = getNumFilas($resIma);
           if ($totalIma == 1) {  
                      $actualIma = getFila($resIma);					 
					  $carpeta = "images_especies/";					  
					  $imagen = $carpeta . ucfirst($actualIma['imagenes_id']) . ".jpg";                      
                      $imagen_zoom = $carpeta . ucfirst($actualIma['imagenes_id']) . "_z.jpg";
					  
                      // se verifica si existe imagen general para esta especie
                      if (!file_exists($imagen)) { 
                          $imagen = $carpeta . "imagenGeneral.jpg";
                      }
					  
					  // se verifica si existe imagen zoom para esta especie
                      if (!file_exists($imagen_zoom)) { 
                          $imagen_zoom = $carpeta . "imagenGeneral_z.jpg";
						  $nombre="";
                      }
					 
					  $leyenda = $actualIma['leyenda'];						  
                      ?>                      
                      <a class="fancybox" rel="group1" href="<?php echo $imagen_zoom; ?>" 
                      			title="<?php echo $nombre . ".&nbsp; " . $leyenda; ?>">
                          <img src="<?php echo $imagen; ?>"  alt="imagen Especie" title="clic para hacer zoom" />
                     </a>
         <?php
           }
         else  {  ?>                       
                      <a class="fancybox" rel="group1" href="images_especies/imagenGeneral_z.jpg"  
                      			title="foto provisional">
                          <img src="images_especies/imagenGeneral.jpg"   alt="imagen Especie" 
                          	title="clic para hacer zoom" />
                     </a>                           
        <?php 
        }
        ?>
      </div>
       <br /><br /> 

 <?php 
 }

function galeriaEspeciesImagenesInferiores($idEspecie) { 
// imagenes que se despliegan en la parte inferior de la ficha de la especie

		 $resIma = especieConsultarImagenesSecundarias($idEspecie); // al inicio de especies
		 $nombre = especieConsultarNombre($idEspecie);
		 $totalIma = getNumFilas($resIma);
		 $carpeta = "images_especies/";	
		 
		 if ( $totalIma > 0) {
		 ?>
             <br />
             <a name="galeria" id="galeria"></a>
<h1>Galer&iacute;a</h1>  
             
             <div class="popup-gallery"> 
             <table align="center"><tr><td align="center">
                    <ul class="thumbnails" id="galeriaEspecieInf">        
                     <?php 		   
					  for ($i=0; $i<$totalIma; $i++) { 
						  $actualIma = getFila($resIma);							  
						  $imagen = $carpeta . ucfirst($actualIma['imagenes_id']) . ".jpg"; 
						  $imagen_zoom = $carpeta . ucfirst($actualIma['imagenes_id']) . "_z.jpg"; 
						  
						  // se verifica si existe imagen general para esta especie
						  if (!file_exists($imagen)) { 
							  $imagen = $carpeta . "imagenGeneral.jpg";  
							  				// se muestra la misma imagen pequeña
							 $nombre ="";
						  }
						  
						  // se verifica si existe imagen general para esta especie
						  if (!file_exists($imagen_zoom)) { 
							  $imagen_zoom = $carpeta . "imagenGeneral_z.jpg";  
							  				// se muestra la misma imagen pequeña
						  }						  
						  $leyenda = $actualIma['leyenda'];	
						  ?>
						  <li class="span1 galeriaEspecie">                         
						<a class="fancybox" rel="group1" href="<?php echo $imagen_zoom; ?>" 
                      			title="<?php echo $nombre . ".&nbsp; " . $leyenda; ?>">
                          <img src="<?php echo $imagen; ?>"  alt="imagen Especie" title="clic para hacer zoom" />
                    	</a>                           
                          </li>  
                        <?php 
		  				}	
						?>
                    </ul>   
                    </td></tr></table>
          </div> 

 <?php 
		 }
 }