<?php
require_once "../modelos/preguntageneral.modelo.php";
require_once "../controladores/preguntageneral.controlador.php";
//Modelo de Logs
require_once "../extensiones/navegador/vendor/autoload.php";
require_once "../modelos/logs.modelo.php";
session_start();
date_default_timezone_set('America/El_Salvador');

class AjaxPreguntaGeneral
{

    public function AjaxConsultarTipoPregunta()
    {
        $campos = "*";
        $tabla = "tipos_preguntas";
        $condicion = "1 ";

        $respuesta = ModeloPreguntaGeneral::MostrarDatos($campos, $tabla, $condicion, "order by id desc");
        return $respuesta;
    }


    public function AjaxConsultarPreguntas($id)
    {
        $campos = "*";
        $tabla = "preguntas";
        $condicion = "id_tipo=" . $id;

        $respuesta = ModeloPreguntaGeneral::MostrarDatos($campos, $tabla, $condicion, " order by id desc");
        return $respuesta;
    }


    public function mostrarTablaTipoPregunta()
    {

        $datos = self::AjaxConsultarTipoPregunta();

        $data = array();


        for ($i = 0; $i < count($datos); $i++) {

            $botones = '<div class="btn-group pull-right">
					   <button class="btn btn-warning btn-xs btnEditarTipoPregunta" idTipoPregunta="' . $datos[$i]["id"] . '" data-toggle="modal" data-target="#modalAgregarTipoPregunta"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-danger btn-xs btnEliminarTipoPregunta" idTipoPregunta="' . $datos[$i]["id"] . '"  ><i class="fa fa-times"></i></button>
                    </div>';

            $row = array(
                $i + 1,
                $datos[$i]["id"],
                $datos[$i]["codigo"],
                strtoupper($datos[$i]["descripcion"]),
                $botones,
            );

            $data[] = $row;
        }

        $response = array("data" => $data);
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }



    public function mostrarTablaPregunta($id)
    {

        $datos = self::AjaxConsultarPreguntas($id);

        $data = array();


        for ($i = 0; $i < count($datos); $i++) {

            $botones = '<div class="btn-group pull-right">
					   <button class="btn btn-warning btn-xs btnEditarPregunta" idPregunta="' . $datos[$i]["id"] . '" data-toggle="modal" data-target="#modalAgregarPregunta"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-danger btn-xs btnEliminarPregunta" idPregunta="' . $datos[$i]["id"] . '"  ><i class="fa fa-times"></i></button>
                    </div>';

            $row = array(
                $i + 1,
                $datos[$i]["id"],
                $datos[$i]["codigo"],
                strtoupper($datos[$i]["pregunta"]),
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

    public $idTipoPregunta;

    public function ajaxEditarTipoPregunta()
    {

        $item = "id";
        $valor = $this->idTipoPregunta;

        $respuesta = ControladorPreguntaGeneral::ctrMostrarTipopregunta($item, $valor);

        echo json_encode($respuesta);
    }


    public $idPregunta;

    public function ajaxEditarPregunta()
    {

        $item = "id";
        $valor = $this->idPregunta;

        $respuesta = ControladorPreguntaGeneral::ctrMostrarPregunta($item, $valor);

        echo json_encode($respuesta);
    }
}



if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["actionsTipoPregunta"]) && $_GET["actionsTipoPregunta"] === "Consult") {

        if (isset($_SESSION["perfil"])) {
            $consultTipopregunta = new AjaxPreguntaGeneral();

            $consultTipopregunta->mostrarTablaTipoPregunta();
        }
    }

