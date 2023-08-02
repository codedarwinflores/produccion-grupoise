<?php

function Conexion2()
{

	/* $dbname='grupoise';  */
	$dbhost = 'localhost';
	$dbname = 'u900482437_grupoise';
	$dbusr = 'u900482437_user_grupoise';
	$dbpasw = '4LXTbS22w';

	/* $dbhost='localhost'; 
	$dbname='armonico_grupoise'; 
	$dbusr='armonico_grupoise'; 
	$dbpasw='riverPlate11!!';  */



	$db = new mysqli($dbhost, $dbusr, $dbpasw, $dbname);
	$db->set_charset("utf8");

	if (!$db) {
		echo '<div class="error_ mensajes"><strong>Error</strong><br/>Se ha producido un error al conectar a la base de datos</div>';
		exit();
	}

	return $db;
}
