<?php
require_once "../modelos/cargocliente.modelo.php";
require_once "../controladores/cargocliente.controlador.php";
//Modelo de Logs
require_once "../extensiones/navegador/vendor/autoload.php";
require_once "../modelos/logs.modelo.php";
session_start();
date_default_timezone_set('America/El_Salvador');

class AjaxCargocClientes
{


    public function AjaxConsultarCargosClientes()
    {
        $campos = "*";
        $tabla = "tbl_cargo_cliente";
        $condicion = "1 ";

        $respuesta = ModeloCargoCliente::MostrarDatos($campos, $tabla, $condicion, "order by id desc");
        return $respuesta;
    }


    public function AjaxConsultarAreaExamen()
    {
        $campos = "*";
        $tabla = "tbl_area_examen";
        $condicion = "1 ";

        $respuesta = ModeloCargoCliente::MostrarDatos($campos, $tabla, $condicion, "order by id desc");
        return $respuesta;
    }


    public function mostrarTablaCargosClientes()
    {

        $datos = self::AjaxConsultarCargosClientes();

        $data = array();


        for ($i = 0; $i < count($datos); $i++) {

            $botones = '<div class="btn-group">
					   <button class="btn btn-warning btn-xs btnEditarCargoCliente" idCargoCliente="' . $datos[$i]["id"] . '" data-toggle="modal" data-target="#modalAgregarCargoCliente"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-danger btn-xs btnEliminarCargoCliente" idCargoCliente="' . $datos[$i]["id"] . '"  ><i class="fa fa-times"></i></button>
                    </div>';

            $row = array(
                $i + 1,
                $datos[$i]["id"],
                $datos[$i]["nombre_cargo"],
                $botones,
            );

            $data[] = $row;
        }

        $response = array("data" => $data);
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }



    public function mostrarTablaAreaExamen()
    {

        $datos = self::AjaxConsultarAreaExamen();

        $data = array();


        for ($i = 0; $i < count($datos); $i++) {

            $botones = '<div class="btn-group">
					   <button class="btn btn-warning btn-xs btnEditarAreaExamen" idAreaExamen="' . $datos[$i]["id"] . '" data-toggle="modal" data-target="#modalAgregarAreaExamen"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-danger btn-xs btnEliminarAreaExamen" idAreaExamen="' . $datos[$i]["id"] . '"  ><i class="fa fa-times"></i></button>
                    </div>';

            $row = array(
                $i + 1,
                $datos[$i]["id"],
                $datos[$i]["codigo"],
                $datos[$i]["motivo"],
                $botones,
            );

            $data[] = $row;
        }

        $response = array("data" => $data);
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }

    /*=============================================
	EDITAR REGISTRO
	=============================================*/

    public $idCargoCliente;

    public function ajaxEditarCargoCliente()
    {

        $item = "id";
        $valor = $this->idCargoCliente;

        $respuesta = ControladorCargoCliente::ctrMostrarCargoCliente($item, $valor);

        echo json_encode($respuesta);
    }


    public $idAreaExamen;

    public function ajaxEditarAreaExamen()
    {

        $item = "id";
        $valor = $this->idAreaExamen;

        $respuesta = ControladorCargoCliente::ctrMostrarAreaExamen($item, $valor);

        echo json_encode($respuesta);
    }
}



