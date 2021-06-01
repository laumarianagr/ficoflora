<?php 
/* procedimientos varios para registrar nueva información en la base de datos desde autor a división  */

/*       *****************************  AUTOR    ********************************* */
function consultarAutores()  {	
	// se crea el arreglo para las lista de autocompletar para autor
	$arregloAutor = arregloAutocompletar("autor");  // en taxonomia.php
	?>             
	<script type="text/javascript">
    $(function(){
              
        // lista de géneros
        var autocompletarAutor = new Array();
            <?php 
             for($p = 0;$p < count($arregloAutor); $p++) { ?>
               autocompletarAutor.push('<?php echo $arregloAutor[$p]; ?>');
             <?php } ?>
             
            $("#qAutor").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
           source: autocompletarAutor //Le decimos que nuestra fuente es el arreglo
		   });
		});  // fin listas autocompletar
	  </script>
      
      <div class="media">
          <img class="media-object media-ima thumbnail pull-left" src="images/opcionautores.png">
          <div class="media-body">
              <h2 class="media-heading">Autor</h2>
              
                  <form class="form-horizontal pull-left">
                      
                      <div class="control-group">
                      <input name="qAutor"  id="qAutor" type="text" class="input-xlarge" 
                              placeholder="verifique si el autor está ya incluido">
                      <button type="submit" class="btn" onclick="javascript:enDesarrollo();">registrar</button>
                      </div>
                       
                     <span class="help-block">ejemplos: J.V.Lamouroux &nbsp;&#8226;&nbsp; Sonder ex Kützing 
                     	&nbsp;&#8226;&nbsp; (C.Agardh) Kützing &nbsp;&#8226;&nbsp; (Hare ex Turner) Huisman, G.W.Saunders & A.R.Sherwood
                     <br /><a href="http://www.iapt-taxon.org/nomen/main.php" title="Código de Nomenclatura" target="_blank">+info: Código de Nomenclatura Internacional <span class="smaller-en-pq"> { International Code of Nomenclature</span></a><span style="color:#F00"> EL CUAL <b>NO</b> ESTAMOS SIGUIENDO </span>
                     </span> 
                      
                      <input name="op" id="op" type="hidden" value="autor"/>                                
                  </form>
          </div>
      </div>				
<?				
}

function guardarAutor($txt, $tabla)  {	
	// consulta la distribución para el PNALR por localidad según $tabla
	
	$query = "SELECT * FROM $tabla WHERE localidades_id=$id"; 
	$res = ejecutarQuerySQL($query); 
	return($res); 
}


function registrarAutor()  {	
	// se crean los arreglos para las listas de autocompletar para autor
	consultarAutores();
}



/*       *****************************  COLECCIÓN     ********************************* */

