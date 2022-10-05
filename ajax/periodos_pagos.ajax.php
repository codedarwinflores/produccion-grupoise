<?php

require_once "../controladores/periodos_pagos.controlador.php";
require_once "../modelos/periodos_pagos.modelo.php";

class Ajaxperiodos_pagos{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idperiodos_pagos;

	public function ajaxEditarperiodos_pagos(){

		$item = "id";
		$valor = $this->idperiodos_pagos;

		$respuesta = Controladorperiodos_pagos::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarperiodos_pagos;

	public function ajaxValidarperiodos_pagos(){

		$item = "periodos_pagos";
		$valor = $this->validarperiodos_pagos;

		$respuesta = Controladorperiodos_pagos::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idperiodos_pagos"])){

	$editar = new Ajaxperiodos_pagos();
	$editar -> idperiodos_pagos = $_POST["idperiodos_pagos"];
	$editar -> ajaxEditarperiodos_pagos();

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