<?php
function iniciar() {
session_start();
	if (!isset($_SESSION["autenticado"]) ) { 
		//no existe el usuario
		$_SESSION["autenticado"]="no";
		$_SESSION["perfil"]=4;
	}
}
?>