<?php

require_once "../controladores/ausenciadiasferiados.controlador.php";
require_once "../modelos/ausenciadiasferiados.modelo.php";

class Ajaxausenciadiasferiados{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idausenciadiasferiados;

	public function ajaxEditarausenciadiasferiados(){

		$item = "id";
		$valor = $this->idausenciadiasferiados;

		$respuesta = Controladorausenciadiasferiados::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarausenciadiasferiados;

	public function ajaxValidarausenciadiasferiados(){

		$item = "ausenciadiasferiados";
		$valor = $this->validarausenciadiasferiados;

		$respuesta = Controladorausenciadiasferiados::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idausenciadiasferiados"])){

	$editar = new Ajaxausenciadiasferiados();
	$editar -> idausenciadiasferiados = $_POST["idausenciadiasferiados"];
	$editar -> ajaxEditarausenciadiasferiados();

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
VALIDAR NO REPETIR USUARIO
=============================================*/

if(isset( $_POST["validarUsuario"])){

	$valUsuario = new AjaxUsuarios();
	$valUsuario -> validarUsuario = $_POST["validarUsuario"];
	$valUsuario -> ajaxValidarUsuario();

}