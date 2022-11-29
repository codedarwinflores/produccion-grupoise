<?php

require_once "../controladores/descuentos.controlador.php";
require_once "../modelos/descuentos.modelo.php";

class AjaxDescuentos{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idDescuentos;

	public function ajaxEditarDescuentos(){

		$item = "id";
		$valor = $this->idDescuentos;

		$respuesta = ControladorDescuentos::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarDescuentos;

	public function ajaxValidarDescuentos(){

		$item = "tbl_devengo_descuento";
		$valor = $this->validarDescuentos;

		$respuesta = ControladorDescuentos::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idDescuentos"])){

	$editar = new AjaxDescuentos();
	$editar -> idDescuentos = $_POST["idDescuentos"];
	$editar -> ajaxEditarDescuentos();

}