if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["actionsCargoClientes"]) && $_GET["actionsCargoClientes"] === "Consult") {

        if (isset($_SESSION["perfil"])) {
            $consultCargos = new AjaxCargocClientes();

            $consultCargos->mostrarTablaCargosClientes();
        }
    }

    if (isset($_GET["actionsAreaExamen"]) && $_GET["actionsAreaExamen"] === "Consult") {

        if (isset($_SESSION["perfil"])) {
            $consultCargos = new AjaxCargocClientes();

            $consultCargos->mostrarTablaAreaExamen();
        }
    }
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    /*=============================================
        CREAR CARGO CLIENTE
    =============================================*/
    if (isset($_POST["save_process_cargocliente"]) && $_POST["save_process_cargocliente"] === "ok" && isset($_POST["type_action_form"]) && isset($_POST["id_edit_cargocliente"])) {

        if ($_POST["id_edit_cargocliente"] === "0"  && $_POST["type_action_form"] === "save") {
            $crear = new ControladorCargoCliente();


            if ($crear->ExisteRegistro("UPPER(nombre_cargo)=UPPER('" . $_POST["nombre_cargo"] . "')")) {
                echo "existe";
            } else {
                if ($crear->ctrCrearCargoCliente()) {

                    logs_msg("Tabla Cargo Cliente", "Crear Cargo para cliente Morse");
                    echo "save";
                } else {
                    echo "error";
                }
            }
        } else if ($_POST["id_edit_cargocliente"] > "0"  && $_POST["type_action_form"] === "update") {

            $editar = new ControladorCargoCliente();
            if ($editar->ctrEditarCargoCliente()) {
                logs_msg("Tabla Cargo Clientee", "Editar cargo para cliente Morse: ID= " . $_POST["id_edit_cargocliente"]);
                echo "update";
            } else {
                echo "error";
            }
        }
    }


    /*=============================================
        CREAR AREA EXAMEN
    =============================================*/
    if (
        isset($_POST["save_process_areaexamen"]) && $_POST["save_process_areaexamen"] === "ok" && isset($_POST["type_action_form_areaexamen"]) && isset($_POST["id_edit_areaexamen"])
    ) {

        if ($_POST["id_edit_areaexamen"] === "0"  && $_POST["type_action_form_areaexamen"] === "save") {
            $crear = new ControladorCargoCliente();

            if ($crear->ExisteRegistroArea("UPPER(motivo)=UPPER('" . $_POST["motivo"] . "')")) {
                echo "existe";
            } else {
                if ($crear->ctrCrearAreaExamen()) {

                    logs_msg("Tabla Area Examen", "Crear Area examen");
                    echo "save";
                } else {
                    echo "error";
                }
            }
        } else if ($_POST["id_edit_areaexamen"] > "0"  && $_POST["type_action_form_areaexamen"] === "update") {

            $editar = new ControladorCargoCliente();
            if ($editar->ctrEditarAreaExamen()) {
                logs_msg("Tabla Area Examen", "Editar Area Examen: ID= " . $_POST["id_edit_areaexamen"]);
                echo "update";
            } else {
                echo "error";
            }
        }
    }


    /*=============================================
        EDITAR 
        =============================================*/
    if (isset($_POST["id_cargo_cliente"]) && is_numeric($_POST["id_cargo_cliente"])) {
        $editar = new AjaxCargocClientes();
        $editar->idCargoCliente = $_POST["id_cargo_cliente"];
        $editar->ajaxEditarCargoCliente();
    }


    /*=============================================
        EDITAR 
        =============================================*/
    if (isset($_POST["id_area_examen"]) && is_numeric($_POST["id_area_examen"])) {
        $editar = new AjaxCargocClientes();
        $editar->idAreaExamen = $_POST["id_area_examen"];
        $editar->ajaxEditarAreaExamen();
    }


    /* ELIMINAR */
    if (isset($_POST["id_cargocliente_delete"]) && $_POST["id_cargocliente_delete"] > 0) {
        $borrar = new ControladorCargoCliente();
        if ($borrar->ctrBorrarCargoCliente()) {
            logs_msg("Tabla tbl_cargo_clientes", "Eliminar cargo: ID= " . $_POST["id_cargocliente_delete"]);
            echo "delete";
        } else {
            echo "error";
        }
    }


    if (isset($_POST["id_area_examen_delete"]) && $_POST["id_area_examen_delete"] > 0) {
        $borrar = new ControladorCargoCliente();
        if ($borrar->ctrBorrarAreaExamen()) {
            logs_msg("Tabla tbl_area_examen", "Eliminar area examen: ID= " . $_POST["id_area_examen_delete"]);
            echo "delete";
        } else {
            echo "error";
        }
    }
}
