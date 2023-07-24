<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=grupoiseserver",
			            "root",
			            "");

	/* $link = new PDO("mysql:host=localhost;dbname=armonico_grupoise",
			            "armonico_grupoise",
			            "riverPlate11!!"); */

		$link->exec("set names utf8");

		return $link;

	}

}