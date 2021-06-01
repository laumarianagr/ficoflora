<?php 
// este archivo contiene las funciones para abrir la conexión, ejecutar el query y cerrar conexion
//@session_start(); //inicio la sesión

require ("config.ini.php");  // estamos llamando al codigo del config

$id_c = false;  
// identificador de la conexion, lo inicializamos asuminiendo conexion cerrada
// la declaramos aqu'i para poder usar como variable global de todas las funciones

function abrirConexion()
/*  1. abrir la conexión al smbd y probar que es exitosa la conexion */
/*  2. se selecciona la bdd a utilizar y se verifica el exito en la selección */
{
	global $id_c;  // para poder usar una variable global dentro de esta función
	$id_c = mysql_connect(_servidor, _usuario, _ctr);
	@mysql_query ("SET NAMES 'utf8'");
	//@ para que no retorne un warning
	
	if (!$id_c)  // no se abrió conexión
	return false;

	if (!mysql_select_db(_bd, $id_c))   
		// no selecciono la bdd, p.e., falta de permiso al usuario definido en el config
		return false;

    return true;
}

function ejecutarQuerySQL($sql)
/* 3. se ejecuta el query pasado en el parametro $sql  */
{
	global $id_c;

	if ($id_c)  // si hay un identificador de conexion a bdd abierta
		return @mysql_query($sql, $id_c); 
		// $sql: texto del query a ejecutar (insert, select, delete, ...)
		// $id_c: mysql_query tambien utiliza el identificador de la conexion ($id_c)
	else
		return false;
}


function cerrarConexion()
/* 4. se cierra la conexion  */
{
	global $id_c;
	
	if ($id_c)  // si hay un identificador de conexion a bdd abierta
		mysql_close($id_c);	

}

// OTRAS funciones de manejo de la bdd

function getNumFilas($res)
{ // indica cantidad de filas obtenidos en la consulta $res
    return @mysql_num_rows($res);
	}

function getFila($res)
{ 
// devuelve los datos de una fila en particular como una tabla o arreglo sociativo
// automaticamente avanza al siguiente registro del resultado

	return @mysql_fetch_array($res);
	}
?>