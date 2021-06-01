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
              
                  <form class="form-vertical pull-left">
                      
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
          <img class="media-object media-ima thumbnail pull-left" src="images/opcionautores.png">
          <div class="media-body">
              <h2 class="media-heading">Colecci&oacute;n</h2>
              
                  <form class="form-vertical pull-left">
                      
                      <div class="control-group">
                      <label for="fechaColeccion" class="label-inline">Fecha de la colecci&oacute;n</label>
                      <input name="fechaColeccion"  id="fechaColeccion" type="text" class="input-small" 
                      		placeholder="fecha colección" style="margin-right:6px;">
                      </div>
                      <div class="control-group">      
                      <label for="qLocalidad" class="label-inline">Localidad</label>
                      <input name="qLocalidad"  id="qLocalidad" type="text" class="input-xlarge" 
                              placeholder="p.e., Gran Roque">
                              
                      <button type="submit" class="btn" onclick="javascript:enDesarrollo();">registrar</button> 
                       </div>           
                      
                      <input name="op" id="op" type="hidden" value="localidad"/>
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


/*       *****************************  GÉNERO     ********************************* */

function consultarGeneros()  {
	// se crea el arreglo para las lista de autocompletar para géneros
	$arregloGenero = arregloAutocompletar("genero");  // en taxonomia.php
	$arregloFamilia = arregloAutocompletar("familia");  // en taxonomia.php
	?>             
	<script type="text/javascript">
    $(function(){
              
        // lista de géneros
        var autocompletarGenero = new Array();
            <?php 
             for($p = 0;$p < count($arregloGenero); $p++) { ?>
               autocompletarGenero.push('<?php echo $arregloGenero[$p]; ?>');
             <?php } ?>
             
            $("#qGenero").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
           source: autocompletarGenero //Le decimos que nuestra fuente es el arreglo
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
          <img class="media-object media-ima thumbnail pull-left" src="images/opcionautores.png">
          <div class="media-body">
              <h2 class="media-heading">G&eacute;nero</h2>
              
                  <form class="form-vertical pull-left">
                  
                      <div class="control-group">
                      <input name="qGenero"  id="qGenero" type="text" class="input-large" 
                              placeholder="p.e. Ulva o Caulerpa">
                       </div>
                  
                      <div class="control-group">      
                      <label for="qFamilia" class="label-inline">Familia del g&eacute;nero</label><br />
                      <input name="qFamilia"  id="qFamilia" type="text" class="input-large" 
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
          <img class="media-object media-ima thumbnail pull-left" src="images/opcionautores.png">
          <div class="media-body">
              <h2 class="media-heading">Familia</h2>
              
                  <form class="form-vertical pull-left">
                  
                      <div class="control-group">
                      <input name="qFamilia2"  id="qFamilia2" type="text" class="input-large" 
                              placeholder="p.e. Codiaceae">
                       </div>
                  
                      <div class="control-group">      
                      <label for="qOrden" class="label-inline">Orden de la familia</label><br />
                      <input name="qOrden"  id="qOrden" type="text" class="input-large" 
                              placeholder="p.e. Bryopsidales">
                              
                      <button type="submit" class="btn" onclick="javascript:enDesarrollo();">registrar</button> 
                       </div>
                      
                      <input name="op" id="op" type="hidden" value="genero"/>
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
          <img class="media-object media-ima thumbnail pull-left" src="images/opcionautores.png">
          <div class="media-body">
              <h2 class="media-heading">Orden</h2>
              
                  <form class="form-vertical pull-left">
                  
                      <div class="control-group">
                      <input name="qOrden2"  id="qOrden2" type="text" class="input-large" 
                              placeholder="p.e. Bryopsidales">
                       </div>
                  
                      <div class="control-group">      
                      <label for="qClase" class="label-inline">Clase del orden</label><br />
                      <input name="qClase"  id="qClase" type="text" class="input-large" 
                              placeholder="p.e. Bryopsidophyceae">
                              
                      <button type="submit" class="btn" onclick="javascript:enDesarrollo();">registrar</button> 
                       </div>
                      
                      <input name="op" id="op" type="hidden" value="genero"/>
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
          <img class="media-object media-ima thumbnail pull-left" src="images/opcionautores.png">
          <div class="media-body">
              <h2 class="media-heading">Clase</h2>
              
                  <form class="form-vertical pull-left">
                  
                      <div class="control-group">
                      <input name="qClase2"  id="qClase2" type="text" class="input-large" 
                              placeholder="p.e. Bryopsidophyceae">
                       </div>
                  
                      <div class="control-group">      
                      <label for="qDivision" class="label-inline">Divisi&oacute; de la clase</label><br />
                      <input name="qDivision"  id="qDivision" type="text" class="input-large" 
                              placeholder="p.e. Chlorophyta">
                              
                      <button type="submit" class="btn" onclick="javascript:enDesarrollo();">registrar</button> 
                       </div>
                      
                      <input name="op" id="op" type="hidden" value="genero"/>
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


/*       *****************************  CLASE     ********************************* */

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
          <img class="media-object media-ima thumbnail pull-left" src="images/opcionautores.png">
          <div class="media-body">
              <h2 class="media-heading">Divisi&oacute;n</h2>
              
                  <form class="form-vertical pull-left">
                  
                      <div class="control-group">
                      <input name="qDivision2"  id="qDivision2" type="text" class="input-large">
                              
                      <button type="submit" class="btn" onclick="javascript:enDesarrollo();">registrar</button> 
                       </div>
                      
                      <input name="op" id="op" type="hidden" value="genero"/>
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