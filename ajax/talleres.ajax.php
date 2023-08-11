<?php

require_once "../controladores/talleres.controlador.php";
require_once "../modelos/talleres.modelo.php";

class Ajaxtalleres
{

    /*=============================================
	EDITAR REGISTRO
	=============================================*/

    public $idtalleres;

    public function ajaxEditartallleres()
    {

        $item = "id";
        $valor = $this->idtalleres;

        $respuesta = ControladorTalleres::ctrMostrar($item, $valor);

        echo json_encode($respuesta);
    }


    /*=============================================
	VALIDAR NO REPETIR 
	=============================================*/

    public $validartalleres;

    public function ajaxValidartalleres()
    {

        $item = "nombre_talleres";
        $valor = $this->validartalleres;

        $respuesta = ControladorTalleres::ctrMostrar($item, $valor);

        echo json_encode($respuesta);
    }
}

/*=============================================
EDITAR 
=============================================*/
if (isset($_POST["idtalleres"])) {

    $editar = new Ajaxtalleres();
    $editar->idtalleres = $_POST["idtalleres"];
    $editar->ajaxEditartallleres();
}

/*=============================================
VALIDAR NO REPETIR USUARIO
=============================================*/

if (isset($_POST["validarUsuario"])) {

    $valUsuario = new AjaxUsuarios();
    $valUsuario->validarUsuario = $_POST["validarUsuario"];
    $valUsuario->ajaxValidarUsuario();
}
