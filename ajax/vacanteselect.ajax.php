

<?php

require_once "../modelos/conexion.php";
$idubicacion="";
if ( isset($_POST["idubicacion"]) ) {
    $idubicacion = $_POST["idubicacion"];
}
$accion="";
if ( isset($_POST["accion"]) ) {
    $accion = $_POST["accion"];
}
$idempleado="";
if ( isset($_POST["idempleado"]) ) {
    $idempleado = $_POST["idempleado"];
}






switch ($accion) {
	case "pocision":

		function consultar($e)
		{
			$query01 = "SELECT `id`, `nombre_posicion`, `numero`, `idubicacion_posicion` FROM `posicion_ubicacion` WHERE idubicacion_posicion=$e";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$data01 = consultar($idubicacion);
		$datos_html = "";
	
		foreach ($data01 as $value) {
			$datos_html .= ' <option value="'.$value["nombre_posicion"].'" >'.$value["nombre_posicion"].'</option>';
		
		}
		echo $datos_html;

	break;

	case "empleado":

		function consultar($e)
		{
			$query01 = "SELECT tbl_clientes_ubicaciones.id as idcliente, tbl_clientes_ubicaciones.*, tbl_ubicaciones_agentes_asignados.*
			FROM `tbl_ubicaciones_agentes_asignados` ,tbl_clientes_ubicaciones
			WHERE tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and tbl_ubicaciones_agentes_asignados.codigo_agente='$e'
			group by tbl_clientes_ubicaciones.id";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$data01 = consultar($idempleado);
		$datos_html = "";
	
		$nombre_ubicacion="";
		$codigo_ubicacion="";
		foreach ($data01 as $value) {
			$datos_html .= "<option idubicacion='".$value["idcliente"]."' codigo='".$value["codigo_ubicacion"]."' nombre='".$value["nombre_ubicacion"]."' value='".$value["codigo_ubicacion"]."'>".$value["codigo_ubicacion"]."-".$value["nombre_ubicacion"]." </option>";
			$nombre_ubicacion.=$value["nombre_ubicacion"];
			$codigo_ubicacion.=$value["codigo_ubicacion"];
			
		
		}
		echo $datos_html.",".$nombre_ubicacion.",".$codigo_ubicacion;

	break;

	
	default:
		echo $accion;
}








?>