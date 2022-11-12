<?php

function Conexion2(){
	$dbhost='localhost'; // servidor de MySQL (nombre o DNS)
    //	$dbname='armonico_imporfrutm1'; // Nombre de la base de datos
	$dbname='grupoise'; // Nombre de la base de datos
	$dbusr='root'; // Nombre del usuario de base de datos
	$dbpasw=''; // Contrasenna de base de datos

	$db = new mysqli($dbhost,$dbusr,$dbpasw,$dbname);
	if (!$db){
		echo '<div class="error_ mensajes"><strong>Error</strong><br/>Se ha producido un error al conectar a la base de datos</div>';
		exit();
	}
		
	return $db;
}		
?>