function consultarColecciones()  {
	// se crea el arreglo para las lista de autocompletar para colección	
	$arregloLocalidad = arregloAutocompletar("localidad");  // en taxonomia.php
	?>             
	<script type="text/javascript">
    $(function(){
              
        // lista de géneros
        var autocompletarLocalidad = new Array();
            <?php 
             for($p = 0;$p < count($arregloLocalidad); $p++) { ?>
               autocompletarLocalidad.push('<?php echo $arregloLocalidad[$p]; ?>');
             <?php } ?>
             
            $("#qLocalidad").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
           source: autocompletarLocalidad //Le decimos que nuestra fuente es el arreglo
		   });
		});  // fin listas autocompletar
	  </script>
      
      <div class="media">
          <img class="media-object media-ima thumbnail pull-left" src="images/opcioncoleccion.png">
          <div class="media-body">
              <h2 class="media-heading">Colecci&oacute;n</h2>
              
                  <form class="form-horizontal pull-left">
                      
                      <div class="control-group">
                      <label for="fechaColeccion" class="label-inline">Fecha colecci&oacute;n</label>
                      <input name="fechaColeccion"  id="fechaColeccion" type="text" class="input-small" 
                      		placeholder="" style="margin-right: 3px;">
                       
                      <label for="qLocalidad" class="label-inline margenIzq">Localidad</label>
                      <input name="qLocalidad"  id="qLocalidad" type="text" class="input-medium" 
                              placeholder="p.e., Gran Roque">
                     </div>
                              
                     <div class="control-group">
                     <label for="comentarios">Comentarios</label> 
                      <textarea rows="6" cols="60" data-rta="italic bold ul ol" class="rta" id="comentarios" 
                      	name="comentarios" placeholder="Pradera de <em>Thalassia testudium</em>, hasta 1,5 m de profundidad, oleaje moderado." readonly=""></textarea>
                      </div>
                      
                      <div class="control-group">
                      
                      <label for="colectores" class="label-inline">Colectores</label>
                      <input name="colectores"  id="colectores" type="text" class="input-xxlarge" 
                              placeholder="Santiago Gómez, Mayra García, Nelson Gil, Yusneyi Carballo Barrera">
                     </div>
                        
                      <div class="control-group">                              
                      <button type="submit" class="btn" onclick="javascript:enDesarrollo();">registrar</button> 
                      </div>                       
                      
                      <input name="op" id="op" type="hidden" value="coleccion"/>
                      <input name="opcolectores" id="opcolectores" type="hidden" 
                      	value="Santiago Gómez, Mayra García, Nelson Gil, Yusneyi Carballo Barrera"/>
                  </form>
          </div>
      </div>				
<?				
}

function guardarColeccion($txt, $tabla)  {	
	// consulta la distribución para el PNALR por localidad según $tabla
	
	$query = "SELECT * FROM $tabla WHERE localidades_id=$id"; 
	$res = ejecutarQuerySQL($query); 
	return($res);
}


function registrarColeccion()  {	
	// se crean los arreglos para las listas de autocompletar para colección
	consultarColecciones();
}


/*       *****************************  LOCALIDAD     ********************************* */

function consultarLocalidades()  {
	// se crea el arreglo para las lista de autocompletar para localidad	
	$arregloLocalidad2 = arregloAutocompletar("localidad");  // en taxonomia.php
	?>             
	<script type="text/javascript">
    $(function(){
              
        // lista de géneros
        var autocompletarLocalidad2 = new Array();
            <?php 
             for($p = 0;$p < count($arregloLocalidad2); $p++) { ?>
               autocompletarLocalidad2.push('<?php echo $arregloLocalidad2[$p]; ?>');
             <?php } ?>
             
            $("#qLocalidad2").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
           source: autocompletarLocalidad2 //Le decimos que nuestra fuente es el arreglo
		   });
		});  // fin listas autocompletar
	  </script>
      
      <div class="media">
          <img class="media-object media-ima thumbnail pull-left" src="images/opcionlocalidad.png">
          <div class="media-body">
              <h2 class="media-heading">Localidad</h2>
              
                  <form class="form-horizontal pull-left">
                      
                      <div class="control-group">                       
                      <label for="qLocalidad2" class="label-inline margenIzq">Localidad</label>
                      <input name="qLocalidad2"  id="qLocalidad2" type="text" class="input-medium" 
                              placeholder="p.e., Gran Roque">
                                   
                      <label for="lugar" class="label-inline margenIzq">Lugar</label>
                      <input name="lugar"  id="lugar" type="text" disabled="disabled"  
                      	class="input-xlarge" placeholder="Parque Nacional Archipiélago Los Roques">
                        </div>  
                                                                     
                      <div class="control-group">                              
                      <label for="coordenadasGeograficas" class="label-inline margenIzq">
                      		Coordenadas Geogr&aacute;ficas</label>
                      <input name="coordenadasGeograficas"  id="coordenadasGeograficas" type="text" 
                      	class="input-large" placeholder="p.e., 11° 57' 03.0'' N, 66° 40' 11.9'' O">                        
                              
                      <label for="coordenadasUTM" class="label-inline margenIzq">
                      		Coordenadas UTM</label>
                      <input name="coordenadasUTM"  id="coordenadasUTM" type="text" 
                      	class="input-large" placeholder="p.e., 753755 E, 1322185 N"> 
                        
                      <button type="submit" class="btn" onclick="javascript:enDesarrollo();">registrar</button>                       
                                              
                     <span class="help-block">
                     	Ejemplo de coordenada geogr&aacute;fica: 11° 57' 03.0'' N, 66° 40' 11.9'' O &nbsp;&#8226;&nbsp;
                        Ejemplo de coordenada UTM: 753755 E, 1322185 N
                     </span>         
                     </div>   
                      
                      <input name="op" id="op" type="hidden" value="localidad"/>
                  </form>
          </div>
      </div>				
