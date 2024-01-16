<?php

class Conexion
{

	static public function conectar()
	{

		$link = new PDO(
			"mysql:host=localhost;dbname=u900482437_grupoise",
			"u900482437_user_grupoise",
			"7wA~:]X|q]"
		);

		/*cpanel  */
		/* $link = new PDO("mysql:host=localhost;dbname=armonico_grupoise",
			            "armonico_grupoise",
			            "riverPlate11!!"); */

		/* hostinger */

		/* $link = new PDO("mysql:host=localhost;dbname=u551001918_grupoise",
			            "u551001918_grupoise",
			            "riverPlate11!!"); */



		$link->exec("set names utf8");

		return $link;
	}
}
