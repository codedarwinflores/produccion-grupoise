<?php

require_once "../controladores/reparaciones.controlador.php";
require_once "../modelos/reparaciones.modelo.php";

class Ajaxreparaciones
{

    /*=============================================
	EDITAR REGISTRO
	=============================================*/

    public $idreparaciones;

    public function ajaxEditarreparaciones()
    {

        $item = "id";
        $valor = $this->idreparaciones;

        $respuesta = ControladorReparaciones::ctrMostrar($item, $valor);

        echo json_encode($respuesta);
    }
}

/*=============================================
EDITAR 
=============================================*/
if (isset($_POST["idreparaciones"])) {

    $editar = new Ajaxreparaciones();
    $editar->idreparaciones = $_POST["idreparaciones"];
    $editar->ajaxEditarreparaciones();
}
