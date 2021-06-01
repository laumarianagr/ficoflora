<?php
// cierra la sesion del usuario
session_start();
session_unset();
session_destroy();
/*
if ( ($_SESSION["perfil"]==0 or $_SESSION["perfil"]==1 or 
			$_SESSION["perfil"]==2 or $_SESSION["perfil"]==3))
	header ("location:../index_admin.php");
else
*/
	header ("location:../index.php");
?>