<?				
}

function guardarLocalidad($txt, $tabla)  {	
	// consulta la distribución para el PNALR por localidad según $tabla
	
	$query = "SELECT * FROM $tabla WHERE localidades_id=$id"; 
	$res = ejecutarQuerySQL($query); 
	return($res);
}


function registrarLocalidad()  {	
	// se crean los arreglos para las listas de autocompletar para colección
	consultarLocalidades();
}


/*       *****************************  ESPECIE     ********************************* */

function consultarEspecies()  {
	// se crea el arreglo para las lista de autocompletar para especie	
	$arregloEspecie = arregloAutocompletar("especie");  // en taxonomia.php
	$arregloGenero = arregloAutocompletar("genero");  // en taxonomia.php
	?>             
	<script type="text/javascript">
    $(function(){
              
        // lista de especies
        var autocompletarEspecie = new Array();
            <?php 
             for($p = 0;$p < count($arregloEspecie); $p++) { ?>
               autocompletarEspecie.push('<?php echo $arregloEspecie[$p]; ?>');
             <?php } ?>
             
            $("#qEspecie").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
           source: autocompletarEspecie //Le decimos que nuestra fuente es el arreglo
		   });
		   
		   // lista de géneros
        var autocompletarGenero = new Array();
            <?php 
             for($p = 0;$p < count($arregloGenero); $p++) { ?>
               autocompletarGenero.push('<?php echo $arregloGenero[$p]; ?>');
             <?php } ?>
             
            $("#qGenero").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
           source: autocompletarGenero //Le decimos que nuestra fuente es el arreglo
		   });
		});  // fin listas autocompletar
	  </script>
      
      <div class="media">
          <img class="media-object media-ima thumbnail pull-left" src="images/opcion1.png">
          <div class="media-body">
              <h2 class="media-heading">Especie</h2>
              
                  <form class="form-horizontal pull-left">
                      
                      <div class="control-group">                       
                      <label for="qEspecie" class="label-inline margenIzq">Ep&iacute;teto espec&iacute;fico</label>
                      <input name="qEspecie"  id="qEspecie" type="text" class="input-medium" 
                              placeholder="p.e., Caulerpa peltata">
                                   
                      <label for="epitetoVarietal" class="label-inline margenIzq">Ep&iacute;teto varietal</label>
                      <input name="epitetoVarietal"  id="epitetoVarietal" type="text" 
                      	class="input-large" placeholder="p.e., venezuelensis o macrophysa"> 
                                   
                      <label for="epitetoForma" class="label-inline margenIzq">Ep&iacute;teto de forma</label>
                      <input name="epitetoForma"  id="epitetoForma" type="text" 
                      	class="input-large" placeholder="p.e., elongata"> 
                        </div>  
                                                                     
                      <div class="control-group">                              
                      <label for="qGenero" class="label-inline margenIzq">G&eacute;nero de la especie</label>
                      <input name="qGenero"  id="qGenero" type="text" class="input-medium" 
                              placeholder="p.e. Ulva o Caulerpa">
                        
                      <button type="submit" class="btn" onclick="javascript:enDesarrollo();">registrar</button>
                     </div>   
                      
                      <input name="op" id="op" type="hidden" value="especie"/>
                  </form>
          </div>
      </div>				
