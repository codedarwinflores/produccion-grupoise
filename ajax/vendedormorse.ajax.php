<?php

require_once "../controladores/vendedormorse.controlador.php";
require_once "../modelos/vendedormorse.modelo.php";

class Ajaxtbl_vendedormorse
{

    /*=============================================
	EDITAR REGISTRO
	=============================================*/

    public $idtbl_vendedormorse;

    public function ajaxEditartbl_vendedormorse()
    {

        $item = "id";
        $valor = $this->idtbl_vendedormorse;

        $respuesta = Controladortbl_vendedormorse::ctrMostrar($item, $valor);

        echo json_encode($respuesta);
    }


    /*=============================================
	VALIDAR NO REPETIR 
	=============================================*/

    public $validartbl_vendedormorse;

    public function ajaxValidartbl_vendedormorse()
    {

        $item = "tbl_vendedormorse";
        $valor = $this->validartbl_vendedormorse;

        $respuesta = Controladortbl_vendedormorse::ctrMostrar($item, $valor);

        echo json_encode($respuesta);
    }
}

/*=============================================
EDITAR 
=============================================*/
if (isset($_POST["idtbl_vendedormorse"])) {

    $editar = new Ajaxtbl_vendedormorse();
    $editar->idtbl_vendedormorse = $_POST["idtbl_vendedormorse"];
    $editar->ajaxEditartbl_vendedormorse();
}


if (isset($_POST["codigo"])) {
    # code...

    $codigo = $_POST["codigo"];

    function ObtenerCorrelativo()
    {
        global $codigo;
        $query = "select count(*) as codigo from tbl_vendedormorse where codigo='" . $codigo . "'";
        $sql = Conexion::conectar()->prepare($query);
        $sql->execute();
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return $row["codigo"];
        }
        return 0;
    };


    echo ObtenerCorrelativo();
}