    if (isset($_GET["actionsPregunta"]) && $_GET["actionsPregunta"] === "Consult" && isset($_GET["id_tipo_pregunta"])) {

        if (isset($_SESSION["perfil"])) {
            $consultPregunta = new AjaxPreguntaGeneral();

            $id = $_GET["id_tipo_pregunta"];

            $consultPregunta->mostrarTablaPregunta($id);
        }
    }
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {


    /* GENERAR NUMERO CORRELATIVO */
    if (isset($_POST['generarCodTipoPregunta'])) {
        if ($_POST['generarCodTipoPregunta'] == "correlativo") {
            $codigo = strtoupper($_POST["codigoNewTipoPregunta"]);
            $crear = new ControladorPreguntaGeneral();
            $result = $crear->ExisteRegistroTipoPregunta("UPPER(codigo)=UPPER('" . $_POST["codigoNewTipoPregunta"] . "')");
            if ($result > 0) {
                // El código existe en la base de datos
                echo "existe";
            } else {
                // El código no existe en la base de datos
                echo $codigo;
            }
        }
    }

    /*=============================================
        CREAR TIPO DE PREGUNTA
    =============================================*/
    if (isset($_POST["save_process_tipopregunta"]) && $_POST["save_process_tipopregunta"] === "ok" && isset($_POST["type_action_form_tipopregunta"]) && isset($_POST["id_edit_tipopregunta"])) {



        if ($_POST["id_edit_tipopregunta"] === "0"  && $_POST["type_action_form_tipopregunta"] === "save") {
            $crear = new ControladorPreguntaGeneral();


            if ($crear->ExisteRegistroTipoPregunta("UPPER(descripcion)=UPPER('" . $_POST["tipo_p_descripcion"] . "')") > 0) {
                echo "existe";
            } else {
                if ($crear->ctrCrearTipoPregunta()) {

                    logs_msg("Tabla Tipo Pregunta", "Crear tipo pregunta");
                    echo "save";
                } else {
                    echo "error";
                }
            }
        } else if ($_POST["id_edit_tipopregunta"] > "0"  && $_POST["type_action_form_tipopregunta"] === "update") {

            $editar = new ControladorPreguntaGeneral();

            if ($editar->ExisteRegistroTipoPregunta("((UPPER(descripcion)=UPPER('" . $_POST["tipo_p_descripcion"] . "') OR UPPER(codigo)='" . $_POST["tipo_p_codigo"] . "')) and id!=" . $_POST["id_edit_tipopregunta"]) > 0) {
                echo "existe";
            } else {
                if ($editar->ctrEditarTipoPregunta()) {
                    logs_msg("Tabla Tipo Pregunta", "Editar Tipo Pregunta: ID= " . $_POST["id_edit_tipopregunta"]);
                    echo "update";
                } else {
                    echo "error";
                }
            }
        }
    }


    /*=============================================
        CREAR PREGUNTA
    =============================================*/
    if (
        isset($_POST["save_process_pregunta"]) && $_POST["save_process_pregunta"] === "ok" && isset($_POST["type_action_form_pregunta"]) && isset($_POST["id_edit_pregunta"]) && isset($_POST["id_tipo_pregunta_id"]) && $_POST["id_tipo_pregunta_id"] > 0
    ) {

        if ($_POST["id_edit_pregunta"] === "0"  && $_POST["type_action_form_pregunta"] === "save") {
            $crear = new ControladorPreguntaGeneral();

            if ($crear->ExisteRegistroPreguntas("UPPER(pregunta)=UPPER('" . $_POST["pregunta_pregunta"] . "')")) {
                echo "existe";
            } else {
                if ($crear->ctrCrearPregunta()) {

                    logs_msg("Tabla Preguntas", "Crear Pregunta");
                    echo "save";
                } else {
                    echo "error";
                }
            }
        } else if ($_POST["id_edit_pregunta"] > "0"  && $_POST["type_action_form_pregunta"] === "update") {

            $editar = new ControladorPreguntaGeneral();

            if ($editar->ExisteRegistroPreguntas("((UPPER(pregunta)=UPPER('" . $_POST["pregunta_pregunta"] . "'))) and id!=" . $_POST["id_edit_pregunta"]) > 0) {
                echo "existe";
            } else {
                if ($editar->ctrEditarPreguntas()) {
                    logs_msg("Tabla Preguntas", "Editar Pregunta: ID= " . $_POST["id_edit_pregunta"]);
                    echo "update";
                } else {
                    echo "error";
                }
            }
        }
    }


    /*=============================================
        EDITAR 
        =============================================*/
    if (isset($_POST["id_tipo_pregunta"]) && is_numeric($_POST["id_tipo_pregunta"])) {
        $editar = new AjaxPreguntaGeneral();
        $editar->idTipoPregunta = $_POST["id_tipo_pregunta"];
        $editar->ajaxEditarTipoPregunta();
    }


    /*=============================================
        EDITAR 
        =============================================*/
    if (isset($_POST["id_pregunta_editar_form"]) && is_numeric($_POST["id_pregunta_editar_form"])) {
        $editar = new AjaxPreguntaGeneral();
        $editar->idPregunta = $_POST["id_pregunta_editar_form"];
        $editar->ajaxEditarPregunta();
    }


    /* ELIMINAR */
    if (isset($_POST["id_tipopregunta_delete"]) && $_POST["id_tipopregunta_delete"] > 0) {
        $borrar = new ControladorPreguntaGeneral();
        if ($borrar->ctrBorrarTipoPregunta()) {
            logs_msg("Tabla tbl_tipos_preguntas", "Eliminar Tipo Pregunta: ID= " . $_POST["id_tipopregunta_delete"]);
            echo "delete";
        } else {
            echo "error";
        }
    }


    if (isset($_POST["id_pregunta_delete"]) && $_POST["id_pregunta_delete"] > 0) {
        $borrar = new ControladorPreguntaGeneral();
        if ($borrar->ctrBorrarPreguntas()) {
            logs_msg("Tabla preguntas", "Eliminar pregunta: ID= " . $_POST["id_pregunta_delete"]);
            echo "delete";
        } else {
            echo "error";
        }
    }
}
