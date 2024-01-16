<?php

require_once "../controladores/preguntas.controlador.php";
require_once "../modelos/preguntas.modelo.php";

class AjaxPreguntas{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idPregunta;

	public function ajaxEditarPregunta(){

		$item = "id";
		$valor = $this->idPregunta;

		$respuesta = ControladorPregunta::ctrMostrarPregunta($item, $valor);

		echo json_encode($respuesta);

	}


	

}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idPregunta"])){

	$editar = new AjaxPreguntas();
	$editar -> idPregunta = $_POST["idPregunta"];
	$editar -> ajaxEditarPregunta();

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