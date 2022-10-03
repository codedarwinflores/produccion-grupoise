<?php

require_once "conexion.php";

		$nombretabla = "servicios";
		$namecolumnas="";
		$namecampos="";
	
		function getNumeroCOlumnas() {
			global $nombretabla;
			$query = "SELECT*FROM $nombretabla";
			$sql = Conexion::conectar()->prepare($query);
			$sql->execute();
			return $sql->columnCount();
		}
		
		function getContent() {
			global $nombretabla;
			$query = "SHOW COLUMNS FROM $nombretabla";
			$sql = Conexion::conectar()->prepare($query);
			$sql->execute();			
			return $sql->fetchAll();
		}

		
		$data = getContent();
/* 		foreach($data as $row) {
			$row['Field'];
			$namecolumnas.=$row['Field'].",";
			$namecampos.=":".$row['Field'].",";
		}

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(".trim($namecolumnas,",").") VALUES (".trim($namecampos,",").")");
 */
$array=array();
		foreach($data as $row) {
			/* $stmt->bindParam(":".$row['Field'], $datos["".$row['Field'].""], PDO::PARAM_STR);
			$test= $row['Field']."=".":".$row['Field'].",";
 *//* 
			$datos = array("".$row['Field']."" => $_POST["nuevo".$row['Field'].""],); */
			/* $namecolumnas .= " ".$row['Field']." "." =>". $_POST["nuevo".$row['Field'].""].","; */
			array_push($array,$datos0);
			

		}

		print_r( $array);
		