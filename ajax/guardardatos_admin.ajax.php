

<?php

require_once "../modelos/conexion.php";




function getContent_modificarexpres()
{
	$query = "SHOW COLUMNS FROM planilladevengo_admin WHERE Field NOT IN ('id') and Field NOT IN('numero_planilladevengo_admin')and Field NOT IN('fecha_planilladevengo_admin')and Field NOT IN('fecha_desde_planilladevengo_admin')and Field NOT IN('fecha_hasta_planilladevengo_admin')and 
	Field NOT IN('descripcion_planilladevengo_admin')and 
	Field NOT IN('dias_trabajo_planilladevengo_admin')and 
	Field NOT IN('sueldo_planilladevengo_admin')and 
	Field NOT IN('hora_extra_nocturna_planilladevengo_admin')and 
	Field NOT IN('hora_extra_domingo_planilladevengo_admin')and 
	Field NOT IN('hora_extra_domingo_nocturna_planilladevengo_admin')and 
	Field NOT IN('observacion_planilladevengo_admin')AND
	Field NOT IN('periodo_planilladevengo_admin')and
	Field NOT IN('tipo_planilladevengo_admin')and
	Field NOT IN('dias_incapacidad')and
	Field NOT IN('empleado_rango_desde')and
	Field NOT IN('empleado_rango_hasta')and
	Field NOT IN('septimo_admin')and
	Field NOT IN('dias_ausencia')and
	Field NOT IN('his_dias_trabajo_admin')and
	Field NOT IN('nombre_empleado_planilladevengo_admin')and
	Field NOT IN('id_empleado_planilladevengo_admin')and
	Field NOT IN('id_ubicacion_planilladevengo_admin')and
	Field NOT IN('codigo_ubicacion_planilladevengo_admin')and
	Field NOT IN('nombre_ubicacion_planilladevengo_admin')and
	Field NOT IN('fecha_gratificacion_admin')";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
}


$namecolumnas_situacion = "";
$namecampos_situacion = "";

$registros = json_decode($_POST['registros'], true);
/* var_dump($registros); */
function validarempleado01($e,$numero_planilladevengo_admin1)
{
			$query01 = "SELECT * FROM planilladevengo_admin WHERE codigo_empleado_planilladevengo_admin='$e' and numero_planilladevengo_admin=$numero_planilladevengo_admin1";
			
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
}
$codigo="";

	$data = getContent_modificarexpres();

foreach ($registros as $registro) {
	$test = "codigo_empleado_planilladevengo_admin". "='".$registro["codigo_empleado_planilladevengo_admin"]."',".
			"numero_planilladevengo_admin". "='".$registro["numero_planilladevengo_admin"]."',".
			"hora_extra_diurna_planilladevengo_admin". "='".$registro["hora_extra_diurna_planilladevengo_admin"]."',".
			"otro_devengo_admin_planilladevengo_admin". "='".$registro["otro_devengo_admin_planilladevengo_admin"]."',".
			"total_devengo_admin_planilladevengo_admin". "='".$registro["total_devengo_admin_planilladevengo_admin"]."',".
			"descuento_isss_planilladevengo_admin". "='".$registro["descuento_isss_planilladevengo_admin"]."',".
			"descuento_afp_planilladevengo_admin". "='".$registro["descuento_afp_planilladevengo_admin"]."',".
			"descuento_renta_planilladevengo_admin". "='".$registro["descuento_renta_planilladevengo_admin"]."',".
			"otro_descuento_planilladevengo_admin". "='".$registro["otro_descuento_planilladevengo_admin"]."',".
			"total_descuento_planilladevengo_admin". "='".$registro["total_descuento_planilladevengo_admin"]."',".
			"total_liquidado_planilladevengo_admin". "='".$registro["total_liquidado_planilladevengo_admin"]."',".
			"sueldo_renta_planilladevengo_admin". "='".$registro["sueldo_renta_planilladevengo_admin"]."',".
			"sueldo_isss_planilladevengo_admin". "='".$registro["sueldo_isss_planilladevengo_admin"]."',".
			"sueldo_afp_planilladevengo_admin". "='".$registro["sueldo_afp_planilladevengo_admin"]."',".
			"departamento_planilladevengo_admin". "='".$registro["departamento_planilladevengo_admin"]."',";
			

	$codigo_empleado_planilladevengo_admin = $registro["codigo_empleado_planilladevengo_admin"];
	$numero_planilladevengo_admin = $registro["numero_planilladevengo_admin"];

		$existeempleado="";
		$data03 = validarempleado01($codigo_empleado_planilladevengo_admin,$numero_planilladevengo_admin);
		foreach ($data03 as $value) {
		$existeempleado.=$value["id"];
		}

		$query01 = "UPDATE planilladevengo_admin SET " . trim($test, ",") . " WHERE id LIKE $existeempleado and numero_planilladevengo_admin=$numero_planilladevengo_admin";

		$codigo.=$query01."--------------";

		$sql = Conexion::conectar()->prepare($query01);
		$sql->execute();
		/* return $sql->fetchAll();
		$sql->close();
		$sql = null; */

}
echo $codigo;

	




	



	

echo $codigo;
?>