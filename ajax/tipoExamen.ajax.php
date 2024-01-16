<?php

require_once "../controladores/tipoExamen.controlador.php";
require_once "../modelos/tipoExamen.modelo.php";

class AjaxTiposExamenes
{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/

	public $idTipoExamen;

	public function ajaxEditarTipoExamen()
	{

		$item = "id";
		$valor = $this->idTipoExamen;

		$respuesta = ControladorTipoExamen::ctrMostrarTipoExamen($item, $valor);

		echo json_encode($respuesta);
	}




	/*=============================================
	MOSTRAR TIPO
	=============================================*/
	//public $idTipoExamen;
	public function ajaxMostrarTipoExamen()
	{
		$item = "id";
		$valor = $this->idTipoExamen;
		$respuesta = ControladorTipoExamen::ctrEditarTipoExamen($item, $valor);
		echo json_encode($respuesta);
	}
}

/*=============================================
EDITAR 
=============================================*/
if (isset($_POST["idTipoExamen"])) {

	$editar = new AjaxTiposExamenes();
	$editar->idTipoExamen = $_POST["idTipoExamen"];
	$editar->ajaxEditarTipoExamen();
}

/*=============================================
MOSTRAR TIPOS
=============================================
if(isset($_POST["idTipoExamen"])){

	$vertipos = new AjaxTiposExamenes();
	$vertipos -> idTipoExamen = $_POST["idTipoExamen"];
	$vertipos -> ajaxMostrarTipoExamen();
}
*/

/* GENERAR NUMERO CORRELATIVO */
if (isset($_POST['generarCodTipoExamen'])) {
	if ($_POST['generarCodTipoExamen'] == "correlativo") {
		$codigo = strtoupper($_POST["codigoNew"]);
		// Obtener el último valor generado
		$stmt = Conexion::conectar()->prepare("SELECT * FROM `tipos_examenes` where codigo=?");
		$stmt->execute([$codigo]);


		// Verificar si existe algún registro con el código proporcionado
		if ($stmt->rowCount() > 0) {
			// El código existe en la base de datos
			echo "existe";
		} else {
			// El código no existe en la base de datos
			echo $codigo;
		}
		/* $row = $stmt->fetch(PDO::FETCH_ASSOC); */

		/* 	if ($row) {
			$lastValue = $row['maximo'];
		} else {
			$lastValue = 0;
		}

		// Generar el próximo correlativo
		$newValue = $lastValue + 1;
		$correlativo = str_pad($newValue, 3, '0', STR_PAD_LEFT); // Asegura que tenga 6 dígitos rellenando con ceros
		echo $correlativo; */
	}
}
