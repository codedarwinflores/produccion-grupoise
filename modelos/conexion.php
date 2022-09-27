<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=grupoise",
			            "armonicoise",
			            "fcInternazionale11!!");

		$link->exec("set names utf8");

		return $link;

	}

}