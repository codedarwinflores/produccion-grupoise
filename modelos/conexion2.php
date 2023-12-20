<?php

function Conexion2()
{

	/* $dbname='grupoise';  */
	$dbhost = 'localhost';
	$dbname = 'grupoiseserver';
	$dbusr = 'root';
	$dbpasw = '';

	/* cpanel */
	/* $dbhost='localhost'; 
	$dbname='armonico_grupoise'; 
	$dbusr='armonico_grupoise'; 
	$dbpasw='riverPlate11!!';  */


	/* hostinger */
	/* $dbhost='localhost'; 
	$dbname='u551001918_grupoise'; 
	$dbusr='u551001918_grupoise'; 
	$dbpasw='riverPlate11!!';  */

	$db = new mysqli($dbhost, $dbusr, $dbpasw, $dbname);
	$db->set_charset("utf8");

	if (!$db) {
		echo '<div class="error_ mensajes"><strong>Error</strong><br/>Se ha producido un error al conectar a la base de datos</div>';
		exit();
	}

	return $db;
}
