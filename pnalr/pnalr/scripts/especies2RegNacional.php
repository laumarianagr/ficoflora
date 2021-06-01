<?php 
include ("conexion.php");	
abrirConexion();

	
	$op=$_REQUEST['op'];
	
	if ($op==1) {
		$id1=$_REQUEST['id1'];
		$query = "SELECT id, nuevo_registro, generos_id, epiteto_especifico 
				FROM  especies 
				WHERE nuevo_registro=0  AND  generos_id=$id1 
				GROUP BY epiteto_especifico ORDER BY epiteto_especifico"; 
		$res = ejecutarQuerySQL($query);
		// se construyen las opciones del select creado dinámicamente
		// opciones de epiteto específico
		while($row = mysql_fetch_assoc($res)) {
			echo"<option value='".$row['epiteto_especifico']."'>".$row['epiteto_especifico']."</option>  "; 
		}
	}
	elseif ($op==2) {
		$id1=$_REQUEST['id1'];
		$id2=$_REQUEST['id2'];
		$query = "SELECT id, nuevo_registro, generos_id, epiteto_especifico, epiteto_varietal  
				FROM  especies 
				WHERE nuevo_registro=0  AND  generos_id=$id1 AND epiteto_especifico='$id2' 
				ORDER BY epiteto_varietal"; 
		$res = ejecutarQuerySQL($query);
		
		// opciones de epiteto varietal
		while($row = mysql_fetch_assoc($res)) {
			echo"<option value='".$row['epiteto_varietal']."'>".$row['epiteto_varietal']."</option>  "; 
		}
		}
		
		if ($op==3) {
		$id1=$_REQUEST['id1'];
		$id2=$_REQUEST['id2'];
		$query = "SELECT id, nuevo_registro, generos_id, epiteto_especifico, epiteto_forma  
				FROM  especies 
				WHERE nuevo_registro=0  AND  generos_id=$id1 AND epiteto_especifico='$id2' 
				GROUP BY epiteto_forma ORDER BY epiteto_forma"; 
		$res = ejecutarQuerySQL($query);
		
		// opciones de epiteto forma
		while($row = mysql_fetch_assoc($res)) {
			echo"<option value='".$row['epiteto_forma']."'>".$row['epiteto_forma']."</option>  "; 
		}
		}
		
		if ($op==4) {
		$id1=$_REQUEST['id1'];
		$id2=$_REQUEST['id2'];
		$id3=$_REQUEST['id3'];
		$campo='epiteto_varietal';
		}else		
		if ($op==5) {
		$id1=$_REQUEST['id1'];
		$id2=$_REQUEST['id2'];
		$id3=$_REQUEST['id3'];
		$campo='epiteto_forma';
		}	
		
		$query = "SELECT id, nuevo_registro, generos_id, epiteto_especifico, $campo, autores_id  
				FROM  especies 
				WHERE generos_id=$id1 AND epiteto_especifico='$id2'  AND $campo='$id3'"; 
		$res = ejecutarQuerySQL($query);		
		$actual = getFila($res);		
		$idAutor = $actual['autores_id'];
		
		$query = "SELECT id, autor  FROM  autores WHERE id=$idAutor"; 
		$res = ejecutarQuerySQL($query);	
		$actual = getFila($res);		
		
		// autor(es) de la especie	
		echo"<option value='".$actual['id']."'>".$actual['autor']."</option>  "; 

cerrarConexion();
?>