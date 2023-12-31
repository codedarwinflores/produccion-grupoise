<?php

require_once "../controladores/departamentos.controlador.php";
require_once "../modelos/departamentos.modelo.php";

require_once "../controladores/departamento.controlador.php";
require_once "../modelos/departamento.modelo.php";

class AjaxDepartamentos{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idDepartamentos;

	public function ajaxEditarDepartamentos(){

		$item = "id";
		$valor = $this->idDepartamentos;

		$respuesta = ControladorDepartamentos::ctrMostrarDepartamentos($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarDepartamentos;

	public function ajaxValidarDepartamentos(){

		$item = "Departamentos";
		$valor = $this->validarDepartamentos;

		$respuesta = ControladorDepartamentos::ctrMostrarDepartamentos($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	MOSTRAR DEPTO
	=============================================*/	
	public $idDepto;
	public function ajaxMostrarDEP(){
		$item = "id";
		$valor = $this->idDepto;
		$respuesta = ControladorDepartamentos::ctrMostrarDepartamentos($item, $valor);
		echo json_encode($respuesta);
	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idDepartamentos"])){

	$editar = new AjaxDepartamentos();
	$editar -> idDepartamentos = $_POST["idDepartamentos"];
	$editar -> ajaxEditarDepartamentos();

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

/*=============================================
MOSTRAR DEPARTAMENTO
=============================================*/	
if(isset($_POST["idDepartamento"])){

	$verDep = new AjaxDepartamentos();
	$verDep -> idDepto = $_POST["idDepartamento"];
	$verDep -> ajaxMostrarDEP();
}