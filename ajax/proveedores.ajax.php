<?php

require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";

class AjaxProveedores{

	/*=============================================
	EDITAR PROVEEDORES
	=============================================*/	

	public $idProveedores;

	public function ajaxEditarProveedores(){

		$item = "id";
		$valor = $this->idProveedores;

		$respuesta = ControladorProveedores::ctrMostrarProveedores($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR PROVEEDORES
	=============================================*/	

	public $validarProveedores;

	public function ajaxValidarProveedores(){

		$item = "proveedores";
		$valor = $this->validarProveedores;

		$respuesta = ControladorProveedores::ctrMostrarProveedores($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR PROVEEDORES
=============================================*/
if(isset($_POST["idProveedores"])){

	$editar = new AjaxProveedores();
	$editar -> idProveedores = $_POST["idProveedores"];
	$editar -> ajaxEditarProveedores();

}

/*=============================================
ACTIVAR USUARIO
=============================================*/	

if(isset($_POST["activarUsuario"])){

	$activarUsuario = new AjaxUsuarios();
	$activarUsuario -> activarUsuario = $_POST["activarUsuario"];
	$activarUsuario -> activarId = $_POST["activarId"];
	$activarUsuario -> ajaxActivarUsuario();

}

/*=============================================
VALIDAR NO REPETIR 
=============================================*/

if(isset( $_POST["validarUsuario"])){

	$valUsuario = new AjaxUsuarios();
	$valUsuario -> validarUsuario = $_POST["validarUsuario"];
	$valUsuario -> ajaxValidarUsuario();

}