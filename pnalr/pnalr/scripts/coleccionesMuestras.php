<?php 
/* procedimientos varios de gestión de las muestras de una COLECCIÓN, codificados en php  */

function fechaEuropea($f) { // formatea la fecha f a dd-mm-aaaa
    return date("d-m-Y",strtotime($f));
}

function coleccionConsultarNombreLocalidad($id) { 
	
	// consulta de el $id de la localidad de una visita específica
	$query = "SELECT localidad FROM  localidades WHERE id = $id";
	$res = ejecutarQuerySQL($query);	
	$actual = getFila($res);
	
return  $actual['localidad'];
}

function coleccionConsultarLocalidad($idVisitaLocalidad) { 
	
	// consulta de el $id de la localidad de una visita específica
	$query = "SELECT localidades_id FROM  visita_localidades WHERE id = $idVisitaLocalidad";
	$res = ejecutarQuerySQL($query);	
	$actual = getFila($res);
	$id = $actual['localidades_id'];
	
	$nombreLocalidad = coleccionConsultarNombreLocalidad($id);
			
return $nombreLocalidad;
}

function coleccionConsultarMuestras($idVisitaLocalidad, $fechaColeccion) { 
	// consulta de la información de las muestras asociadas a una colección realizada en una visita a una localidad
	$query = "SELECT num_coleccion num_coleccion, fecha_coleccion, visita_localidades_id, especies_id, por_verificar,
		nuevo_registro FROM colecciones WHERE fecha_coleccion = '$fechaColeccion' and  
		visita_localidades_id = $idVisitaLocalidad ORDER BY num_coleccion";
	$res = ejecutarQuerySQL($query);
			
return $res;
}


function listadoMuestrasxColeccion($idVisitaLocalidad, $fechaColeccion)  { 
	// consulta las muestras asociadas a una colección y crea un listado con opción de agregar más muestras 
	
	$res = coleccionConsultarMuestras($idVisitaLocalidad, $fechaColeccion);	
	$total = getNumFilas($res);
	
	if ($total == 0) {
		echo "No hay muestras asociada a la colección"; }
	else
	{	
?>                    
         <!--  ************   tabla de resultados de la consulta de muestras por colección  *************  -->  
         <div class="span8">
          <table class="table table-striped listado">
           <caption>Resultados: <strong> <?php echo $total; ?> </strong>muestras registradas para la colección 
           realizada en <strong><?php echo coleccionConsultarLocalidad($idVisitaLocalidad); ?> 
          (<?php echo fechaEuropea($fechaColeccion); ?>)</strong></caption>
           <thead> 
            <tr>
                    <th class="center">N&uacute;mero <br /> Colecci&oacute;n</th>
                    <th>Especie</th>                    
                    <th class="center">Por verificar (sp)</th>                   
                    <th class="center">Nuevo registro<br /> para Venezuela</th>
                    <th class="center">Operaciones</th>
            </tr>	
            </tr>
            
            <tbody>
          <?php  				
          $i = 1;
          while ($i < $total) 	{
            $actual = getFila($res);			
          ?>
                  <tr>
                    <td class="center"><?php echo $actual['num_coleccion']; ?></td>
                    <td>
                    <?php 	
						$nombreEspecie = especieConsultarNombre($actual['especies_id']);
						echo $nombreEspecie;
						  ?>						  
                    </td> 
                    <td class="center"><?php echo ($actual['por_verificar'] == '1') ? "si":"no";?></td>
                    <td class="center"><?php echo ($actual['nuevo_registro'] == '1') ? "si":"no";?></td>
                    <td class="center">
                        <div class="btn-group">
                            <a class="btn btn-primary" href="#" onclick="alert('Permitirá la modificación de los datos de la muestra')">Modificar</a>
                            <a class="btn btn-danger" href="#" onclick="alert('Eliminará esta muestra')">Eliminar</a>
                        </div>
                    </td>
                  </tr>
          <?php 
            $i++;
          } // end while
          ?>
          </tbody>
     </table>
  </div>  <!--   /div tabla de resultados -->
	<?php 
    } // end if	
 }
?>