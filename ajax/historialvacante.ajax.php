

<?php

require_once "../modelos/conexion.php";

$accion="";
if ( isset($_POST["accion"]) ) {
    $accion = $_POST["accion"];
}

$id="";
if ( isset($_POST["id"]) ) {
    $id = $_POST["id"];
}

$nombre_tabla="historialvacante";
function getContent($tabla)
{
	$query = "SHOW COLUMNS FROM $tabla";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
}


switch ($accion) {
	case "insertar":


		/* ****************** */
		/* CAPTURA NOMBRE DE LAS COLUMNAS Y CAMPOS DEL IMPUT */
		$namecolumnas_situacion = "";
		$namecampos_situacion = "";

		$data = getContent($nombre_tabla);
		foreach ($data as $row) {
			$namecolumnas_situacion .= $row['Field'] . ",";
			$namecampos_situacion .= ":" . $row['Field'] . ",";
		}
		$stmt = Conexion::conectar()->prepare("INSERT INTO $nombre_tabla(" . trim($namecolumnas_situacion, ",") . ") VALUES (" . trim($namecampos_situacion, ",") . ")");

		echo "INSERT INTO $nombre_tabla(" . trim($namecolumnas_situacion, ",") . ") VALUES (" . trim($namecampos_situacion, ",") . ")";

		foreach ($data as $row) {
			$stmt->bindParam(":" . $row['Field'], $_POST["" . $row['Field'] . ""], PDO::PARAM_STR);
		}
		$respuesta = "";
		if ($stmt->execute()) {
			$respuesta="ok";
		} else {
			$respuesta="error";
		}
		echo $respuesta;
		/* $stmt->close(); */
		$stmt = null;

		
		/* ***************** */

	break;
	case "modificar":
		/* ***************** */

		$namecolumnas_situacion = "";
		$namecampos_situacion = "";
		$data = getContent($nombre_tabla);
		$test = "";
		foreach ($data as $row) {
			$namecolumnas_situacion .= $row['Field'] . "=" . ":" . $row['Field'] . ",";
			$test .= $row['Field'] . "='" . $_POST["" . $row['Field'] . ""] . "',";
		}

		$query01 = "UPDATE $nombre_tabla SET " . trim($test, ",") . " WHERE id LIKE $id";
	
		$sql = Conexion::conectar()->prepare($query01);
		if ($sql->execute()) {
			$respuesta="ok";
		} else {
			$respuesta="error";
		}
		echo $respuesta;
		return $sql->fetchAll();
		$sql = null;
		/* ***************** */
	break;
	case "eliminar":
		/* ********************* */
		$query = "DELETE FROM $nombre_tabla WHERE id=$id";
		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll();
		
		$stmt = null;
		/* ********************* */
	break;
	case "obtenerdata":
		/* ************ */
		function consultar_situacion2($nombre_tabla1,$e)
		{
		/* 	$query01 = "SELECT * FROM `planilladevengo`  WHERE codigo_empleado_planilladevengo='$e'"; */
			$query01="SELECT*FROM $nombre_tabla1 WHERE id='$e'";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			$outp = $sql->fetchAll();
			echo json_encode($outp);
			
		};
		$data01 = consultar_situacion2($nombre_tabla,$id);
		$result = [];
			/* ************ */
	break;
	case "consultarvante":
		$codigoubicacion=$_POST["codigoubicacion"];
		function consultar($e)
		{
			$query01 = "SELECT `id`, `ubicacion_vacante`, `correlativo_vacante`, `fecha_vacante`, `hora_vacante`, `codigo_agente_vacante`, `nombre_agente_vacante`, `posicion_vacante`, `estado_vacante`, `fecha_cobertura_vacante`, `hora_cobertura_vacante`, `nombre_ubicacion_vacante`, `fecha_cubrir_vacante`, `hora_cubrir_vacante`, `accion_cubrir_vacante`, `codigo_empleado_cubrir_vacante`, `nombre_empleado_cubrir_vacante`, `codigo_ubicacion_cubrir_vacante`, `nombre_ubicacion_cubrir_vacante` FROM `vacante` where ubicacion_vacante='$e' and estado_vacante='Pendiente'";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$data01 = consultar($codigoubicacion);
		$datos_html = "";
		$datos_situacion="";
		$codigo_ubicacion="";
		$empleado="";
		foreach ($data01 as $value) {
			$datos_html .= "<option idvacante='".$value["id"]."' value='".$value["id"]."'>".$value["correlativo_vacante"]."-".$value["nombre_agente_vacante"]."-".$value["posicion_vacante"]." </option>";

			$datos_situacion .= "<option empleado='".$value["codigo_agente_vacante"]."-".$value["nombre_agente_vacante"]."' idvacante='".$value["id"]."' value='".$value["id"]."'>".$value["correlativo_vacante"]."-".$value["posicion_vacante"]." </option>";

			$codigo_ubicacion.=$value["ubicacion_vacante"];
			$empleado.=$value["codigo_agente_vacante"]."-".$value["nombre_agente_vacante"];
		
		}
				/* 0                       1                    2                3                  4 */
		echo $datos_html.",".$codigo_ubicacion.",".$codigo_ubicacion.",".$datos_situacion.",".$empleado;
	break;
	case "infoubicacion":

		$codigo_ubicacion=$_POST["codigo_ubicacion"];
		function consultar($e)
		{
			$query01 = "SELECT `id`, `id_cliente`, `codigo_cliente`, `codigo_ubicacion`, `facturar`, `id_coordinador_zona`, `nombre_ubicacion`, `latitude`, `longitude`, `direccion`, `persona_contacto`, `telefono_contacto`, `email_contacto`, `cantidad_armas`, `cantidad_radios`, `cantidad_celulares`, `bonos`, `visitas`, `zona`, `rubro`, `fecha_inicio`, `fecha_fin`, `horas_permitidas`, `id_departamento`, `id_municipio`, `observaciones_generales`, `fecha_ultimo_inventario`, `hombres_autorizados`, `tipo_documento`, `forma_pago`, `concepto`, `sumahs`, `tienepon`, `bono_unidad`, `bono_horas`, `selefactura`, `zonaubicacion`, `estado_cliente_ubicacion`, `turno_eventual`, `criterio_ubicacionc`, `calcula_comodin_ubicacionc`, `comodin_unidad_ubicacionc`, `comodin_base_ubicacionc`, `reporte_equipo_ubicacionc` FROM `tbl_clientes_ubicaciones` WHERE codigo_ubicacion='$e'";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$data01 = consultar($codigo_ubicacion);
		$datos_html = "";
	
		foreach ($data01 as $value) {
			$datos_html .= $value["id"];
		
		}
		echo $datos_html;

	break;
	case "asignarubicacion":

	
		$codigo_agente=$_POST["codigo_agente"];

		function consultar($e)
		{
		  $query01 = "SELECT COUNT(*) as cuenta, `id`, `idubicacion_agente`, `codigo_agente` FROM `tbl_ubicaciones_agentes_asignados` WHERE codigo_agente='$e'";
		   echo $query01;
		  $sql = Conexion::conectar()->prepare($query01);
		  $sql->execute();
		  return $sql->fetchAll();
		};

		$data01 = consultar($codigo_agente);
		$cuenta="";
		foreach ($data01 as $value) {
			$cuenta.=$value["cuenta"];
		}

		function getContent01()
		{
			$query = "SHOW COLUMNS FROM tbl_ubicaciones_agentes_asignados WHERE Field NOT IN ('id')";
			$stmt = Conexion::conectar()->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll();
			$stmt->close();
			$stmt = null;
		}

		if($cuenta==0){

				/* ****************** */
				/* CAPTURA NOMBRE DE LAS COLUMNAS Y CAMPOS DEL IMPUT */
				$namecolumnas_situacion = "";
				$namecampos_situacion = "";
				$data = getContent01();
				foreach ($data as $row) {
					$namecolumnas_situacion .= $row['Field'] . ",";
					$namecampos_situacion .= ":" . $row['Field'] . ",";
				}
				$stmt = Conexion::conectar()->prepare("INSERT INTO tbl_ubicaciones_agentes_asignados(" . trim($namecolumnas_situacion, ",") . ") VALUES (" . trim($namecampos_situacion, ",") . ")");

				foreach ($data as $row) {
					$stmt->bindParam(":" . $row['Field'], $_POST["" . $row['Field'] . ""], PDO::PARAM_STR);
				}
				$respuesta = "";
				if ($stmt->execute()) {
					$respuesta="ok";
				} else {
					$respuesta="error";
				}
				echo $respuesta;
				/* $stmt->close(); */
				$stmt = null;

		}
		else{
					/* ***************** */

				$namecolumnas_situacion = "";
				$namecampos_situacion = "";
				$data = getContent01($nombre_tabla);
				$test = "";
				foreach ($data as $row) {
					$namecolumnas_situacion .= $row['Field'] . "=" . ":" . $row['Field'] . ",";
					$test .= $row['Field'] . "='" . $_POST["" . $row['Field'] . ""] . "',";
				}

				$query01 = "UPDATE tbl_ubicaciones_agentes_asignados SET " . trim($test, ",") . " WHERE codigo_agente=$codigo_agente";
			
				$sql = Conexion::conectar()->prepare($query01);
				if ($sql->execute()) {
					$respuesta="ok";
				} else {
					$respuesta="error";
				}
				echo $respuesta;
				return $sql->fetchAll();
				$sql = null;
				/* ***************** */
		}
		
		/* ***************** */

	break;
	default:
		echo $accion." datos nulo";
}








?>