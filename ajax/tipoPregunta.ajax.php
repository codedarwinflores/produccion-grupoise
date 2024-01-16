<?php

require_once "../controladores/tipoPregunta.controlador.php";
require_once "../modelos/tipoPregunta.modelo.php";

class AjaxTiposPreguntas
{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/

	public $idTipoPregunta;

	public function ajaxEditarTipoPregunta()
	{

		$item = "id";
		$valor = $this->idTipoPregunta;

		$respuesta = ControladorTipoPregunta::ctrMostrarTipoPregunta($item, $valor);

		echo json_encode($respuesta);
	}
}

/*=============================================
EDITAR 
=============================================*/
if (isset($_POST["idTipoPregunta"])) {

	$editar = new AjaxTiposPreguntas();
	$editar->idTipoPregunta = $_POST["idTipoPregunta"];
	$editar->ajaxEditarTipoPregunta();
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
if (isset($_POST['generarCodPregunta'])) {
	if ($_POST['generarCodPregunta'] == "correlativo") {
		// Obtener el último valor generado
		$stmt = Conexion::conectar()->prepare("SELECT MAX(codigo) as maximo FROM `tipos_preguntas`");
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($row) {
			$lastValue = $row['maximo'];
		} else {
			$lastValue = 0;
		}

		// Generar el próximo correlativo
		$newValue = $lastValue + 1;
		$correlativo = str_pad($newValue, 3, '0', STR_PAD_LEFT); // Asegura que tenga 6 dígitos rellenando con ceros
		echo $correlativo;
	}
}