<?				
}

function guardarEspecie($txt, $tabla)  {	
	// consulta la distribución para el PNALR por localidad según $tabla
	
	$query = "SELECT * FROM $tabla WHERE localidades_id=$id"; 
	$res = ejecutarQuerySQL($query); 
	return($res);
}


function registrarEspecie()  {	
	// se crean los arreglos para las listas de autocompletar para colección
	consultarEspecies();
}


/*       *****************************  GÉNERO     ********************************* */

function consultarGeneros()  {
	// se crea el arreglo para las lista de autocompletar para géneros
	$arregloGenero2 = arregloAutocompletar("genero");  // en taxonomia.php
	$arregloFamilia = arregloAutocompletar("familia");  // en taxonomia.php
	?>             
	<script type="text/javascript">
    $(function(){
              
        // lista de géneros
        var autocompletarGenero2 = new Array();
            <?php 
             for($p = 0;$p < count($arregloGenero2); $p++) { ?>
               autocompletarGenero2.push('<?php echo $arregloGenero2[$p]; ?>');
             <?php } ?>
             
            $("#qGenero2").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
           source: autocompletarGenero2 //Le decimos que nuestra fuente es el arreglo
		   });
		   
		   var autocompletarFamilia = new Array();
            <?php 
             for($p = 0;$p < count($arregloFamilia); $p++) { ?>
               autocompletarFamilia.push('<?php echo $arregloFamilia[$p]; ?>');
             <?php } ?>
             
            $("#qFamilia").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
           source: autocompletarFamilia //Le decimos que nuestra fuente es el arreglo
		   });
		   
		});  // fin listas autocompletar
	  </script>
      
      <div class="media">
          <img class="media-object media-ima thumbnail pull-left" src="images/opcion2.png">
          <div class="media-body">
              <h2 class="media-heading">G&eacute;nero</h2>
              
                  <form class="form-horizontal pull-left">
                  
                      <div class="control-group">
                      <input name="qGenero2"  id="qGenero2" type="text" class="input-medium" 
                              placeholder="p.e. Ulva o Caulerpa"> 
                              
                      <label for="qFamilia" class="label-inline margenIzq">Familia del g&eacute;nero</label>
                      <input name="qFamilia"  id="qFamilia" type="text" class="input-medium" 
                              placeholder="p.e. Ulvaceae o Caulerpaceae">
                              
                      <button type="submit" class="btn" onclick="javascript:enDesarrollo();">registrar</button> 
                       </div>
                      
                      <input name="op" id="op" type="hidden" value="genero"/>
                  </form>
          </div>
      </div>				
<?				
}

function guardarGenero($txt, $tabla)  {
	
	$query = "SELECT * FROM $tabla WHERE localidades_id=$id"; 
	$res = ejecutarQuerySQL($query); 
	return($res);
}


function registrarGenero()  {	
	// se crean los arreglos para las listas de autocompletar para genero
	consultarGeneros();
}


/*       *****************************  FAMILIA     ********************************* */

