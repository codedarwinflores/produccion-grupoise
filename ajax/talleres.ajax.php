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
}

/*=============================================
EDITAR 
=============================================*/
if (isset($_POST["idtalleres"])) {

    $editar = new Ajaxtalleres();
    $editar->idtalleres = $_POST["idtalleres"];
    $editar->ajaxEditartallleres();
}
