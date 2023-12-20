<?php

require_once "../modelos/conexion.php";



$accion="";
if ( isset($_POST["accion01"]) ) {
    $accion = $_POST["accion01"];
}

if($accion==""){
	
	$id=$_POST["nuevoid"];

	if($id==""){
		$accion="insertar";
	}
	else{
		$accion="modificar";
	}

}


switch ($accion) {
	case "insertar":
			
		$nuevoid=$_POST["nuevoid"];
		$fecha_desde=$_POST["fecha_desde"];
		$fecha_hasta=$_POST["fecha_hasta"];
		$editaridusuario=$_POST["editaridusuario"];
		$modulo_cierre=$_POST["modulo_cierre"];


		$fechas = array();
		$fechaInicio = DateTime::createFromFormat('d-m-Y', $fecha_desde);
		$fechaFin = DateTime::createFromFormat('d-m-Y', $fecha_hasta);
		// Agregar un día a la fecha de fin para incluirlo en el rango
		$fechaFin->modify('+1 day');
		$intervalo = new DateInterval('P1D');
		$periodo = new DatePeriod($fechaInicio, $intervalo, $fechaFin);	
		foreach ($periodo as $fecha) {
			/* $fechas[] = $fecha->format('d-m-Y'); */
			
			$allfechas=$fecha->format('d-m-Y');

			$insertar="INSERT INTO `cierres`(`fecha_cierre`, `idusuario_cierre`, `modulo_cierre`) VALUES ('$allfechas',$editaridusuario,'$modulo_cierre')";
			
			$sql_devengo = Conexion::conectar()->prepare($insertar);
			$sql_devengo->execute();
			echo "Ok";
		}
	break;
	case "modificar":
	break;
	case "mostrar":
		function cierres() {
		  $query = "SELECT*FROM cierres";
		  $sql = Conexion::conectar()->prepare($query);
		  $sql->execute();			
		  return $sql->fetchAll();
		};

		$data_cierre=cierres();
		$html="";
		foreach ($data_cierre as $value) {
		  $html.="<tr>";
		  $html.="<td>".$value["fecha_cierre"]."</td>";
		  $html.="<td>".$value["idusuario_cierre"]."</td>";
		  $html.="<td>".$value["modulo_cierre"]."</td>";
		  $html.="<td>"."<button class='btn btn-danger eliminar' idcierre='".$value["id"]."'>Eliminar</button>"."</td>";
		  $html.="</tr>";
		}
		echo $html;
	break;
	case "eliminar":
			
			$nuevoid=$_POST["nuevoid"];
			$eliminar="DELETE FROM `cierres` WHERE id=$nuevoid";
			$sql_devengo = Conexion::conectar()->prepare($eliminar);
			$sql_devengo->execute();
			echo "Ok";
	break;
	case "verificar":
		function cierres($fecha,$modulo) {
		  $query = "SELECT*FROM cierres where fecha_cierre='$fecha' and modulo_cierre='$modulo'";
		  $sql = Conexion::conectar()->prepare($query);
		  $sql->execute();			
		  return $sql->fetchAll();
		};

		
		$data_cierre=cierres($_POST["fecha"],$_POST["modulo"]);
		$html=0;
		foreach ($data_cierre as $value) {
			$html++;
		}
		echo $html;
	break;

	default:
		echo $accion."respuesta nula";



}