function consultarFamilias()  {
	// se crea el arreglo para las lista de autocompletar para familias
	$arregloFamilia2= arregloAutocompletar("familia");  // en taxonomia.php
	$arregloOrden = arregloAutocompletar("orden");  // en taxonomia.php
	?>             
	<script type="text/javascript">
    $(function(){
              
        // lista de géneros
        var autocompletarFamilia2 = new Array();
            <?php 
             for($p = 0;$p < count($arregloFamilia2); $p++) { ?>
               autocompletarFamilia2.push('<?php echo $arregloFamilia2[$p]; ?>');
             <?php } ?>
             
            $("#qFamilia2").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
           source: autocompletarFamilia2 //Le decimos que nuestra fuente es el arreglo
		   });
		   
		   var autocompletarOrden = new Array();
            <?php 
             for($p = 0;$p < count($arregloOrden); $p++) { ?>
               autocompletarOrden.push('<?php echo $arregloOrden[$p]; ?>');
             <?php } ?>
             
            $("#qOrden").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
           source: autocompletarOrden //Le decimos que nuestra fuente es el arreglo
		   });
		   
		});  // fin listas autocompletar
	  </script>
      
      <div class="media">
          <img class="media-object media-ima thumbnail pull-left" src="images/opcion3.png">
          <div class="media-body">
              <h2 class="media-heading">Familia</h2>
              
                  <form class="form-horizontal pull-left">
                  
                      <div class="control-group">
                      <input name="qFamilia2"  id="qFamilia2" type="text" class="input-medium" 
                              placeholder="p.e. Codiaceae">
                              
                      <label for="qOrden" class="label-inline margenIzq">Orden de la familia</label>
                      <input name="qOrden"  id="qOrden" type="text" class="input-medium" 
                              placeholder="p.e. Bryopsidales">
                              
                      <button type="submit" class="btn" onclick="javascript:enDesarrollo();">registrar</button> 
                       </div>
                      
                      <input name="op" id="op" type="hidden" value="familia"/>
                  </form>
          </div>
      </div>				
<?				
}

function guardarFamilia($txt, $tabla)  {
	
	$query = "SELECT * FROM $tabla WHERE localidades_id=$id"; 
	$res = ejecutarQuerySQL($query); 
	return($res);
}


function registrarFamilia()  {	
	// se crean los arreglos para las listas de autocompletar para familia
	consultarFamilias();
}



/*       *****************************  ORDEN     ********************************* */

function consultarOrdenes()  {
	// se crea el arreglo para las lista de autocompletar para órdenes
	$arregloOrden2= arregloAutocompletar("orden");  // en taxonomia.php
	$arregloClase= arregloAutocompletar("clase");  // en taxonomia.php
	?>             
	<script type="text/javascript">
    $(function(){
              
        // lista de géneros
        var autocompletarOrden2 = new Array();
            <?php 
             for($p = 0;$p < count($arregloOrden2); $p++) { ?>
               autocompletarOrden2.push('<?php echo $arregloOrden2[$p]; ?>');
             <?php } ?>
             
            $("#qOrden2").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
           source: autocompletarOrden2 //Le decimos que nuestra fuente es el arreglo
		   });
		   
		   var autocompletarClase = new Array();
            <?php 
             for($p = 0;$p < count($arregloClase); $p++) { ?>
               autocompletarClase.push('<?php echo $arregloClase[$p]; ?>');
             <?php } ?>
             
            $("#qClase").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
           source: autocompletarClase //Le decimos que nuestra fuente es el arreglo
		   });
		   
		});  // fin listas autocompletar
	  </script>
      
      <div class="media">
          <img class="media-object media-ima thumbnail pull-left" src="images/opcion4.png">
          <div class="media-body">
              <h2 class="media-heading">Orden</h2>
              
                  <form class="form-horizontal pull-left">
                  
                      <div class="control-group">
                      <input name="qOrden2"  id="qOrden2" type="text" class="input-medium" 
                              placeholder="p.e. Bryopsidales"> 
                              
                      <label for="qClase" class="label-inline margenIzq">Clase del orden</label>
                      <input name="qClase"  id="qClase" type="text" class="input-medium" 
                              placeholder="p.e. Bryopsidophyceae">
                              
                      <button type="submit" class="btn" onclick="javascript:enDesarrollo();">registrar</button> 
                       </div>
                      
                      <input name="op" id="op" type="hidden" value="orden"/>
                  </form>
          </div>
      </div>				
<?				
}

function guardarOrden($txt, $tabla)  {
	
	$query = "SELECT * FROM $tabla WHERE localidades_id=$id"; 
	$res = ejecutarQuerySQL($query); 
	return($res);
}


function registrarOrden()  {	
	// se crean los arreglos para las listas de autocompletar para orden
	consultarOrdenes();
}


/*       *****************************  CLASE     ********************************* */

