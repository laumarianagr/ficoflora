<?php
//inicia session
session_start();

//verificamos si el usuario y contraseña son válidos
require('conexion.php');

$link = abrirConexion();
if (!$link) {
	die("No se pudo realizar la conexion con el servidor MySQL. <br> 
		Error:" .mysql_error());
	}

//consultando si el usuario existe
$usuario = $_POST["usuario"];
$clave = $_POST["clave"];

$query = "SELECT id, nombres, apellidos, perfil FROM usuarios WHERE usuario='".$usuario."' and clave='".$clave."'"; 
$res = ejecutarQuerySQL($query);

$total = getNumFilas($res);  // funcion que obtiene cantidad de filas de la consulta

if ($total == 1){
	//usuario y contraseña válidos, se define una sesion con los datos del usuario
	$actual = getFila($res);	
	
	$_SESSION["autenticado"]="si";
	$_SESSION["usuario"] = $actual['id'];
	$_SESSION["perfil"]=$actual['perfil'];
	$_SESSION["nombre"]= $actual['nombres']." ".$actual['apellidos'];		
}
else 
{
	//no existe el usuario, se solicita nuevamente la identificacion del usuario
	$_SESSION["autenticado"]="no";
	$_SESSION["perfil"]=4;
}
	header("Location: ../index_admin.php");
?>