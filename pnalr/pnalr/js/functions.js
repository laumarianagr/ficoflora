// JavaScript Document
// funciones varias de formato y validación

function enfocar(c) { // coloca el foco en  el campo c
	c.focus();
}


function limpiar(c) { // limpia el campo c
	c.value = "";
return true;
}

function reiniciar(c,m) { // limpia el campo c
	c.value = m;
return true;
}

function enDesarrollo() { // muestra un mensaje al usuario
	alert("en desarrollo el almacenamiento en la bdd");
return false;
}