function consultarClases()  {
	// se crea el arreglo para las lista de autocompletar para órdenes
	$arregloClase2= arregloAutocompletar("clase");  // en taxonomia.php
	$arregloDivision= arregloAutocompletar("division");  // en taxonomia.php
	?>             
	<script type="text/javascript">
    $(function(){
              
        // lista de géneros
        var autocompletarClase2 = new Array();
            <?php 
             for($p = 0;$p < count($arregloClase2); $p++) { ?>
               autocompletarClase2.push('<?php echo $arregloClase2[$p]; ?>');
             <?php } ?>
             
            $("#qClase2").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
           source: autocompletarClase2 //Le decimos que nuestra fuente es el arreglo
		   });
		   
		   var autocompletarDivision = new Array();
            <?php 
             for($p = 0;$p < count($arregloDivision); $p++) { ?>
               autocompletarDivision.push('<?php echo $arregloDivision[$p]; ?>');
             <?php } ?>
             
            $("#qDivision").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
           source: autocompletarDivision //Le decimos que nuestra fuente es el arreglo
		   });
		   
		});  // fin listas autocompletar
	  </script>
      
      <div class="media">
          <img class="media-object media-ima thumbnail pull-left" src="images/opcion5.png">
          <div class="media-body">
              <h2 class="media-heading">Clase</h2>
              
                  <form class="form-horizontal pull-left">
                  
                      <div class="control-group">
                      <input name="qClase2"  id="qClase2" type="text" class="input-medium" 
                              placeholder="p.e. Bryopsidophyceae">
                              
                      <label for="qDivision" class="label-inline margenIzq">Divisi&oacute;n de la clase</label>
                      <input name="qDivision"  id="qDivision" type="text" class="input-medium" 
                              placeholder="p.e. Chlorophyta">
                              
                      <button type="submit" class="btn" onclick="javascript:enDesarrollo();">registrar</button> 
                       </div>
                      
                      <input name="op" id="op" type="hidden" value="clase"/>
                  </form>
          </div>
      </div>				
<?				
}

function guardarClase($txt, $tabla)  {
	
	$query = "SELECT * FROM $tabla WHERE localidades_id=$id"; 
	$res = ejecutarQuerySQL($query); 
	return($res);
}


function registrarClase()  {	
	// se crean los arreglos para las listas de autocompletar para clase
	consultarClases();
}


/*       *****************************  DIVISIÓN     ********************************* */

function consultarDivisiones()  {
	// se crea el arreglo para las lista de autocompletar para divisiones
	$arregloDivision2= arregloAutocompletar("division");  // en taxonomia.php
	?>             
	<script type="text/javascript">
    $(function(){
              
        // lista de géneros
        var autocompletarDivision2 = new Array();
            <?php 
             for($p = 0;$p < count($arregloDivision2); $p++) { ?>
               autocompletarDivision2.push('<?php echo $arregloDivision2[$p]; ?>');
             <?php } ?>
             
            $("#qDivision2").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
           source: autocompletarDivision2 //Le decimos que nuestra fuente es el arreglo
		   });
		   
		});  // fin listas autocompletar
	  </script>
      
      <div class="media">
          <img class="media-object media-ima thumbnail pull-left" src="images/opcion6.png">
          <div class="media-body">
              <h2 class="media-heading">Divisi&oacute;n</h2>
              
                  <form class="form-horizontal pull-left">
                  
                      <div class="control-group">
                      <input name="qDivision2"  id="qDivision2" type="text" class="input-medium">
                              
                      <button type="submit" class="btn" onclick="javascript:enDesarrollo();">registrar</button> 
                       </div>
                      
                      <input name="op" id="op" type="hidden" value="division"/>
                  </form>
          </div>
      </div>				
<?				
}

function guardarDivision($txt, $tabla)  {
	
	$query = "SELECT * FROM $tabla WHERE localidades_id=$id"; 
	$res = ejecutarQuerySQL($query); 
	return($res);
}


function registrarDivision()  {	
	// se crean los arreglos para las listas de autocompletar para division
	consultarDivisiones();
}