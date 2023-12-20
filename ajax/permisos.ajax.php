<?php

require_once "../controladores/permisos.controlador.php";
require_once "../modelos/permisos.modelo.php";

class AjaxPermiso{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idAfp;

	public function ajaxEditarPermiso(){

		$item = "id";
		$valor = $this->idPermiso;

		$respuesta = ControladorPermiso::ctrMostrarPermiso($item, $valor);

		echo json_encode($respuesta);

	}


	

	/*=============================================
	MOSTRAR AFP
	=============================================*/	
	public $idPermiso;
	public function ajaxMostrarPermiso(){
		$item = "id";
		$valor = $this->idPermiso;
		$respuesta = ControladorPermiso::ctrMostrarPermiso($item, $valor);
		echo json_encode($respuesta);
	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idPermiso"])){

	$editar = new AjaxPermiso();
	$editar -> idPermiso = $_POST["idPermiso"];
	$editar -> ajaxEditarPermiso();

}

/*=============================================
MOSTRAR AFP
=============================================*/	
if(isset($_POST["idPermiso"])){

	$verafp = new AjaxPermiso();
	$verafp -> idPermiso = $_POST["idPermiso"];
	$verafp -> ajaxMostrarPermiso();
}